<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\ChangePasswordFormType;
use App\Form\ResetPasswordRequestFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * Display & process form to request a password reset.
     * @Route("/forgot_password_request", name="forgotPasswordRequest")
     */
    public function request(Request $request, Mailer $mailer): Response
    {
        $form = $this->createForm(ResetPasswordRequestFormType::class);
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
     * Confirmation page after a user has requested a password reset.
     * @Route("/check_email", name="checkEmail")
     */
    public function checkEmail(TranslatorInterface $translator): Response
    {
        if (null === ($resetToken = $this->getTokenObjectFromSession())) {
            $this->addFlash('reset_password_error',
                $translator->trans('resetPasswordMail'));
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
    public function reset(Request $request, UserPasswordEncoderInterface $passwordEncoder, string $token = null, TranslatorInterface $translator): Response
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
                $translator->trans('resetPasswordError').$e->getReason()
            );

            return $this->redirectToRoute('forgotPasswordRequest');
        }

        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->resetPasswordHelper->removeResetRequest($token);

            $encodedPassword = $passwordEncoder->encodePassword(
                $user,
                $form->get('plainPassword')->getData()
            );

            $user->setPassword($encodedPassword);
            $this->getDoctrine()->getManager()->flush();

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
