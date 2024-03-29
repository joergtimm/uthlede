<?php

namespace App\Controller;

use App\Entity\Articel;
use App\Entity\ArtikelBilder;
use App\Entity\ArtikelMitwirkungen;
use App\Entity\Themen;
use App\Form\ArtikelFormType;
use App\Form\ArtikelMitwirkungType;
use App\Repository\ArticelRepository;
use App\Repository\ArtikelBilderRepository;
use App\Repository\ThemenRepository;
use App\Service\UploaderHelper;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\UX\Turbo\Stream\TurboStreamResponse;

/**
 * @Route("/admin/artikel", name="admin_artikel:")
 * @IsGranted("ROLE_ADMIN")
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

            return $this->redirectToRoute('admin_artikel:index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articel/admin/new.html.twig', [
            'articel' => $articel,
            'form' => $form,
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
    public function edit(Request $request, Articel $articel, UploaderHelper $uploaderHelper): Response
    {
        $form = $this->createForm(ArtikelFormType::class, $articel, [
            'action' => $this->generateUrl('admin_artikel:edit', [
                'id' => $articel->getId()
            ])
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['bild']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadArtikelImage($uploadedFile);
                $articel->setBild($newFilename);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_artikel:index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articel/admin/edit.html.twig', [
            'articel' => $articel,
            'form' => $form,
            'formTarget' => $request->headers->get('Turbo-Frame'),
            'mitwirkungen' => $articel->getArtikelMitwirkungens()
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
        $entityManager = $this->getDoctrine()->getManager();

        $bilder = $articel->getArtikelBilders();

        foreach ( $bilder as $bild )
        {
            $entityManager->remove($bild);
            $entityManager->flush();
        }

        $comments = $articel->getComments();

        foreach ( $comments as $comment )
        {
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        if ($this->isCsrfTokenValid('delete'.$articel->getId(), $request->request->get('_token'))) {

            $entityManager->remove($articel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_artikel:index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/mitwirkung/{id}/del", name="mitwirkung_delete", methods={"POST"})
     */
    public function deleteMitwirkung(Request $request, ArtikelMitwirkungen $artikelMitwirkungen): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $artikel = $artikelMitwirkungen->getArtikel();

        if ($this->isCsrfTokenValid('delete'.$artikelMitwirkungen->getId(), $request->request->get('_token'))) {

            $entityManager->remove($artikelMitwirkungen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_artikel:edit', [ 'id' => $artikel->getId() ], Response::HTTP_SEE_OTHER);
    }

    /**
     * @param Articel $articel
     * @param Request $request
     * @return Response
     * @Route("/admin/mitwirkung/{id}/add", name="mittwirkung_add")
     */
    public function newMitwirkung( Articel $articel, Request $request ): Response
    {
        $mitwirkung = new ArtikelMitwirkungen();


        $form = $this->createForm(ArtikelMitwirkungType::class, $mitwirkung, [
            'action' => $this->generateUrl('admin_artikel:mittwirkung_add', [
                'id' => $articel->getId()
            ])
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var ArtikelMitwirkungen $mitwirkung */
            $mitwirkung = $form->getData();
            $mitwirkung->setArtikel($articel);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mitwirkung);
            $entityManager->flush();

            // 🔥 The magic happens here! 🔥
            if (TurboStreamResponse::STREAM_FORMAT === $request->getPreferredFormat()) {
                // If the request comes from Turbo, only send the HTML to update using a TurboStreamResponse
                return $this->render('articel/admin/mitwirkung.success.stream.html.twig', ['mitwirkung' => $mitwirkung], new TurboStreamResponse());
            }

            return $this->redirectToRoute('admin_artikel:edit', [ 'id' => $articel->getId() ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('articel/admin/mitwirkung_form.html.twig', [
            'form' => $form,
            'artikel' => $articel
        ]);
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
            ], Response::HTTP_SEE_OTHER);
    }

}
