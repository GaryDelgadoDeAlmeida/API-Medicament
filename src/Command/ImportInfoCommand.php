<?php

namespace App\Command;

ini_set('memory_limit', '1024M'); // or you could use 1G

use App\Manager\FileManager;
use Manager\InfoImportantManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportInfoCommand extends Command
{
    protected static $defaultName = 'app:import:info';

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
        $filePath = !empty($input->getArgument('filePath')) ? $input->getArgument('filePath') : './public/content/file/info_important/CIS_InfoImportantes_20200501225926_bdpm.txt';
        $infoImportant = FileManager::getDataFromFile($filePath, "info_important");
        empty(end($infoImportant)[0]) ? array_pop($infoImportant) : null;
        $initialLength = \count($infoImportant);
        $totalSavedData = InfoImportantManager::insertInfoToDatabase($infoImportant, $this->manager);

        $io->success($initialLength . ' éléments trouvés; ' . $totalSavedData["saved"] . ' insertions; '. $totalSavedData["updated"] .' mise à jour effectuées.');

        return 0;
    }
}
