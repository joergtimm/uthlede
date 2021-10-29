<?php

namespace App\Controller;

use App\Entity\Personen;
use App\Form\PersonenType;
use App\Repository\PersonenRepository;
use App\Service\UploaderHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/personen")
 */
class PersonenController extends AbstractController
{
    /**
     * @Route("/", name="personen_index", methods={"GET"})
     */
    public function index(PersonenRepository $personenRepository): Response
    {
        return $this->render('personen/index.html.twig', [
            'personens' => $personenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="personen_new", methods={"GET","POST"})
     */
    public function new(Request $request, UploaderHelper $uploaderHelper): Response
    {
        $personen = new Personen();
        $form = $this->createForm(PersonenType::class, $personen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['foto']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadPersonImage($uploadedFile);
                $personen->setFoto($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personen);
            $entityManager->flush();

            return $this->redirectToRoute('personen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('personen/new.html.twig', [
            'personen' => $personen,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="personen_show", methods={"GET"})
     */
    public function show(Personen $personen): Response
    {
        return $this->render('personen/show.html.twig', [
            'personen' => $personen,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="personen_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Personen $personen, UploaderHelper $uploaderHelper): Response
    {
        $form = $this->createForm(PersonenType::class, $personen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['foto']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadPersonImage($uploadedFile);
                $personen->setFoto($newFilename);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('personen/edit.html.twig', [
            'personen' => $personen,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="personen_delete", methods={"POST"})
     */
    public function delete(Request $request, Personen $personen): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personen->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personen_index', [], Response::HTTP_SEE_OTHER);
    }
}
