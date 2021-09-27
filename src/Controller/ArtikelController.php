<?php

namespace App\Controller;

use App\Entity\Articel;
use App\Repository\ArticelRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtikelController extends AbstractController
{

    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param ArticelRepository $repository
     * @return Response|void
     * @Route("/artikel", name="app_artikel_list")
     */
    public function list( Request $request, PaginatorInterface $paginator, ArticelRepository $repository)
    {
        $searchTerm = $request->query->get('q');
        $querybuilder = $repository->listQueryBuilder($searchTerm);

        $pagination = $paginator->paginate(
            $querybuilder,
            $request->query->getInt('page', 1),
            20
        );

        $pagination->setCustomParameters([
            'position' => 'centered'
        ]);

        if ($request->query->get('preview')) {
            return $this->render('articel/_searchPreview.html.twig', [
                'items' => $pagination,
                'searchTerm' => $searchTerm
            ]);
        }
    }

    /**
     * @param Articel $articel
     * @return Response
     * @Route("/artikel/{slug}", name="app_artikel_view")
     */
    public function view( Articel $articel ): Response
    {
        return $this->render('articel/artikel_view.html.twig', [
            'artikel' => $articel
        ]);
    }
}