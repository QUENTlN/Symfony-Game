<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\QuestionWithPicture;
use App\Entity\QuestionWithText;
use App\Form\GuessTheQuestionType;
use App\Form\QuizQuestionType;
use App\Repository\CategoryRepository;
use App\Repository\GameRepository;
use App\Repository\PlayerRepository;
use App\Repository\QuestionRepository;
use App\Repository\QuestionWithPictureRepository;
use App\Repository\QuestionWithTextRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class QuestionController extends AbstractController
{
    /**
     * @Route("/suggest_question", name="suggestQuestion")
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param FormFactoryInterface $factory
     * @return Response
     * @throws Exception
     */
    public function suggestQuestion(Request $request, EntityManagerInterface $manager, FormFactoryInterface $factory): Response
    {
        $questionWithText = new QuestionWithText();
        $answer = new Answer();

        $answer->setQuestion($questionWithText);
        $questionWithText->addAnswer($answer)
            ->setStatus("pending")
            ->setPlayer($this->container->get('security.token_storage')->getToken()->getUser());
        $quiz_form = $factory->create(QuizQuestionType::class, $questionWithText);
        $quiz_form->handleRequest($request);

        if ($quiz_form->isSubmitted() && $quiz_form->isValid()) {
            $manager->persist($questionWithText);
            $manager->flush();
            return $this->redirectToRoute('suggestQuestion');
        }

        $questionWithPicture = new QuestionWithPicture();
        $answer2 = new Answer();
        $answer2->setQuestion($questionWithPicture);
        $questionWithPicture->addAnswer($answer2)
            ->setStatus("pending")
            ->setPlayer($this->container->get('security.token_storage')->getToken()->getUser());
        $guessthe_form = $factory->create(GuessTheQuestionType::class, $questionWithPicture);
        $guessthe_form->handleRequest($request);

        if ($guessthe_form->isSubmitted() && $guessthe_form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $guessthe_form['linkPicture']->getData();
            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir') . '/public/games_images/guess_the';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = time() . '-' . uniqid($originalFilename, true) . '-' . random_int(0, 9999999) . "-" . $questionWithPicture->getPlayer()->getId() . '.' . $uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $questionWithPicture->setLinkPicture($newFilename);
            }
            $manager->persist($questionWithPicture);
            $manager->flush();
            return $this->redirectToRoute('suggestQuestion');
        }

        return $this->render('question/suggestQuestion.html.twig', [
            'form_quiz' => $quiz_form->createView(),
            'form_guessThe' => $guessthe_form->createView(),
        ]);
    }

    /**
     * @Route("/accept_Question/{id}", name="acceptQuestion")
     * @IsGranted ("ROLE_MODERATEUR")
     * @param $id
     * @param EntityManagerInterface $manager
     * @param GameRepository $gameRepository
     * @param QuestionRepository $questionRepository
     * @return RedirectResponse
     */
    public function acceptQuestion($id, EntityManagerInterface $manager, GameRepository $gameRepository, QuestionRepository $questionRepository): RedirectResponse
    {
        $question = $questionRepository->find($id);
        $question->setStatus(Question::STATUS["accepted"]);
        $manager->persist($question);
        $manager->flush();
        return $this->redirectToRoute("showQuestion");
    }

    /**
     * @Route("/show_Question", name="showQuestion")
     * @IsGranted ("ROLE_MODERATEUR")
     * @param GameRepository $gameRepository
     * @param CategoryRepository $categoryRepository
     * @param QuestionRepository $questionRepository
     * @param QuestionWithPictureRepository $questionWithPictureRepository
     * @param QuestionWithTextRepository $questionWithTextRepository
     * @return Response
     */
    public function show(GameRepository $gameRepository, CategoryRepository $categoryRepository, QuestionRepository $questionRepository, QuestionWithPictureRepository $questionWithPictureRepository, QuestionWithTextRepository $questionWithTextRepository): Response
    {
        $games = $gameRepository->findAll();
        $question = $questionRepository->findQuestionWithStatusPending();
        $category = $categoryRepository->findAll();


        return $this->render('question/acceptQuestion.html.twig', [
            'game' => $games,
            'category' => $category,
            'questions' => $question,
        ]);
    }

    /**
     * @Route("/modify_Question/{id}", name="modify_question")
     * @IsGranted ("ROLE_MODERATEUR")
     * @param $id
     * @param Request $request
     * @param QuestionRepository $questionRepository
     * @param FormFactoryInterface $factory
     * @param EntityManagerInterface $manager
     * @param PlayerRepository $playerRepository
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function modify($id, Request $request, QuestionRepository $questionRepository, FormFactoryInterface $factory, EntityManagerInterface $manager, PlayerRepository $playerRepository)
    {
        $question = $questionRepository->find($id);
        if ($question != null) {
            if (strcmp($question->getType(), 'QuestionWithText') == 0) {
                $boolean = true;
                $question2 = new QuestionWithText();
                $question2->setPlayer($question->getPlayer());
                $question2->setStatus("pending");
                $question2->setSubCategory($question->getSubCategory());
                $question2->setText($question->getText());
                foreach ($question->getAnswers() as $answer) {
                    $question2->addAnswer($answer);
                }
                $form = $factory->create(QuizQuestionType::class, $question2);
            } else {
                $boolean = false;
                $question2 = new QuestionWithPicture();
                $question2->setPlayer($question->getPlayer());
                $question2->setStatus("pending");
                $question2->setSubCategory($question->getSubCategory());
                foreach ($question->getAnswers() as $answer) {
                    $question2->addAnswer($answer);
                }
                $form = $factory->create(GuessTheQuestionType::class, $question2);
            }
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                if (!$boolean) {
                    if ($question2->getLinkPicture() != null) {
                        $uploadedFile = $form['linkPicture']->getData();
                        if ($uploadedFile) {
                            $destination = $this->getParameter('kernel.project_dir') . '/public/games_images/guess_the';
                            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                            $newFilename = time() . '-' . uniqid($originalFilename, true) . '-' . random_int(0, 9999999) . "-" . $question->getPlayer()->getId() . '.' . $uploadedFile->guessExtension();
                            $uploadedFile->move(
                                $destination,
                                $newFilename
                            );
                            $question->setLinkPicture($newFilename);
                        }
                    }
                } else if ($question2->getText() != null) {
                    $question->setText($question2->getText());
                }
                if ($question2->getSubCategory() != null) {
                    $question->setSubCategory($question2->getSubCategory());
                }
                foreach ($question->getAnswers() as $answer) {
                        $question->removeAnswer($answer);
                }
                foreach ($question2->getAnswers() as $answer) {
                    if ($answer->getTextAnswer() != null) {
                        $question->addAnswer($answer);
                    }
                }
                $manager->persist($question);
                $manager->flush();

                return $this->redirectToRoute('showQuestion');
            }
        }

        return $this->render('question/modifyQuestion.html.twig', [
            'form' => $form->createView(),
            'question' => $question,
            'boolean' => $boolean,
        ]);
    }


    /**
     * @Route("/{id}/delete", name="delete_question")
     * @IsGranted ("ROLE_MODERATEUR")
     * @param $id
     * @param EntityManagerInterface $manager
     * @return RedirectResponse
     */
    public function delete($id, EntityManagerInterface $manager): RedirectResponse
    {
        $question = $this->getDoctrine()->getRepository(Question::class)->find($id);
        if ($question !== null){
            $question->setStatus('rejected');
        }
        $manager->persist($question);
        $manager->flush();
        return $this->redirectToRoute("showQuestion");
    }
}