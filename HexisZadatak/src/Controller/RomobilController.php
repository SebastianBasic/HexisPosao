<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RomobilRepository;
use App\Entity\Romobil;
use App\Form\RomobilType;

#[Route('romobil', name: 'romobil.')]

class RomobilController extends AbstractController
{
  #[Route('/', name: 'view')]
  public function index(RomobilRepository $repo): Response
  {
      $romobili = $repo->findAll();

      foreach ($romobili as $romobil) {
        $zauzeca = $romobil->getZauzece();
        foreach ($zauzeca as $zauzece) {
          if($zauzece->getDatumIsteka() <= (new \DateTime())){
            $romobil->setStatus(false);
          }
        }
      }

      return $this->render('romobil/index.html.twig', [
        'romobili' => $romobili
      ]);
  }

  #[Route('/create', name: 'create')]
  public function create(Request $req): Response
  {
        $romobil = new Romobil();

        $form = $this->createForm(RomobilType::class, $romobil);

        $form->handleRequest($req);

        if($form->isSubmitted()){
          $em = $this->getDoctrine()->getManager();

          $romobil->setStatus(false);
          $romobil->setSifra(uniqid());

          $em->persist($romobil);
          $em->flush();

          $this->addFlash('success', 'Romobil evidentiran!');

          return $this->redirect($this->generateUrl('romobil.view'));
        }

        return $this->render('romobil/create.html.twig', [
          'form' => $form->createView()
        ]);
  }
  #[Route('/{id}/update', name: 'update')]
    public function update(Romobil $romobil, Request $req, $id)
    {
      $form = $this->createForm(RomobilType::class, $romobil);
      $form->handleRequest($req);

      if($form->isSubmitted()){
        $em = $this->getDoctrine()->getManager();
        $em->persist($romobil);
        $em->flush();

        $this->addFlash('success', 'Romobil uspješno uređen!');

        return $this->redirect($this->generateUrl('romobil.view'));
      }

      return $this->render('romobil/update.html.twig', [
        'form' => $form->createView()
      ]);
    }

  #[Route('/{id}/delete', name: 'delete')]
    public function destroy(Romobil $romobil)
    {
      $em = $this->getDoctrine()->getManager();

      $zauzeca = $romobil->getZauzece();

      foreach ($zauzeca as $zauzece) {
        $em->remove($zauzece);
      }

      $em->remove($romobil);

      $em->flush();

      $this->addFlash('success', "Romobil obrisan!");

      return $this->redirect($this->generateUrl('romobil.view'));
    }
}
