<?php

namespace App\Entity;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;

class ChangePassword
{
    /**
     * @SecurityAssert\UserPassword(
     *      message="Vous avez indiqué un mauvais mot de passe"
     * )
     */
    private $oldPassword;

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