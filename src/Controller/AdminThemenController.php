<?php

namespace App\Controller;

use App\Entity\Themen;
use App\Form\ThemenType;
use App\Repository\ThemenRepository;
use App\Service\UploaderHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/admin/themen", name="admin_themen:")
 */
class AdminThemenController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(ThemenRepository $themenRepository): Response
    {
        return $this->render('themen/admin/index.html.twig', [
            'themens' => $themenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request, UploaderHelper $uploaderHelper): Response
    {
        $theman = new Themen();
        $form = $this->createForm(ThemenType::class, $theman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Themen $theman */
            $theman = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['bild']->getData();

            if ($uploadedFile) {

                $newFilename = $uploaderHelper->uploadThemenImage($uploadedFile);
                $theman->setBild($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($theman);
            $entityManager->flush();

            if ($request->isXmlHttpRequest()) {
                return new Response(null, 204);
            }

            return $this->redirectToRoute('admin_themen:index');
        }

        $template = $request->isXmlHttpRequest() ? '_form.html.twig' : 'new.html.twig';

        return $this->render('themen/admin/'.$template, [
            'theman' => $theman,
            'form' => $form->createView(),
        ], new Response(
            null,
            $form->isSubmitted() && !$form->isValid() ? 422 : 200
        ));
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Themen $theman): Response
    {
        return $this->render('themen/admin/show.html.twig', [
            'theman' => $theman,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Themen $theman, UploaderHelper $uploaderHelper): Response
    {
        $form = $this->createForm(ThemenType::class, $theman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Themen $theman */
            $theman = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['bild']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadArtikelImage($uploadedFile);
                $theman->setBild($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($theman);
            $entityManager->flush();

            if ($request->isXmlHttpRequest()) {
                return new Response(null, 204);
            }

            return $this->redirectToRoute('admin_themen:index');
        }

        $template = $request->isXmlHttpRequest() ? '_form.html.twig' : 'new.html.twig';

        return $this->render('themen/admin/'.$template, [
            'theman' => $theman,
            'form' => $form->createView(),
        ], new Response(
            null,
            $form->isSubmitted() && !$form->isValid() ? 422 : 200
        ));
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Themen $theman): Response
    {
        if ($this->isCsrfTokenValid('delete'.$theman->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($theman);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_themen:index');
    }
}
