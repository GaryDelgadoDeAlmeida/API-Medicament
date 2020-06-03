<?php

namespace App\Command;

ini_set('memory_limit', '1024M'); // or you could use 1G

use App\Manager\FileManager;
use Manager\PageLinkManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportPageLinkCommand extends Command
{
    protected static $defaultName = 'app:import:page-link';
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
        $filePath = !empty($input->getArgument('filePath')) ? $input->getArgument('filePath') : "./public/content/file/lien_avis_commission/HAS_LiensPageCT_bdpm.txt";
        $pageLinkTab = FileManager::getDataFromFile($filePath, "page-link");
        empty(end($pageLinkTab)[0]) ? array_pop($pageLinkTab) : null;
        $initialLength = count($pageLinkTab);
        $totalSavedData = PageLinkManager::insertPageLinkToDatabase($pageLinkTab, $this->manager);

        $io->success($initialLength . ' éléments trouvés; ' . $totalSavedData["saved"] . ' insertions; '. $totalSavedData["updated"] .' mise à jour effectuées.');

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }
}
