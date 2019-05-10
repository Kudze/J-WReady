<?php

namespace App\Command;

use App\Entity\Product;
use App\Entity\ProductTag;
use App\Repository\ProductTagRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MockProducts extends Command
{
    private $em;
    protected static $defaultName = 'app:database:mock:products';

    public function __construct(ObjectManager $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setDescription('Fills the database with test data');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $tags = $this->em->getRepository(ProductTag::class)->findAll();

        for ($i = 0; $i < 20; $i++)
            $this->em->persist(
                (new Product())
                    ->setTitle("Item Title, but no. " . $i)
                    ->setDescription("Good description....")
                    ->setPrice(random_int(1, 2000) / 100.0)
                    ->setTag($tags[array_rand($tags)])
            );

        $this->em->flush();

        $io->success('Created some random items!');
    }
}
