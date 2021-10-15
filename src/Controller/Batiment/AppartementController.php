<?php

declare(strict_types=1);

namespace App\Controller\Batiment;

use App\Entity\Batiment\Appartement;
use App\Form\Batiment\AppartementType;
use App\Repository\Batiment\AppartementRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/batiment/appartement")
 */
class AppartementController extends AbstractController
{
    /**
     * @Route("/", name="batiment_appartement_index", methods={"GET"})
     */
    public function index(AppartementRepository $appartementRepository): Response
    {
        return $this->render('batiment/appartement/index.html.twig', [
            'appartements' => $appartementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="batiment_appartement_new", methods={"GET","POST"})
     */
    public function new(Request $request, LoggerInterface $appartementLogger): Response
    {
        $appartement = new Appartement();
        $form = $this->createForm(AppartementType::class, $appartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($appartement);
            $entityManager->flush();

            $this->addFlash('info', 'Une nouvelle appartement ajoutée.');
            $appartementLogger->info('Une nouvelle appartement ajoutée.');

            return $this->redirectToRoute('batiment_appartement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('batiment/appartement/new.html.twig', [
            'appartement' => $appartement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="batiment_appartement_show", methods={"GET"})
     */
    public function show(Appartement $appartement): Response
    {
        return $this->render('batiment/appartement/show.html.twig', [
            'appartement' => $appartement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="batiment_appartement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Appartement $appartement, LoggerInterface $appartementLogger): Response
    {
        $form = $this->createForm(AppartementType::class, $appartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('info', 'Appartement modifiée.');
            $appartementLogger->info('Appartement modifiée', ['id' => $appartement->getId()]);

            return $this->redirectToRoute('batiment_appartement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('batiment/appartement/edit.html.twig', [
            'appartement' => $appartement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="batiment_appartement_delete", methods={"POST"})
     */
    public function delete(Request $request, Appartement $appartement, LoggerInterface $appartementLogger): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appartement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($appartement);
            $entityManager->flush();

            $this->addFlash('info', 'Appartement suprimée.');
            $appartementLogger->info('Appartement suprimée');
        }

        return $this->redirectToRoute('batiment_appartement_index', [], Response::HTTP_SEE_OTHER);
    }
}
