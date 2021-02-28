<?php


namespace App\Controller;


use App\Repository\ArticelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @return Response
     * @Route("/", name="app_home")
     */
    public function home(ArticelRepository $repository)
    {
        $artikel = $repository->findAll();

        return $this->render('base.html.twig', [
            'artikel' => $artikel
        ]);
    }
}