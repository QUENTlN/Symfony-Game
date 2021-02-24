<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\QuestionWithPicture;
use App\Entity\QuestionWithText;
use App\Form\GuessTheQuestionType;
use App\Form\QuizQuestionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/suggest_question", name="suggestQuestion")
     */
    public function suggestQuestion(Request $request, EntityManagerInterface $manager): Response
    {
        $questionWithText = new QuestionWithText();
        $answer = new Answer();
        $answer->setQuestion($questionWithText);
        $questionWithText->addAnswer($answer)
            ->setStatus("pending")
            ->setPlayer($this->container->get('security.token_storage')->getToken()->getUser());
        $quiz_form = $this->createForm(QuizQuestionType::class, $questionWithText);
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
        $guessthe_form = $this->createForm(GuessTheQuestionType::class, $questionWithPicture);
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
     * @Route("/accept_question", name="acceptQuestion")
     */
    public function acceptQuestion(): Response
    {
        return $this->render('question/acceptQuestion.html.twig', [

        ]);
    }
}