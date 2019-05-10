<?php

namespace App\Command;

use App\Entity\ProductTag;
use App\Repository\ProductTagRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MockProductTags extends Command
{
    private $em;
    protected static $defaultName = 'app:database:mock:tags';

    public function __construct(ObjectManager $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setDescription('Fills the database with test data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $this->em->persist(
            (new ProductTag())->setTitle("Watches")
        );
        $this->em->persist(
            (new ProductTag())->setTitle("Rings")
        );
        $this->em->persist(
            (new ProductTag())->setTitle("Necklaces")
        );
        $this->em->persist(
            (new ProductTag())->setTitle("Earrings")
        );
        $this->em->flush();

        $io->success('Created default tags!');
    }
}
