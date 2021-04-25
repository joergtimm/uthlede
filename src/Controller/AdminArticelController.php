<?php

namespace App\Controller;

use App\Entity\Articel;
use App\Form\ArticelType;
use App\Form\ArtikelFormType;
use App\Repository\ArticelRepository;
use App\Service\UploaderHelper;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/admin/artikel", name="admin_artikel:")
 */
class AdminArticelController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, ArticelRepository $articelRepository, PaginatorInterface $paginator): Response
    {
        $q = $request->query->get('q');
        $querybuilder = $articelRepository->listQueryBuilder($q);

        $pagination = $paginator->paginate(
            $querybuilder,
            $request->query->getInt('page', 1),
            20
        );

        $pagination->setCustomParameters([
            'position' => 'centered'
        ]);

        return $this->render('articel/admin/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request, UploaderHelper $uploaderHelper): Response
    {
        $articel = new Articel();
        $form = $this->createForm(ArtikelFormType::class, $articel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Articel $articel */
            $articel = $form->getData();
            $articel->setCreateAt(new \DateTime());

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['bild']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadArtikelImage($uploadedFile);
                $articel->setBild($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articel);
            $entityManager->flush();

            return $this->redirectToRoute('admin_artikel:index');
        }

        return $this->render('articel/admin/new.html.twig', [
            'articel' => $articel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Articel $articel): Response
    {
        return $this->render('articel/admin/show.html.twig', [
            'articel' => $articel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Articel $articel): Response
    {
        $form = $this->createForm(ArticelType::class, $articel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_artikel:index');
        }

        return $this->render('articel/admin/edit.html.twig', [
            'articel' => $articel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Articel $articel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_artikel:index');
    }
}
