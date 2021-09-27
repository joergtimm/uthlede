<?php


namespace App\Controller;


use App\Repository\ArticelRepository;

use App\Repository\ThemenRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @param ArticelRepository $repository
     * @param ThemenRepository $themenRepository
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     * @Route("/", name="app_home")
     */
    public function home( ArticelRepository $repository, ThemenRepository $themenRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $q = $request->query->get('q');
        $querybuilder = $repository->listQueryBuilder($q);
        $themen = $themenRepository->listThemen();

        $pagination = $paginator->paginate(
            $querybuilder,
            $request->query->getInt('page', 1),
            20
        );

        $pagination->setCustomParameters([
            'position' => 'centered'
        ]);

        return $this->render('base.html.twig', [
            'artikels' => $pagination,
            'themen' => $themen
        ]);
    }
}