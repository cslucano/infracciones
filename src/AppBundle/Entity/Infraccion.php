<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Infraccion
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @ORM\Column(name="fecha_infraccion", type="datetime")
     */
    private $fechaInfraccion;

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
}

