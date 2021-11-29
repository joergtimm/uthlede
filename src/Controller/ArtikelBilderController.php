<?php

namespace App\Controller;

use App\Entity\Articel;
use App\Entity\ArtikelBilder;
use App\Form\ArtikelBilderType;
use App\Repository\ArtikelBilderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artikel/bilder")
 * @IsGranted("ROLE_ADMIN")
 */
class ArtikelBilderController extends AbstractController
{
    /**
     * @Route("/", name="artikel_bilder_index", methods={"GET"})
     */
    public function index(ArtikelBilderRepository $artikelBilderRepository): Response
    {
        return $this->render('artikel_bilder/index.html.twig', [
            'artikel_bilders' => $artikelBilderRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="artikel_bilder_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $artikelBilder = new ArtikelBilder();
        $form = $this->createForm(ArtikelBilderType::class, $artikelBilder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artikelBilder);
            $entityManager->flush();

            return $this->redirectToRoute('artikel_bilder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artikel_bilder/new.html.twig', [
            'artikel_bilder' => $artikelBilder,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="artikel_bilder_show", methods={"GET"})
     */
    public function show(ArtikelBilder $artikelBilder): Response
    {
        return $this->render('artikel_bilder/show.html.twig', [
            'artikel_bilder' => $artikelBilder,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="artikel_bilder_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ArtikelBilder $artikelBilder): Response
    {
        $form = $this->createForm(ArtikelBilderType::class, $artikelBilder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artikel_bilder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artikel_bilder/edit.html.twig', [
            'artikel_bilder' => $artikelBilder,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="artikel_bilder_delete", methods={"POST"})
     */
    public function delete(Request $request, ArtikelBilder $artikelBilder): Response
    {
        $articel = $artikelBilder->getArtikel();

        if ($this->isCsrfTokenValid('delete'.$artikelBilder->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($artikelBilder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_artikel:show', [ 'id' => $articel->getId() ], Response::HTTP_SEE_OTHER);
    }

    /**
     * @param Articel $articel
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return JsonResponse
     * @Route("/_sort/{id}", name="artikel_bilder_sort", methods={"POST", "PATCH"})
     */
    public function sort( Articel $articel, Request $request, EntityManagerInterface $em): Response
    {
        $orderedIds = json_decode($request->getContent(), true);
        if ($orderedIds === null) {
            return $this->redirectToRoute('admin_artikel:bilder', [ 'id' => $articel->getId() ]);
        }

        // from (position)=>(id) to (id)=>(position)
        $orderedIds = array_flip($orderedIds);
        foreach ($articel->getArtikelBilders() as $medien) {
            $medien->setPosition($orderedIds[$medien->getId()]);
        }

        $em->flush();

        return $this->redirectToRoute('admin_artikel:bilder', [ 'id' => $articel->getId() ]);
    }
}
