<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends AbstractController
{
    /**
     * @Route("/change_language/{locale}", name="changeLanguage")
     *
     */
    public function changeLanguage($locale, Request $request): Response
    {
        $request->getSession()->set('_locale', $locale);
        ///pour revenir à la page précédente
        return $this->redirect($request->headers->get('referer'));
    }
}
