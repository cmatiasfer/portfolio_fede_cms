<?php

namespace App\Zard\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExceptionController extends AbstractController
{
    public function showException()
    {
        return $this->redirectToRoute('home');
    }
}
