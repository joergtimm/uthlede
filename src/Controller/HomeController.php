<?php


namespace App\Controller;


use App\Entity\Tankstellen;
use App\Repository\ArticelRepository;

use App\Repository\TankstellenRepository;
use App\Repository\ThemenRepository;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
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

        $adapter = New QueryAdapter($querybuilder);

        $pagerfanta = Pagerfanta::createForCurrentPageWithMaxPerPage(
            $adapter,
            $request->query->get('page', 1),
            10
        );

        return $this->render('base.html.twig', [
            'pager' => $pagerfanta,
            'themen' => $themen,
            'first' => $first
        ]);
    }

    #[Route(path: '/_tanken', name: 'app_tanken')]
    public function tankstellenAbfrage( Request $request,TankstellenRepository $tankstellenRepository, EntityManagerInterface $em): Response
    {
        $lat = '53.3089292';
        $lng = '8.6169623';
        $radius = '25';
        $type = 'all';
        $sort = 'dist';
        if ($request->query->get('radius') != null)
        {
            $radius = $request->query->get('radius');
        }

        $json = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php'
            ."?lat=$lat"     //  Breite
            ."&lng=$lng"     //               Länge
            ."&rad=$radius"  // Suchradius in km
            ."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
            ."&sort=$sort"
            ."&apikey=a2ad9604-4f9f-0021-5fb3-e8e150cb670b");   // Demo-Key ersetzen!
        $data = json_decode($json);


        foreach ($data->stations as $item)
        {

            $tanke = $tankstellenRepository->findOneBy(['tid' => $item->id]);

            if ($tanke == null )
            {
                $tanke = new Tankstellen();
                $tanke
                    ->setTid($item->id)
                    ->setName($item->name)
                    ->setBrand($item->brand)
                    ->setStreet($item->street)
                    ->setPlace($item->place)
                    ->setLat($item->lat)
                    ->setLng($item->lng)
                    ->setPostCode($item->postCode)
                ;
            }

            $tanke
                ->setDiesel($item->diesel)
                ->setE5($item->e5)
                ->setE10($item->e10)
                ->setIsOpen($item->isOpen)
                ;

            $em->persist($tanke);
            $em->flush();
        }

        $tankstellen = $tankstellenRepository->findBy(['isOpen' => true], ['diesel' => 'ASC']);

        return $this->render('_tanken-card.html.twig', [
            'tankstellen' => $tankstellen,
            'type' => $type,
            'radius' => $radius
        ]);
    }
}