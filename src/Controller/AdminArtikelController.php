<?php


namespace App\Controller;



use App\Entity\Articel;
use App\Form\ArtikelFormType;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/artikel", name="admin_artikel.")
 */
class AdminArtikelController extends AbstractController
{
    /**
     * @param Request $request
     * @param UploaderHelper $uploaderHelper
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     * @Route("/neu", name="neu")
     */
    public function new(Request $request, UploaderHelper $uploaderHelper, EntityManagerInterface $em)
    {
        $form = $this->createForm(ArtikelFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Articel $articel */
            $articel = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['bild']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadArtikelImage($uploadedFile);
                $articel->setBild($newFilename);
            }

            $articel->setCreateAt(new \DateTime());

            $em->persist($articel);
            $em->flush();

            $this->addFlash('success', 'Artikel angelegt!');

            return $this->redirectToRoute('app_home');
        }
        return $this->render('artikel/admin/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Articel $articel
     * @param Request $request
     * @param UploaderHelper $uploaderHelper
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     * @Route("/{slug}/edit", name="edit")
     */
    public function edit(Articel $articel, Request $request, UploaderHelper $uploaderHelper, EntityManagerInterface $em)
    {
        $form = $this->createForm(ArtikelFormType::class, $articel);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Articel $articel */
            $articel = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['bild']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadArtikelImage($uploadedFile);
                $articel->setBild($newFilename);
            }


            $em->persist($articel);
            $em->flush();

            $this->addFlash('success', 'Artikel geändert!');

            return $this->redirectToRoute('app_home');
        }
        return $this->render('artikel/admin/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}