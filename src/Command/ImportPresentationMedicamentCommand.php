<?php

namespace App\Command;

ini_set('memory_limit', '1024M'); // or you could use 1G

use App\Manager\FileManager;
use App\Manager\PresentationManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportPresentationMedicamentCommand extends Command
{
    protected static $defaultName = 'app:import:presentation';

    public function __construct(EntityManagerInterface $manager) {
        parent::__construct();
        $this->manager = $manager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('filePath', InputArgument::OPTIONAL, 'Path of the selected presentation of medication file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filePath = !is_null($input->getArgument('filePath')) ? $input->getArgument('filePath') : './public/content/file/presentation/CIS_CIP_bdpm.txt';
        $presentationArray = FileManager::getDataFromFile($filePath, "presentation");
        empty(end($presentationArray)[0]) ? array_pop($presentationArray) : null;
        $initialLength = count($presentationArray);
        $totalSavedData = PresentationManager::insertPresentationToDatabase($presentationArray, $this->manager);

        $io->success('Il y a ' . $initialLength . ' présentations trouvés et ' . $totalSavedData["saved"] . ' nouvelles boîtes de présentation ont étés ajoutées et '. $totalSavedData["updated"] .' mise à jour a été effectuées dans la database.');

        return 0;
    }
}
