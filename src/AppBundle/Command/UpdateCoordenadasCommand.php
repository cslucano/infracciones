<?php

namespace AppBundle\Command;

use AppBundle\Entity\Infraccion;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

class UpdateCoordenadasCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('infraccion:update')
            ->setDescription('Actualizar coordenadas de las infracciones')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var EntityManager $manager */
        $manager = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        $repo = $manager->getRepository(Infraccion::class);

        $finder = new Finder();

        $finder->files()->name('coordenadas.csv')->in('src/AppBundle/Resources');

        foreach($finder as $file) {
            $path = $file->getRealpath();
        }

        $csv = file_get_contents($path);
        $csv = trim($csv);

        $lines = explode(PHP_EOL, $csv);

        foreach ($lines as $line) {

            $data = explode(',', $line);
            /** @var Infraccion $infraccion */
            $infraccion = $repo->findOneBy(['nroActa' => $data[0]]);

            if ($infraccion) {
                $infraccion->setLat($data[1]);
                $infraccion->setLon($data[2]);

                $manager->persist($infraccion);
                $manager->flush();
            }
        }

    }
}