<?php

namespace App\Command;

ini_set('memory_limit', '1024M'); // or you could use 1G

use App\Manager\FileManager;
use Manager\PrescriptionManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportPrescriptionConditionCommand extends Command
{
    protected static $defaultName = 'app:import:prescription-condition';
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
        $filePath = !is_null($input->getArgument('filePath')) ? $input->getArgument('filePath') : './public/content/file/condition_prescription/CIS_CPD_bdpm.txt';
        $prescriptionArray = FileManager::getDataFromFile($filePath, "prescription");
        empty(end($prescriptionArray)[0]) ? array_pop($prescriptionArray) : null;
        $initialLength = count($prescriptionArray);
        $totalSavedData = PrescriptionManager::insertPrescriptionToDatabase($prescriptionArray, $this->manager);

        $io->success('Il y a ' . $initialLength . ' prescriptions trouvés et ' . $totalSavedData["saved"] . ' nouvelles prescriptions ont étés ajoutées et '. $totalSavedData["updated"] .' mise à jour a été effectuées dans la database.');
        return 0;
    }
}
