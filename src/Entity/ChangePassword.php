<?php

namespace App\Entity;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword
{
    /**
     * @SecurityAssert\UserPassword(
     *      message="Le mot de passe entré ne correspond pas à votre ancien mot de passe"
     * )
     */
    private $oldPassword;

    /**
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit comporter 8 caractères minimum")
     */
    private $newPassword;

    public function getNewPassword()
    {
        return $this->newPassword;
    }

    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    public function setNewPassword($password)
    {
        $this->newPassword=$password;
    }

    public function setOldPassword($password)
    {
        $this->oldPassword=$password;
    }

}