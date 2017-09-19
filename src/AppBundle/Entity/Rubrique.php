<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rubrique
 *
 * @ORM\Table(name="rubrique")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RubriqueRepository") 
 */
class Rubrique
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=255)
     */
    private $ref;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Theme", inversedBy="rubriques")  
     * @ORM\JoinColumn(nullable=false)  
     */
    private $theme;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="rubrique")
     */
    private $images; 

    /**
     * @var string
     *
     * @ORM\Column(name="presentation", type="string", length=3000, unique=false)
     */
    private $presentation;    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rubriqueRef
     *
     * @param string $rubriqueRef
     *
     * @return Rubrique
     */
    public function setRubriqueRef($rubriqueRef)
    {
        $this->rubriqueRef = $rubriqueRef;

        return $this;
    }

    /**
     * Get rubriqueRef
     *
     * @return string
     */
    public function getRubriqueRef()
    {
        return $this->rubriqueRef;
    }

    /**
     * Set theme
     *
     * @param \AppBundle\Entity\Theme $theme
     *
     * @return Rubrique
     */
    public function setTheme(\AppBundle\Entity\Theme $theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \AppBundle\Entity\Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }
    
    /**
     * Add image
     *
     * @param AppBundle\Entity\Image $image
     *
     * @return Rubrique
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        // On lie l'annonce à la candidature
        $image->setRubrique($this);

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function removeImage(\AppBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }
    
    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }    

    /**
     * Set ref
     *
     * @param string $ref
     *
     * @return Rubrique
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set presentation
     *
     * @param string $presentation
     *
     * @return Rubrique
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }
}
