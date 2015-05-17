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
            ->addArgument("numero", InputArgument::REQUIRED, "Ingrese el numero")
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $repo = $manager->getRepository(Comercio::class);

        $comercios = $repo->findAll();

        $direccion = $input->getArgument('direccion');
        $numero = $input->getArgument('numero');
        $direccion = implode(' ', [$direccion, $numero]);

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

            if(0 === ($diffa + $diffb)) {
                $weight[$comercio->getId().''] = null;
            } else {
                $weight[$comercio->getId().''] = $intersect/($diffa+$diffb);
            }
        }

        arsort($weight);
        $first = $repo->find(array_keys($weight)[0]);
        for($i=1;$i<count($weight);$i++){
            $second = $repo->find(array_keys($weight)[$i]);
            if(
                $first->getNombreVia() == $second->getNombreVia() &&
                $first->getNumeroVia() != $second->getNumeroVia())
            {
                break;
            } elseif ($first->getNombreVia() != $second->getNombreVia()) {
                break;
            }
        }

        if($first->getNombreVia() == $second->getNombreVia()) {
            $deltanum = $first->getNumeroVia() - $second->getNumeroVia();
            $output->writeln(sprintf('%s %s %s %s', $first->getId(), $second->getId(), $first->getNumeroVia(), $second->getNumeroVia()));
            $deltalat = ($first->getLat() - $second->getLat())/$deltanum;
            $deltalon = ($first->getLon() - $second->getLon())/$deltanum;

            $newComercio->setLat($first->getLat() + ($first->getNumeroVia() - $numero) * $deltalat);
            $newComercio->setLon($first->getLon() + ($first->getNumeroVia() - $numero) * $deltalon);
        } else {
            $newComercio->setLat($first->getLat());
            $newComercio->setLon($first->getLon());
        }

        $output->writeln('Latitud: ' . $newComercio->getLat());
        $output->writeln('Longitud: ' . $newComercio->getLon());

        $googlemapsurl = sprintf('https://www.google.com.pe/maps/@%s,%s,15z?hl=en', $newComercio->getLat(), $newComercio->getLon());
        $output->writeln('GoogleMaps: ' . $googlemapsurl);
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
