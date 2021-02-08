<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Entity\Player;
use Symfony\Component\Mime\Address;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordToken;


class Mailer{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendRegistrationMail(Player $player)
    {
        $email = (new TemplatedEmail())
            ->from('symfonytest69@gmail.com')
            ->to($player->getLogin())
            ->subject('Bienvenue dans l\'Empire du divertissement !')
            ->htmlTemplate('email/welcome.html.twig')
            ->context([
                'player' => $player
            ]);
        $this->mailer->send($email);
    }

    public function sendResetPasswordEmail(ResetPasswordToken $resetToken,Player $player)
    {
        $email = (new TemplatedEmail())
            ->from(new Address('symfonytest69@gmail.com', 'QuiQuiGame'))
            ->to($player->getLogin())
            ->subject('Votre demande de nouveau mot de passe')
            ->htmlTemplate('email/emailResetPassword.html.twig')
            ->context([
                'resetToken' => $resetToken,
                'player' => $player
            ])
        ;

        $this->mailer->send($email);
    }
}