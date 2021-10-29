<?php

namespace App\Controller;

use App\Entity\Articel;
use App\Entity\ArtikelBilder;
use App\Entity\Themen;
use App\Form\ArtikelFormType;
use App\Repository\ArticelRepository;
use App\Repository\ArtikelBilderRepository;
use App\Repository\ThemenRepository;
use App\Service\UploaderHelper;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

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
        $t = $request->query->get('t');

        $querybuilder = $articelRepository->listQueryBuilder($q, $t);

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
     * @Route("/import", name="import", methods={"GET","POST"})
     * @throws Exception
     */
    public function import(ThemenRepository $themenRepository, SluggerInterface $slugger): Response
    {


        $file = '/home/joergtimm/Dokumente/Entwicklung/XShoot/uthlede/public/old/news.json';

        $newsjson = file_get_contents($file);
        $json = json_decode($newsjson, true);


        $zaehler = 0;
        $em = $this->getDoctrine()->getManager();

        $fs = new Filesystem();

        foreach ($json as $key => $value) {
            $artikel = new Articel();


            $artikel
                ->setCreateAt(new DateTimeImmutable('now'));

            $datum = date_create(($value['datum']));

            if ($datum)
            {
                $artikel->setDatum($datum);
            }
            $artikel
                ->setHaupttext($value['text'])
                ->setTitel($value['titel'])
                ->setOldId($value['id'])
                ->setSlug($slugger->slug($value['titel']))
            ;

            $thema = $themenRepository->findOneBy(['titel' => $value['thema']]);

            if (!$thema) {
                $thema = new Themen();
                $thema
                    ->setTitel($value['thema'])
                    ->setSlug($slugger->slug($value['thema']));

                $em->persist($thema);
                $em->flush();
            }

            $artikel->setThema($thema);

            if($value['bild'] != '')
            {
                $file = 'https://uthlede.de/neu/'.$value['bild'];
                $newFile = $slugger->slug(uniqid('artikelbild', true));

                if ( copy($file, '/home/joergtimm/Dokumente/Entwicklung/XShoot/uthlede/public/uploads/artikel_image/'.$newFile.'.jpg') ) {
                    $artikel->setBild($newFile.'.jpg');
                }

            }

            $em->persist($artikel);
            $em->flush();

        }


        return $this->redirectToRoute('admin_artikel:index');
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request, UploaderHelper $uploaderHelper): Response
    {
        $articel = new Articel();
        $form = $this->createForm(ArtikelFormType::class, $articel,[
            'action' => $this->generateUrl('admin_artikel:new')
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Articel $articel */
            $articel = $form->getData();
            $articel->setCreateAt(new DateTime());

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
        $form = $this->createForm(ArtikelFormType::class, $articel, [
            'action' => $this->generateUrl('admin_artikel:edit', [
                'id' => $articel->getId()
            ])
        ]);
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
     * @Route("/{id}/bilder", name="bilder", methods={"GET","POST"})
     */
    public function bilder( Articel $articel, ArtikelBilderRepository $bilderRepository ): Response
    {

        $abilder = $bilderRepository->findByArtikel($articel);
        return $this->render('articel/admin/bilder.html.twig', [
            'artikel' => $articel,
            'abilder' => $abilder
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

    /**
     * @param Articel $articel
     * @param Request $request
     * @param UploaderHelper $uploaderHelper
     * @return Response
     * @Route("/bild/{id}/add", name="admin_bild_add")
     */
    public function addFotos( Articel $articel, Request $request, UploaderHelper $uploaderHelper): Response
    {

        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('file');

        if ($uploadedFile) {

            $image = new ArtikelBilder();
            $image
                ->setCreateAt(new DateTimeImmutable())
                ->setArtikel($articel)
                ->setFilename($uploaderHelper->uploadArtikelImage($uploadedFile));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($image);
            $entityManager->flush();

            return $this->redirectToRoute('admin_artikel:show', [
                'id' => $articel->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->redirectToRoute('admin_artikel:index', [
            'current' => $articel->getId()
        ]);
    }

    /**
     * @param Articel $articel
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @Route("/admin/artikel/{id}/_sort", name="admin_artikelbilder_sort")
     */
    public function sort( Articel $articel, Request $request, EntityManagerInterface $em): Response
    {
        $orderedIds = json_decode($request->getContent(), true);
        if ($orderedIds === null) {
            return $this->redirectToRoute('admin_artikel:show', [
                'id' => $articel->getId()
            ]);
        }

        // from (position)=>(id) to (id)=>(position)
        $orderedIds = array_flip($orderedIds);
        foreach ($articel->getArtikelBilders() as $artikelBilder) {
            $artikelBilder->setPosition($orderedIds[$artikelBilder->getId()]);
        }

        $em->flush();

            return $this->redirectToRoute('admin_artikel:show', [
                'id' => $articel->getId()
            ]);
    }

}
