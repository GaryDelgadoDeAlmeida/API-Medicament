<?php

namespace App\Command;

ini_set('memory_limit', '1024M'); // or you could use 1G

use App\Manager\FileManager;
use App\Manager\CompositionManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCompositionCommand extends Command
{
    protected static $defaultName = 'app:import:composition';
    private $manager;

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
        $filePath = !is_null($input->getArgument('filePath')) ? $input->getArgument('filePath') : './public/content/file/composition/CIS_COMPO_bdpm.txt';
        $compositions = FileManager::getDataFromFile($filePath, 'composition');
        empty(end($compositions)[0]) ? array_pop($compositions) : null;
        $initialLength = count($compositions);
        $totalSavedData = CompositionManager::insertCompositionToDatabase($compositions, $this->manager);
        
        $io->note(sprintf('You passed an argument: %s', $filePath));
        $io->success('Il y a ' . $initialLength . ' compositions trouvés et ' . $totalSavedData["saved"] . ' nouvelles compositions ont étés ajoutées et '. $totalSavedData["updated"] .' compositions ont été mise à jour à la database.');

        return 0;
    }
}
