<?php

namespace Gc\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @Table(name="propiedades")
 * @Entity(repositoryClass="Gc\Repository\Propiedades")
 */
class Propiedad
{
    
    /**
     * @var integer
     *
     * @Column(name="propiedad_id", type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @Column(name="piso", type="string", length=40, nullable=true)
     * @MinLength(limit="1", message="The piso is too short.")
     */
    private $piso;
    
    /**
     * @var string
     *
     * @Column(name="depto", type="string", length=40, nullable=true)
     */
    private $depto;
    
    /**
     * @var string
     *
     * @Column(name="otros", type="string", length=40, nullable=true)
     */
    private $otros;
    
    /**
     * @var string
     *
     * @Column(name="porcentualidadA", type="decimal", scale=2)
     */
    private $porcentualidada = 0;
    
    /**
     * @var string
     *
     * @Column(name="porcentualidadB", type="decimal", scale=2)
     */
    private $porcentualidadb = 0;

    /**
     * @var \Consorcios
     *
     * @ManyToOne(targetEntity="Consorcio")
     * @JoinColumn(name="consorcio_id", referencedColumnName="id")
     */
    private $consorcio;

    /**
     * Constructor
     */
    public function __construct()
    {
        
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
     * Set piso
     *
     * @param string $piso
     * @return Propiedades
     */
    public function setPiso($piso)
    {
        $this->piso = $piso;
    
        return $this;
    }

    /**
     * Get piso
     *
     * @return string 
     */
    public function getPiso()
    {
        return $this->piso;
    }
    
    /**
     * Set depto
     *
     * @param string $depto
     * @return Propiedades
     */
    public function setDepto($depto)
    {
        $this->depto = $depto;
    
        return $this;
    }
    
    /**
     * Get depto
     *
     * @return string 
     */
    public function getDepto()
    {
        return $this->depto;
    }

    /**
     *
     * @return decimal 
     */
    public function getPorcentualidadA()
    {
        return $this->porcentualidada;
    }
    
    /**
     *
     * @param string $porcentualidada
     * @return Propiedades
     */
    public function setPorcentualidadA($porcentualidada)
    {
        $this->porcentualidada = $porcentualidada;
    
        return $this;
    }
    
    public function getPorcentualidadB()
    {
        return $this->porcentualidadb;
    }
    
    public function setPorcentualidadB($porcentualidadb)
    {
        $this->porcentualidadb = $porcentualidadb;
    
        return $this;
    }
    
    /**
     *
     * @return string 
     */
    public function getOtros()
    {
        return $this->otros;
    }
    
    /**
     *
     * @param string $porcentualidada
     * @return Propiedades
     */
    public function setOtros($otros)
    {
        $this->otros = $otros;
    
        return $this;
    }

    
    

    /**
     * Set consorcio
     *
     * @param \Consorcios $consorcio
     * @return Products
     */
    public function setConsorcio(Consorcio $consorcio = null)
    {
        $this->consorcio = $consorcio;
    
        return $this;
    }

    /**
     * Get categoryid
     *
     * @return \Categories 
     */
    public function getConsorcio()
    {
        return $this->consorcio;
    }

    
    public function __toString()
    {
        return strval($this->productid);
    }

}
