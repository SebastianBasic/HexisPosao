<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BiciklRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Bicikl;
use App\Form\BiciklType;

#[Route('bicikl', name: 'bicikl.')]

class BikeController extends AbstractController
{
  #[Route('/', name: 'view')]
  public function index(BiciklRepository $repo): Response
  {
      $bikes = $repo->findAll();

      foreach ($bikes as $bike) {
        $zauzeca = $bike->getZauzece();
        foreach ($zauzeca as $zauzece) {
          if($zauzece->getDatumIsteka() <= (new \DateTime())){
            $bike->setStatus(false);
          }
        }
      }

      return $this->render('bike/index.html.twig', [
        'bikes' => $bikes
      ]);
  }

  #[Route('/create', name: 'create')]
  public function create(Request $req): Response
  {
        $bike = new Bicikl();

        $form = $this->createForm(BiciklType::class, $bike);

        $form->handleRequest($req);

        if($form->isSubmitted()){
          $em = $this->getDoctrine()->getManager();

          $bike->setStatus(false);

          $em->persist($bike);
          $em->flush();

          $this->addFlash('success', 'Bicikl evidentiran!');

          return $this->redirect($this->generateUrl('bicikl.view'));
        }

        return $this->render('bike/create.html.twig', [
          'form' => $form->createView()
        ]);
  }
  #[Route('/{id}/update', name: 'update')]
    public function update(Bicikl $bike, Request $req, $id)
    {
      $form = $this->createForm(BiciklType::class, $bike);
      $form->handleRequest($req);

      if($form->isSubmitted()){
        $em = $this->getDoctrine()->getManager();
        $em->persist($bike);
        $em->flush();

        $this->addFlash('success', 'Bicikl uspješno uređen!');

        return $this->redirect($this->generateUrl('bicikl.view'));
      }

      return $this->render('bike/update.html.twig', [
        'form' => $form->createView()
      ]);
    }

  #[Route('/{id}/delete', name: 'delete')]
    public function destroy(Bicikl $bike)
    {
      $em = $this->getDoctrine()->getManager();

      $zauzeca = $bike->getZauzece();

      foreach ($zauzeca as $zauzece) {
        $em->remove($zauzece);
      }

      $em->remove($bike);

      $em->flush();

      $this->addFlash('success', "Bicikl obrisan!");

      return $this->redirect($this->generateUrl('bicikl.view'));
    }
}
