<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Marka;
use App\Repository\MarkaRepository;
use App\Form\MarkaType;

#[Route('marka', name: 'marka.')]

class MarkaController extends AbstractController
{
  #[Route('/', name: 'view')]
  public function index(MarkaRepository $repo): Response
  {
      $marke = $repo->findAll();

      return $this->render('marka/index.html.twig', [
        'marke' => $marke
      ]);
  }

  #[Route('/create', name: 'create')]
  public function create(Request $req): Response
  {
        $marka = new Marka();

        $form = $this->createForm(MarkaType::class, $marka);

        $form->handleRequest($req);

        if($form->isSubmitted()){
          $em = $this->getDoctrine()->getManager();

          $em->persist($marka);
          $em->flush();

          $this->addFlash('success', 'Marka evidentirana!');

          return $this->redirect($this->generateUrl('marka.view'));
        }

        return $this->render('marka/create.html.twig', [
          'form' => $form->createView()
        ]);
  }
  #[Route('/{id}/update', name: 'update')]
    public function update(Marka $marka, Request $req, $id)
    {
      $form = $this->createForm(MarkaType::class, $marka);
      $form->handleRequest($req);

      if($form->isSubmitted()){
        $em = $this->getDoctrine()->getManager();
        $em->persist($marka);
        $em->flush();

        $this->addFlash('success', 'Marka uspješno uređena!');

        return $this->redirect($this->generateUrl('marka.view'));
      }

      return $this->render('marka/update.html.twig', [
        'form' => $form->createView()
      ]);
    }

  #[Route('/{id}/delete', name: 'delete')]
    public function destroy(Marka $marka)
    {
      $em = $this->getDoctrine()->getManager();

      $em->remove($marka);

      $em->flush();

      $this->addFlash('success', "Marka obrisana!");

      return $this->redirect($this->generateUrl('marka.view'));
    }
}
