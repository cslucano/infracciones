<?php

namespace AppBundle\Command;

use AppBundle\Entity\Comercio;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MinhashWeightCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('muni:comercio:minhash:weight')
            ->setDescription('Minhash weight')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = $this->getContainer()->get('doctrine.orm.entity_manager');

        $comercios = $manager
            ->getRepository(Comercio::class)
            ->findAll()
        ;

        $weight = [];
        /** @var Comercio $comercioA */
        foreach ($comercios as $keyA => $comercioA) {
            /** @var Comercio $comercioB */
            foreach ($comercios as $keyB => $comercioB) {
                if($comercioA->getId()>$comercioB->getId()) {
                    if(!array_key_exists($comercioA->getId(), $weight)) {
                        $weight[$comercioA->getId()] = [];
                    }
                    if(!array_key_exists($comercioB->getId(), $weight[$comercioA->getId()])) {
                        $intersect = count(array_intersect($comercioA->getMinhash(), $comercioB->getMinhash()));
                        $diffa = count(array_diff($comercioA->getMinhash(), $comercioB->getMinhash()));
                        $diffb = count(array_diff($comercioB->getMinhash(), $comercioA->getMinhash()));

                        if(0 === $diffa + $diffb) {
                            $weight[$comercioA->getId()][$comercioB->getId()] = null;
                        } else {
                            $weight[$comercioA->getId()][$comercioB->getId()] = $intersect/($diffa+$diffb);
                        }
                    }
                }
            }
        }

        $weight_filename = __DIR__.'/../Resources/weight.json';

        file_put_contents($weight_filename, json_encode($weight));
    }
}
