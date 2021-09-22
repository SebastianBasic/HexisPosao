<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('romobil', name: 'romobil.')]

class RomobilController extends AbstractController
{
    #[Route('/', name: 'view')]
    public function index(): Response
    {
        return $this->render('romobil/index.html.twig');
    }
}
