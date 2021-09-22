<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('zauzece', name: 'zauzece.')]

class ZauzeceController extends AbstractController
{
  #[Route('/', name: 'view')]
  public function index(): Response
  {
      return $this->render('zauzece/index.html.twig');
  }
}
