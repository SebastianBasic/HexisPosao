<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('marka', name: 'marka.')]

class MarkaController extends AbstractController
{
  #[Route('/', name: 'view')]
  public function index(): Response
  {
      return $this->render('marka/index.html.twig');
  }
}
