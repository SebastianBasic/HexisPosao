<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('bicikl', name: 'bicikl.')]

class BikeController extends AbstractController
{
  #[Route('/', name: 'view')]
  public function index(): Response
  {
      return $this->render('bike/index.html.twig');
  }
}
