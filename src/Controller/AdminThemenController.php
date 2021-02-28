<?php


namespace App\Controller;


use App\Entity\Themen;
use App\Form\ThemenFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminThemenController extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/admin/thema/neu", name="admin_thema_neu")
     */
    public function new(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ThemenFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            /** @var Themen $thema */
            $thema = $form->getData();

            $em->persist($thema);
            $em->flush();

            $this->addFlash('success', 'Thema angelegt!');

            return $this->redirectToRoute('app_home');
        }
        return $this->render('themen/admin/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}