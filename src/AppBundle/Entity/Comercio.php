<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comercio
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ComercioRepository")
 */
class Comercio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_comercial", type="string", length=255)
     */
    private $nombreComercial;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_via", type="string", length=255)
     */
    private $nombreVia;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_via", type="string", length=255)
     */
    private $numeroVia;

    /**
     * @var string
     *
     * @ORM\Column(name="giro", type="string", length=255)
     */
    private $giro;

    /**
     * @var float
     *
     * @ORM\Column(name="lon", type="float")
     */
    private $lon;

    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="float")
     */
    private $lat;

    /**
     * @var array
     *
     * @ORM\Column(name="minhash", type="array", nullable=true)
     */
    private $minhash;

    public function __construct()
    {
        $this->minhash = [];
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombreComercial
     *
     * @param string $nombreComercial
     *
     * @return Comercio
     */
    public function setNombreComercial($nombreComercial)
    {
        $this->nombreComercial = $nombreComercial;

        return $this;
    }

    /**
     * Get nombreComercial
     *
     * @return string
     */
    public function getNombreComercial()
    {
        return $this->nombreComercial;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Comercio
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set nombreVia
     *
     * @param string $nombreVia
     *
     * @return Comercio
     */
    public function setNombreVia($nombreVia)
    {
        $this->nombreVia = $nombreVia;

        return $this;
    }

    /**
     * Get nombreVia
     *
     * @return string
     */
    public function getNombreVia()
    {
        return $this->nombreVia;
    }

    /**
     * Set numeroVia
     *
     * @param string $numeroVia
     *
     * @return Comercio
     */
    public function setNumeroVia($numeroVia)
    {
        $this->numeroVia = $numeroVia;

        return $this;
    }

    /**
     * Get numeroVia
     *
     * @return string
     */
    public function getNumeroVia()
    {
        return $this->numeroVia;
    }

    /**
     * Set giro
     *
     * @param string $giro
     *
     * @return Comercio
     */
    public function setGiro($giro)
    {
        $this->giro = $giro;

        return $this;
    }

    /**
     * Get giro
     *
     * @return string
     */
    public function getGiro()
    {
        return $this->giro;
    }

    /**
     * Set lon
     *
     * @param float $lon
     *
     * @return Comercio
     */
    public function setLon($lon)
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * Get lon
     *
     * @return float
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Set lat
     *
     * @param float $lat
     *
     * @return Comercio
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    public function addMinhash($minhash)
    {
        if (!in_array($minhash, $this->minhash, true)) {
            $this->minhash[] = $minhash;
        }

        return $this;
    }

    public function setMinhash(array $minhashes)
    {
        $this->minhash = [];

        foreach ($minhashes as $minhash) {
            $this->addMinhash($minhash);
        }

        return $this;
    }

    /**
     * Returns minhash
     *
     * @return array
     */
    public function getMinhash()
    {
        $minhashes = $this->minhash;

        return array_unique($minhashes);
    }

}

