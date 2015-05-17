<?php

namespace AppBundle\Command;

use AppBundle\Entity\Comercio;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncComercioCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('muni:comercio:sync')
            ->setDescription('Sincroniza los datos del comercio con los datos de la municipalidad')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = $this->getContainer()->get('doctrine.orm.entity_manager');

        $url = sprintf(
            "http://miraflores.cloudapi.junar.com/datastreams/invoke/COMER?auth_key=%s&output=json_array",
            $this->getContainer()->getParameter('muni_mira_api_key')
        );

        $client = new Client();
        $response = $client->get($url);
        $comercios = $response->json();

        foreach ($comercios['result'] as $key => $comercio) {
            if ($key==0) continue;

            $output->writeln($comercio[2]);

            $newComercio = new Comercio();
            $newComercio->setNombreComercial($comercio[1]);
            $newComercio->setNombre($comercio[2]);
            $newComercio->setNombreVia($comercio[3]);
            $newComercio->setNumeroVia($comercio[4]);
            $newComercio->setGiro($comercio[7]);
            $newComercio->setLat($comercio[9]);
            $newComercio->setLon($comercio[8]);

            $manager->persist($newComercio);

            if (0==$key%100) $manager->flush();
        }

        $manager->flush();
    }
}
