<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\ChangePasswordFormType;
use App\Form\ResetPasswordRequestFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\ResetPassword\Controller\ResetPasswordControllerTrait;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;
use App\Service\Mailer;


class ResetPasswordController extends AbstractController
{
    use ResetPasswordControllerTrait;

    private $resetPasswordHelper;

    public function __construct(ResetPasswordHelperInterface $resetPasswordHelper)
    {
        $this->resetPasswordHelper = $resetPasswordHelper;
    }

    /**
     * @Route("/forgot_password_request", name="forgotPasswordRequest")
     */
    public function request(Request $request, Mailer $mailer, FormFactoryInterface $factory): Response
    {
        $form = $factory->create(ResetPasswordRequestFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->processSendingPasswordResetEmail(
                $form->get('login')->getData(),
                $mailer
            );
        }

        return $this->render('reset_password/request.html.twig', [
            'requestForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/check_email", name="checkEmail")
     */
    public function checkEmail(TranslatorInterface $translator): Response
    {
        if (null === ($resetToken = $this->getTokenObjectFromSession())) {
            $this->addFlash('reset_password_error',
                $translator->trans('Oups, il semble qu\'il y ait un problème lors de l\'envoi de mail, veuillez vérifier que votre mail est bien écrit.'));
            return $this->redirectToRoute('forgotPasswordRequest');
        }

        return $this->render('reset_password/check_email.html.twig', [
            'resetToken' => $resetToken,
        ]);
    }

    /**
     * Validates and process the reset URL that the user clicked in their email.
     * @Route("/reset/{token}", name="resetPassword")
     */
    public function reset(Request $request, UserPasswordEncoderInterface $passwordEncoder, string $token = null, TranslatorInterface $translator, FormFactoryInterface $factory, EntityManagerInterface $manager): Response
    {
        if ($token) {

            $this->storeTokenInSession($token);

            return $this->redirectToRoute('resetPassword');
        }

        $token = $this->getTokenFromSession();
        if (null === $token) {
            throw $this->createNotFoundException($translator->trans('tokenResetNotFound'));
        }

        try {
            $user = $this->resetPasswordHelper->validateTokenAndFetchUser($token);
        } catch (ResetPasswordExceptionInterface $e) {
            $this->addFlash('reset_password_error',
                $translator->trans('Oups... il semble qu\'il y ait un problème lors de la réinitialisation de votre mot de passe, voici pourquoi : ').$e->getReason()
            );

            return $this->redirectToRoute('forgotPasswordRequest');
        }

        $form = $factory->create(ChangePasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->resetPasswordHelper->removeResetRequest($token);

            $encodedPassword = $passwordEncoder->encodePassword(
                $user,
                $form->get('plainPassword')->getData()
            );

            $user->setPassword($encodedPassword);
            $manager->flush();

            $this->cleanSessionAfterReset();

            return $this->redirectToRoute('home');
        }

        return $this->render('reset_password/reset.html.twig', [
            'resetForm' => $form->createView(),
        ]);
    }

    private function processSendingPasswordResetEmail(string $emailFormData, Mailer $mailer): RedirectResponse
    {
        $user = $this->getDoctrine()->getRepository(Player::class)->findOneBy([
            'login' => $emailFormData,
        ]);

        if (!$user) {
            return $this->redirectToRoute('checkEmail');
        }

        try {
            $resetToken = $this->resetPasswordHelper->generateResetToken($user);
        } catch (ResetPasswordExceptionInterface $e) {
            return $this->redirectToRoute('checkEmail');
        }

        $mailer->sendResetPasswordEmail($resetToken, $user);

        $this->setTokenObjectInSession($resetToken);

        return $this->redirectToRoute('checkEmail');
    }
}
