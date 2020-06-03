<?php

namespace App\Command;

ini_set('memory_limit', '1024M'); // or you could use '1G'

use Manager\AvisManager;
use App\Manager\FileManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportAvisSmrCommand extends Command
{
    protected static $defaultName = 'app:import:avis-smr';
    private $manager;

    public function __construct(EntityManagerInterface $manager) {
        parent::__construct();
        $this->manager = $manager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('filePath', InputArgument::OPTIONAL, 'Argument description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filePath = !empty($input->getArgument('filePath')) ? $input->getArgument('filePath') : './public/content/file/avis_smr_has/CIS_HAS_SMR_bdpm.txt';
        $avisSMR = FileManager::getDataFromFile($filePath, "smr");
        empty(end($avisSMR)[0]) ? array_pop($avisSMR) : null;
        $initialLength = count($avisSMR);
        $totalSavedData = AvisManager::insertSMRToDatabase($avisSMR, $this->manager);

        $io->success('Il y a ' . $initialLength . ' avis smr trouvés et ' . $totalSavedData["saved"] . ' nouveaux avis smr ont étés ajoutées et '. $totalSavedData["updated"] .' mises à jour ont été effectuées dans la database.');

        return 0;
    }
}
