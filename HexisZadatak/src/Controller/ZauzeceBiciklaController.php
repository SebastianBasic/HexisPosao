<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ZauzeceBiciklaRepository;
use App\Entity\ZauzeceBicikla;
use App\Form\ZauzeceBiciklaType;
use DateInterval;

#[Route('zauzeceBicikla', name: 'zauzeceBicikla.')]

class ZauzeceBiciklaController extends AbstractController
{
  #[Route('/', name: 'view')]
  public function index(ZauzeceBiciklaRepository $repo): Response
  {
      $zauzeca = $repo->findAll();

      return $this->render('zauzeceBicikla/index.html.twig', [
        'zauzeca' => $zauzeca
      ]);
  }

  #[Route('/create', name: 'create')]
  public function create(Request $req): Response
  {
        $zauzece = new ZauzeceBicikla();

        $form = $this->createForm(ZauzeceBiciklaType::class, $zauzece);

        $form->handleRequest($req);

        if($form->isSubmitted()){
          if ($zauzece->getBicikl()->getStatus()) {

            $this->addFlash('message', 'Ovaj bicikl je već zauzet! ODABERITE DRUGI BICIKL!');

            return $this->redirect($this->generateUrl('zauzeceBicikla.create'));
          }

          $em = $this->getDoctrine()->getManager();

          $zauzece->setDatumZauzeca(new \DateTime());
          $zauzece->setDatumIsteka((new \DateTime())->add($zauzece->getPeriod()));

          $this->provjeriDatumIsteka($zauzece);

          $em->persist($zauzece);
          $em->flush();

          $this->addFlash('success', 'Zauzeće evidentirano!');

          return $this->redirect($this->generateUrl('zauzeceBicikla.view'));
        }

        return $this->render('zauzeceBicikla/create.html.twig', [
          'form' => $form->createView()
        ]);
  }
  #[Route('/{id}/update', name: 'update')]
    public function update(ZauzeceBicikla $zauzece, Request $req, $id)
    {
      $stariBicikl = $zauzece->getBicikl();
      $stariBicikl->setStatus(false);

      $form = $this->createForm(ZauzeceBiciklaType::class, $zauzece);
      $form->handleRequest($req);

      if($form->isSubmitted()){
        if ($zauzece->getBicikl()->getStatus()) {

          $this->addFlash('message', 'Ovaj bicikl je već zauzet! ODABERITE DRUGI BICIKL!');

          return $this->redirect($this->generateUrl('zauzeceBicikla.update', ['id' => $zauzece->getId()]));
        }

        $em = $this->getDoctrine()->getManager();

        $zauzece->setDatumIsteka((new \DateTime())->add($zauzece->getPeriod()));

        $this->provjeriDatumIsteka($zauzece);

        $em->persist($zauzece);

        $em->flush();

        $this->addFlash('success', 'Zauzeće uspješno uređeno!');

        return $this->redirect($this->generateUrl('zauzeceBicikla.view'));
      }

      return $this->render('zauzeceBicikla/update.html.twig', [
        'form' => $form->createView()
      ]);
    }

  #[Route('/{id}/delete', name: 'delete')]
    public function destroy(ZauzeceBicikla $zauzece)
    {
      $em = $this->getDoctrine()->getManager();

      $bicikl = $zauzece->getBicikl();

      $bicikl->setStatus(false);

      $em->remove($zauzece);

      $em->flush();

      $this->addFlash('success', "Zauzeće obrisano!");

      return $this->redirect($this->generateUrl('zauzeceBicikla.view'));
    }

  #Moje metode:
  private function provjeriDatumIsteka(ZauzeceBicikla $zauzece)
  {
    $em = $this->getDoctrine()->getManager();

    if($zauzece->getDatumIsteka() <= (new \DateTime())){
      $bicikl = $zauzece->getBicikl();

      $bicikl->setStatus(false);

      $em->persist($bicikl);
    }
    else{
      $bicikl = $zauzece->getBicikl();

      $bicikl->setStatus(true);

      $em->persist($bicikl);
    }
  }
}
