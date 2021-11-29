<?php


namespace App\Controller;


use App\Repository\ArticelRepository;

use App\Repository\ThemenRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
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

        $tanken = file_get_contents('https://creativecommons.tankerkoenig.de/json/detail.php?id=3704135c-0d7e-4c76-8346-882f1b60209c&apikey=a2ad9604-4f9f-0021-5fb3-e8e150cb670b');
        $wetter = file_get_contents('https://api.openweathermap.org/data/2.5/weather?lat=53.3083858&lon=8.5799913&appid=e41ef1f8c16718e72188ac8b2ef82a92');

        $wetter_array = json_decode($wetter);

        // dd(json_decode($tanken, true));

        $cookie_ok = $request->cookies->get('first');
        $first = true;

        /*
        if (!$cookie_ok)
        {
            $first = false;
            $cookie = Cookie::create('first')
                ->withValue('ok')
                ->withExpires(time() + ( 2 * 365 * 24 * 60 * 60))
                ->withDomain('.uthlede.de')
                ->withSecure(true);

            $res = new Response();
            $res->headers->setCookie( $cookie );
            $res->send();
        }

        */


        $q = $request->query->get('q');
        $querybuilder = $repository->listQueryBuilder($q);
        $themen = $themenRepository->listThemen();

        $pagination = $paginator->paginate(
            $querybuilder,
            $request->query->getInt('page', 1),
            15
        );

        $pagination->setCustomParameters([
            'position' => 'right'
        ]);

        return $this->render('base.html.twig', [
            'artikels' => $pagination,
            'themen' => $themen,
            'first' => $first
        ]);
    }
}