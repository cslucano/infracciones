<?php

namespace AppBundle\Command;

use AppBundle\Entity\Comercio;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MinhashFindCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('muni:comercio:minhash:find')
            ->setDescription('Minhash find')
            ->addArgument("direccion", InputArgument::REQUIRED, "Ingrese la dirección")
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = $this->getContainer()->get('doctrine.orm.entity_manager');


        $comercios = $manager
            ->getRepository(Comercio::class)
            ->findAll()
        ;

        $direccion = $input->getArgument('direccion');
        $slug = $this->getContainer()->get('cocur_slugify')->slugify($direccion, ' ');
        $newComercio = new Comercio();
        $newComercio->setMinhash($this->minhash($slug, 1));
        $newComercio->setMinhash($this->minhash($slug, 2));

        $weight = [];

        /** @var Comercio $comercio */
        foreach ($comercios as $key => $comercio) {
            $intersect = count(array_intersect($comercio->getMinhash(), $newComercio->getMinhash()));
            $diffa = count(array_diff($comercio->getMinhash(), $newComercio->getMinhash()));
            $diffb = count(array_diff($newComercio->getMinhash(), $comercio->getMinhash()));

            if(0 === $diffa + $diffb) {
                $weight[$comercio->getId().''] = null;
            } else {
                $weight[$comercio->getId().''] = $intersect/($diffa+$diffb);
            }
        }

        arsort($weight);
        var_dump($weight);
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
