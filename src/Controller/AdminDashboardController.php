<?php


namespace App\Controller;


use App\Repository\CommentsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminDashboardController
 * @package App\Controller
 * @Route("/admin", name="admin:")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function dashboard( CommentsRepository $commentsRepository ): \Symfony\Component\HttpFoundation\Response
    {
        $kommentare = $commentsRepository->findInactive();

        return $this->render('admin_base.html.twig', [
            'kommentare' => $kommentare
        ]);
    }
}