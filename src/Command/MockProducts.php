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
        $images = [
            "Watches" => [
                'http://assets.myntassets.com/assets/images/2048527/2017/10/31/11509446168515-Roadster-Unisex-Charcoal-Analogue-and-Digital-Watch-3091509446168278-1.jpg',
                'https://cdn.shopify.com/s/files/1/0627/5517/products/Chrono-S-Blue_Brown_2048x2048.jpg?v=1542911430',
                'https://cdn.shopify.com/s/files/1/0377/2037/products/GunmetalSandstoneLeather.Front.SIZE-EDIT_grande.jpg?v=1545962874'
            ],
            "Earrings" => [
                'https://cdn.shopify.com/s/files/1/0023/1512/4788/products/50962075.jpg?v=1556000567',
                'https://www.debeers.com/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/j/2/j2dd04b02w04-mfdb-aura-studs.jpg',
                'https://www.heracouture.co.nz/wp-content/uploads/2017/07/selene-gold-crystal-teardrop-earrings.jpg'
            ],
            "Rings" => [
                'https://www.padani.co.il/pub/media/catalog/product/cache/image/700x700/e9c3970ab036de70892d86c6d221abfe/2/4/241802.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/71%2BoZS9kTmL._SX425_.jpg',
                'https://img1.jeulia.com/data/product/JESY0005/1/500x500/G1-aquamarine_G2-diamond_M1-925silver.jpg'
            ],
            "Necklaces" => [
                'https://www.candere.com/media/catalog/product/cache/1/thumbnail/9df78eab33525d08d6e5fb8d27136e95/b/o/bomne101-b.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/61t7hLM1obL._UY395_.jpg',
                'https://cdn.shopify.com/s/files/1/0031/4068/1794/products/interlink-necklace-yellow-gold-p-1_460x.jpg?v=1541964125'
            ]
        ];

        for ($i = 0; $i < 20; $i++) {
            $tag = $tags[array_rand($tags)];

            $this->em->persist(
                (new Product())
                    ->setTitle("Item Title no. " . $i)
                    ->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et lorem eu elit suscipit euismod. Phasellus nisl enim, laoreet non nibh id, malesuada feugiat mi. Suspendisse euismod magna lacinia tellus iaculis ornare. Fusce eros diam, mattis at tincidunt in, euismod quis tortor. Proin dictum ipsum eu fringilla malesuada. Nulla nec eros sodales, posuere nibh et, scelerisque nisi. Integer magna ante, sollicitudin in aliquam eu, lacinia vulputate purus.")
                    ->setPrice(random_int(1, 2000) / 100.0)
                    ->setTag($tag)
                    ->setImage($images[$tag->getTitle()][random_int(0, 2)])
            );
        }

        $this->em->flush();

        $io->success('Created some random items!');
    }
}
