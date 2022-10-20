<?php

namespace App\Controller;

use App\Entity\Vereine;
use App\Form\VereineType;
use App\Repository\VereineRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/vereine/admin')]
class AdminVereineController extends AbstractController
{
    #[Route('/', name: 'admin_vereine_index', methods: ['GET'])]
    public function index(VereineRepository $vereineRepository): Response
    {
        return $this->render('vereine_admin/index.html.twig', [
            'vereines' => $vereineRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_vereine_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UploaderHelper $uploaderHelper): Response
    {
        $vereine = new Vereine();
        $form = $this->createForm(VereineType::class, $vereine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Vereine $vereine */
            $vereine = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['logo']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadVereinsLogo($uploadedFile);
                $vereine->setLogo($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vereine);
            $entityManager->flush();

            return $this->redirectToRoute('admin_vereine_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('vereine_admin/new.html.twig', [
            'vereine' => $vereine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_vereine_show', methods: ['GET'])]
    public function show(Vereine $vereine): Response
    {
        return $this->render('vereine_admin/show.html.twig', [
            'vereine' => $vereine,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_vereine_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vereine $vereine, EntityManagerInterface $entityManager, UploaderHelper $uploaderHelper): Response
    {
        $form = $this->createForm(VereineType::class, $vereine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Vereine $vereine */
            $vereine = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['logo']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadVereinsLogo($uploadedFile);
                $vereine->setLogo($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vereine);
            $entityManager->flush();

            return $this->redirectToRoute('admin_vereine_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vereine_admin/edit.html.twig', [
            'vereine' => $vereine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_vereine_delete', methods: ['POST'])]
    public function delete(Request $request, Vereine $vereine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vereine->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vereine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_vereine_index', [], Response::HTTP_SEE_OTHER);
    }
}
