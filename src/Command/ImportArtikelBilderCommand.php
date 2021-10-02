<?php

namespace App\Command;

use App\Entity\Articel;
use App\Entity\ArtikelBilder;
use App\Repository\ArticelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\String\Slugger\SluggerInterface;

class ImportArtikelBilderCommand extends Command
{
    private EntityManagerInterface $em;
    private ArticelRepository $articelRepository;
    private SluggerInterface $slugger;

    public function __construct(string $name = null, EntityManagerInterface $em, ArticelRepository $articelRepository, SluggerInterface $slugger)
    {
        parent::__construct($name);
        $this->em = $em;
        $this->articelRepository = $articelRepository;
        $this->slugger = $slugger;
    }

    protected static $defaultName = 'app:import:artikel:bilder';
    protected static $defaultDescription = 'Add a short description for your command';

    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::OPTIONAL, 'Argument description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $file = $input->getArgument('file');

        if ($file) {
            $io->note(sprintf('Datei : %s', $file));
        }


        $file = '/home/joergtimm/Dokumente/Entwicklung/XShoot/uthlede/public/old/bilder.json';

        $newsjson = file_get_contents($file);

        $json = json_decode($newsjson, true);

        foreach ($json as $key => $value) {
            if($value['art'] == 'news') {
                /** @var Articel $artikel */
                $artikel = $this->articelRepository->findOneBy(['oldId' => $value['galerie']]);

                if ($artikel) {
                    $file = 'https://uthlede.de/neu/' . $value['url'];
                    $newFile = $this->slugger->slug(uniqid('artikel-gal-bild', true));

                    if (copy($file, '/home/joergtimm/Dokumente/Entwicklung/XShoot/uthlede/public/uploads/artikel_image/' . $newFile . '.jpg')) {


                        $bild = new ArtikelBilder();
                        $bild
                            ->setArtikel($artikel)
                            ->setCreateAt(new \DateTimeImmutable('now'))
                            ->setFilename($newFile . '.jpg');

                        $this->em->persist($bild);
                        $this->em->flush();

                        $io->note($bild->getImagePath());
                    }

                }
            }

    }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
