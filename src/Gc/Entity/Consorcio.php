<?php
namespace Gc\Entity;

/**
 * Consorcios
 *
 * @Table(name="consorcios")
 * @Entity(repositoryClass="Gc\Repository\Consorcios")
 */
class Consorcio
{
    
    /**
     * @var integer
     *
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @Column(name="name", type="string", length=15, nullable=false)
     * @Assert\MinLength(limit="1", message="The name is too short.")
     */
    private $consorcioname;

    
    
     /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany(targetEntity="Propiedad", mappedBy="propiedad_id")
     */
    private $propiedades;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->propiedades = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $consorcioname
     * @return Consorcios
     */
    public function setConsorcioname($consorcioname)
    {
        $this->consorcioname = $consorcioname;
    
        return $this;
    }

    /**
     * Get consorcioname
     *
     * @return string 
     */
    public function getConsorcioname()
    {
        return $this->consorcioname;
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

    public function setPropiedades(\Doctrine\Common\Collections\Collection $propiedades)
    {
        $this->propiedades = $propiedades;
        foreach ($propiedades as $propiedad) {
            $propiedad->setConsorcio($this);
        }
    }
    
    public function getPropiedades()
    {
        return $this->prodiedad;
    }
    
    public function __toString()
    {
        return strval($this->id);
    }
}
