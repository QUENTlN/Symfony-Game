<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Game;
use App\Entity\Category;
use App\Entity\Question;
use App\Entity\QuestionWithPicture;
use App\Entity\QuestionWithText;
use App\Entity\Room;
use App\Form\GuessTheQuestionType;
use App\Form\ModifyQuestionWithTextType;
use App\Form\ModifyQuestionWithPictureType;
use App\Form\QuizQuestionType;
use App\Repository\CategoryRepository;
use App\Repository\GameRepository;
use App\Repository\QuestionRepository;
use App\Repository\QuestionWithPictureRepository;
use App\Repository\QuestionWithTextRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class QuestionController extends AbstractController
{
    /**
     * @Route("/suggest_question", name="suggestQuestion")
     * @IsGranted("ROLE_USER")
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
     */
    public function acceptQuestion($id, EntityManagerInterface $manager, GameRepository $gameRepository, QuestionRepository $questionRepository)
    {
        $games = $gameRepository->findAll();
        $question = $questionRepository->find($id);
        $question->setStatus(Question::STATUS["accepted"]);
        $manager->persist($question);
        $manager->flush();
        return $this->redirectToRoute("showQuestion");
    }

    /**
     * @Route("/show_Question", name="showQuestion")
     * @IsGranted ("ROLE_MODERATEUR")
     */
    public function show(GameRepository $gameRepository, CategoryRepository $categoryRepository,QuestionRepository $questionRepository, QuestionWithPictureRepository $questionWithPictureRepository, QuestionWithTextRepository $questionWithTextRepository){
        $games = $gameRepository->findAll();
        $category = $categoryRepository->findAll();
        $question = $questionRepository->findQuestionWithStatusPending();


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
     * @param $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function modify($id, Request $request, QuestionRepository $questionRepository, FormFactoryInterface $factory, EntityManagerInterface $manager)
    {
        $question = $questionRepository->find($id);
        if (strcmp($question->getType(), 'QuestionWithText') == 0) {
            $boolean = true;
            $form = $factory->create(ModifyQuestionWithTextType::class, $question);
        }else {
            $boolean = false;
            $form = $factory->create(ModifyQuestionWithPictureType::class, $question);
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($question);
            $manager->flush();

            return $this->redirectToRoute('showQuestion');
        }
        return $this->render('question/modifyQuestion.html.twig', [
            'form' => $form->createView(),
            'boolean' => $boolean,
        ]);
        return $this->redirectToRoute("showQuestion");
    }


    /**
     * @Route("/{id}/delete", name="delete_question")
     * @IsGranted ("ROLE_MODERATEUR")
     *
     */
    public function delete($id, EntityManagerInterface $manager)
    {
        $question = $this->getDoctrine()->getRepository(Question::class)->find($id);
        $manager->remove($question);
        $manager->flush();
        return $this->redirectToRoute("showQuestion");
    }


}