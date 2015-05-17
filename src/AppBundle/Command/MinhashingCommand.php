<?php

namespace AppBundle\Command;

use AppBundle\Entity\Comercio;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MinhashingCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('muni:comercio:minhash')
            ->setDescription('Minhash direccion del comercio')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = $this->getContainer()->get('doctrine.orm.entity_manager');


        $comercios = $manager
            ->getRepository(Comercio::class)
            ->findAll()
        ;

        /** @var Comercio $comercio */
        foreach ($comercios as $key => $comercio) {
            $direccion = implode(
                " ",
                [
                    $comercio->getNombreVia(),
                    $comercio->getNumeroVia()
                ]
            );

            $slug = $this->getContainer()->get('cocur_slugify')->slugify($direccion, ' ');


            $comercio->setMinhash($this->minhash($slug, 1));
            $comercio->setMinhash($this->minhash($slug, 2));

            $manager->persist($comercio);

            if (0==$key%100) $manager->flush();
        }

        $manager->flush();
    }

    public function minhash($content, $w)
    {
        $l = strlen($content);
        $hash = [];

        for($i=0; $i<=$l-$w; $i++) {
            $token = substr($content, $i, $w);
            if (!in_array($token, $hash)) {
                $hash[] = $token;
            }
        }

        return $hash;
    }
}
