<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ZauzeceRepository;
use App\Entity\Zauzece;
use App\Form\ZauzeceType;
use DateInterval;

#[Route('zauzece', name: 'zauzece.')]

class ZauzeceController extends AbstractController
{
  #[Route('/', name: 'view')]
  public function index(ZauzeceRepository $repo): Response
  {
      $zauzeca = $repo->findAll();

      return $this->render('zauzece/index.html.twig', [
        'zauzeca' => $zauzeca
      ]);
  }

  #[Route('/create', name: 'create')]
  public function create(Request $req): Response
  {
        $zauzece = new Zauzece();

        $form = $this->createForm(ZauzeceType::class, $zauzece);

        $form->handleRequest($req);

        if($form->isSubmitted()){
          $em = $this->getDoctrine()->getManager();

          $zauzece->setDatumZauzeca(new \DateTime());
          $zauzece->setDatumIsteka((new \DateTime())->add($zauzece->getPeriod()));

          $this->provjeriDatumIsteka($zauzece);

          $em->persist($zauzece);
          $em->flush();

          $this->addFlash('success', 'Zauzeće evidentirano!');

          return $this->redirect($this->generateUrl('zauzece.view'));
        }

        return $this->render('zauzece/create.html.twig', [
          'form' => $form->createView()
        ]);
  }
  #[Route('/{id}/update', name: 'update')]
    public function update(Zauzece $zauzece, Request $req, $id)
    {
      $form = $this->createForm(ZauzeceType::class, $zauzece);
      $form->handleRequest($req);

      if($form->isSubmitted()){
        $em = $this->getDoctrine()->getManager();

        $zauzece->setDatumIsteka((new \DateTime())->add($zauzece->getPeriod()));

        $this->provjeriDatumIsteka($zauzece);

        $em->persist($zauzece);
        $em->flush();

        $this->addFlash('success', 'Zauzeće uspješno uređeno!');

        return $this->redirect($this->generateUrl('zauzece.view'));
      }

      return $this->render('zauzece/update.html.twig', [
        'form' => $form->createView()
      ]);
    }

  #[Route('/{id}/delete', name: 'delete')]
    public function destroy(Zauzece $zauzece)
    {
      $em = $this->getDoctrine()->getManager();

      $romobil = $zauzece->getRomobil();

      $romobil->setStatus(false);

      $em->remove($zauzece);

      $em->flush();

      $this->addFlash('success', "Zauzeće obrisano!");

      return $this->redirect($this->generateUrl('zauzece.view'));
    }

  #Moje metode:
  private function provjeriDatumIsteka(Zauzece $zauzece)
  {
    $em = $this->getDoctrine()->getManager();

    if($zauzece->getDatumIsteka() <= (new \DateTime())){
      $romobil = $zauzece->getRomobil();

      $romobil->setStatus(false);

      $em->persist($romobil);
    }
    else{
      $romobil = $zauzece->getRomobil();

      $romobil->setStatus(true);

      $em->persist($romobil);
    }
  }
}
