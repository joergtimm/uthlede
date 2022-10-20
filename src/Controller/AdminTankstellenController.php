<?php

namespace App\Controller;

use App\Entity\Tankstellen;
use App\Form\TankstellenType;
use App\Repository\TankstellenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/tankstellen')]
class AdminTankstellenController extends AbstractController
{
    #[Route('/', name: 'app_admin_tankstellen_index', methods: ['GET'])]
    public function index(TankstellenRepository $tankstellenRepository): Response
    {
        return $this->render('admin_tankstellen/index.html.twig', [
            'tankstellens' => $tankstellenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_tankstellen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tankstellen = new Tankstellen();
        $form = $this->createForm(TankstellenType::class, $tankstellen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tankstellen);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_tankstellen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_tankstellen/new.html.twig', [
            'tankstellen' => $tankstellen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_tankstellen_show', methods: ['GET'])]
    public function show(Tankstellen $tankstellen): Response
    {
        return $this->render('admin_tankstellen/show.html.twig', [
            'tankstellen' => $tankstellen,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_tankstellen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tankstellen $tankstellen, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TankstellenType::class, $tankstellen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_tankstellen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_tankstellen/edit.html.twig', [
            'tankstellen' => $tankstellen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_tankstellen_delete', methods: ['POST'])]
    public function delete(Request $request, Tankstellen $tankstellen, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tankstellen->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tankstellen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_tankstellen_index', [], Response::HTTP_SEE_OTHER);
    }
}
