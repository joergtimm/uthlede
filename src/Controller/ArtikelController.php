<?php

namespace App\Controller;

use App\Entity\Articel;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Repository\ArticelRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @return Response
     * @Route("/artikel", name="app_artikel_list")
     */
    public function list( Request $request, PaginatorInterface $paginator, ArticelRepository $repository): Response
    {
        $searchTerm = $request->query->get('q');
        $querybuilder = $repository->listQueryBuilder($searchTerm);

        $pagination = $paginator->paginate(
            $querybuilder,
            $request->query->getInt('page', 1),
            10
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

        return $this->render('articel/artikel_list.html.twig', [
            'artikels' => $pagination
        ]);
    }

    /**
     * @param Request $request
     * @param Articel $articel
     * @return Response
     * @Route("/artikel/{slug}", name="app_artikel_view")
     */
    public function view( Request $request, Articel $articel ): Response
    {
        $comment = new Comments();
        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreateAt(new \DateTimeImmutable('now'));
            $comment->setAuthor($this->getUser());
            $comment->setArticel($articel);
            $comment->setIsVisible(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('app_artikel_view', [
                'slug' => $articel->getSlug()
            ]);

        }
        $bilder = $articel->getArtikelBilders();
        $comments = $articel->getComments();

        return $this->renderForm('articel/artikel_view.html.twig', [
            'artikel' => $articel,
            'bilder' => $bilder,
            'comments' => $comments,
            'form' => $form
        ]);
    }
}