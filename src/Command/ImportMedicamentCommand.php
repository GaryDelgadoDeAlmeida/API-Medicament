<?php

namespace App\Command;

ini_set('memory_limit', '1024M'); // or you could use 1G

use App\Entity\Medicament;
use App\Manager\FileManager;
use Doctrine\ORM\EntityManager;
use App\Manager\MedicamentManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportMedicamentCommand extends Command
{
    protected static $defaultName = 'app:import:medicament';
    private $manager;

    public function __construct(EntityManagerInterface $manager) {
        parent::__construct();
        $this->manager = $manager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Select a file who contains medicament and import all of then into database.')
            ->addArgument('filePath', InputArgument::OPTIONAL, 'Path of the selected medicament file')
            // ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filePath = !is_null($input->getArgument('filePath')) ? $input->getArgument('filePath') : './public/content/file/medicaments/CIS_bdpm.txt';
        $medicamentTab = FileManager::getDataFromFile($filePath, "medicament");
        empty(end($medicamentTab)[0]) ? array_pop($medicamentTab) : null;
        $initialLength = count($medicamentTab);
        $totalSavedData = MedicamentManager::insertMedicamentToDatabase($medicamentTab, $this->manager);

        $io->success('Il y a ' . $initialLength . ' médicaments trouvés et ' . $totalSavedData["saved"] . ' nouveaux médicaments ont étés ajoutées et '. $totalSavedData["updated"] .' médicament ont été mise à jour à la database.');
        return 0;
    }
}
