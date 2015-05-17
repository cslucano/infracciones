<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Infraccion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\InfraccionRepository")
 */
class Infraccion
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
     * @var integer
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="nro_acta", type="string", length=255)
     */
    private $nroActa;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_infraccion", type="string", length=255)
     */
    private $codInfraccion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_infraccion", type="datetime", nullable=true)
     */
    private $fechaInfraccion;

    /**
     * @var float
     *
     * @ORM\Column(name="hora", type="float", nullable=true)
     */
    private $hora;

    /**
     * @var string
     *
     * @ORM\Column(name="placa", type="string", length=255)
     */
    private $placa;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="cuadra", type="string", length=255)
     */
    private $cuadra;

    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="float", nullable=true)
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="lon", type="float", nullable=true)
     */
    private $lon;

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
     * Set year
     *
     * @param integer $year
     *
     * @return Infraccion
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Infraccion
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set nroActa
     *
     * @param string $nroActa
     *
     * @return Infraccion
     */
    public function setNroActa($nroActa)
    {
        $this->nroActa = $nroActa;

        return $this;
    }

    /**
     * Get nroActa
     *
     * @return string
     */
    public function getNroActa()
    {
        return $this->nroActa;
    }

    /**
     * Set codInfraccion
     *
     * @param string $codInfraccion
     *
     * @return Infraccion
     */
    public function setCodInfraccion($codInfraccion)
    {
        $this->codInfraccion = $codInfraccion;

        return $this;
    }

    /**
     * Get codInfraccion
     *
     * @return string
     */
    public function getCodInfraccion()
    {
        return $this->codInfraccion;
    }

    /**
     * Set fechaInfraccion
     *
     * @param \DateTime $fechaInfraccion
     *
     * @return Infraccion
     */
    public function setFechaInfraccion($fechaInfraccion)
    {
        $this->fechaInfraccion = $fechaInfraccion;

        return $this;
    }

    /**
     * Get fechaInfraccion
     *
     * @return \DateTime
     */
    public function getFechaInfraccion()
    {
        return $this->fechaInfraccion;
    }

    /**
     * Set hora
     *
     * @param float $hora
     *
     * @return Infraccion
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return float
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set placa
     *
     * @param string $placa
     *
     * @return Infraccion
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;

        return $this;
    }

    /**
     * Get placa
     *
     * @return string
     */
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Infraccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set cuadra
     *
     * @param string $cuadra
     *
     * @return Infraccion
     */
    public function setCuadra($cuadra)
    {
        $this->cuadra = $cuadra;

        return $this;
    }

    /**
     * Get cuadra
     *
     * @return string
     */
    public function getCuadra()
    {
        return $this->cuadra;
    }

    /**
     * Set isValid
     *
     * @param boolean $valid
     *
     * @return Infraccion
     */
    public function setValid($valid)
    {
        $this->isValid = $valid;

        return $this;
    }

    /**
     * Get isValid
     *
     * @return boolean
     */
    public function isValid()
    {
        return $this->isValid;
    }

    /**
     * Set lat
     *
     * @param float $lat
     *
     * @return Infraccion
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

    /**
     * Set lon
     *
     * @param float $lon
     *
     * @return Infraccion
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
}

