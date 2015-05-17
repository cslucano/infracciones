<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Infraccion;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Finder\Finder;

class LoadInfraccionData extends ContainerAware implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $finder = new Finder();
        $finder->files()->name('infracciones.json')->in('src/AppBundle/Resources');

        foreach ($finder as $file) {
            $path = $file->getRealpath();
        }

        $data = json_decode(file_get_contents($path), true);

        foreach ($data['result'] as $key => $value) {
            if($key==0) continue;
            $infraccion = new Infraccion();

            $infraccion->setYear($value[0]);
            $infraccion->setNumero($value[1]);
            $infraccion->setNroActa($value[2]);
            $infraccion->setCodInfraccion($value[3]);
            $fecha = date_create_from_format('d/m/Y H:i', $value[8] . ' ' . $value[24]);
            $infraccion->setFechaInfraccion(($fecha) ?: null);
            $infraccion->setHora(($fecha) ? 1.0 * $fecha->format("H") + $fecha->format('i') / 60.0 : null);
            $infraccion->setPlaca($value[13]);
            $infraccion->setDireccion($value[16]);
            $infraccion->setCuadra($value[17]);
            $infraccion->setLat(null);
            $infraccion->setLon(null);

            $manager->persist($infraccion);

            if(0==$key%100) $manager->flush();
        }

        $manager->flush();
    }
}