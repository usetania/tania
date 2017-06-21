<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="seeds")
 */
class Seed
{
    /**
     * Many Seeds have One seedCategory
     * @ORM\ManyToOne(targetEntity="SeedCategory", inversedBy="seeds")
     * @ORM\JoinColumn(name="seedcategory_id", referencedColumnName="id")
     */
    private $seedCategory;

    /**
     * @ORM\OneToMany(targetEntity="Plant", mappedBy="seed", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    private $plants;

    public function __construct()
    {
        $this->plants = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $measurementUnit;
    
    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank()
     */
    private $producerName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $originCountry;

    /**
     * @ORM\Column(type="text", nullable=TRUE)
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank()
     */
    private $expirationMonth;

    /**
     * @ORM\Column(type="integer", length=4)
     * @Assert\NotBlank()
     */
    private $expirationYear;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=TRUE)
     */
    private $germinationRate;

    /**
     * @ORM\Column(type="text", nullable=TRUE)
     */
    private $photoUrl;

    /**
     * @ORM\Column(type="datetime", nullable=TRUE)
     * @Assert\Type("\DateTime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Type("\DateTime")
     */
    private $createdAt;

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
     * Set name
     *
     * @param string $name
     *
     * @return Seed
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Seed
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set measurementUnit
     *
     * @param integer $measurementUnit
     *
     * @return Seed
     */
    public function setMeasurementUnit($measurementUnit)
    {
        $this->measurementUnit = $measurementUnit;

        return $this;
    }

    /**
     * Get measurementUnit
     *
     * @return integer
     */
    public function getMeasurementUnit()
    {
        return $this->measurementUnit;
    }

    /**
     * Set producerName
     *
     * @param string $producerName
     *
     * @return Seed
     */
    public function setProducerName($producerName)
    {
        $this->producerName = $producerName;

        return $this;
    }

    /**
     * Get producerName
     *
     * @return string
     */
    public function getProducerName()
    {
        return $this->producerName;
    }

    /**
     * Set originContry
     *
     * @param string $originContry
     *
     * @return Seed
     */
    public function setOriginCountry($originCountry)
    {
        $this->originCountry = $originCountry;

        return $this;
    }

    /**
     * Get originContry
     *
     * @return string
     */
    public function getOriginCountry()
    {
        return $this->originCountry;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Seed
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set expirationMonth
     *
     * @param string $expirationMonth
     *
     * @return Seed
     */
    public function setExpirationMonth($expirationMonth)
    {
        $this->expirationMonth = $expirationMonth;

        return $this;
    }

    /**
     * Get expirationMonth
     *
     * @return string
     */
    public function getExpirationMonth()
    {
        return $this->expirationMonth;
    }

    /**
     * Set expirationYear
     *
     * @param integer $expirationYear
     *
     * @return Seed
     */
    public function setExpirationYear($expirationYear)
    {
        $this->expirationYear = $expirationYear;

        return $this;
    }

    /**
     * Get expirationYear
     *
     * @return integer
     */
    public function getExpirationYear()
    {
        return $this->expirationYear;
    }

    /**
     * Set germinationRate
     *
     * @param string $germinationRate
     *
     * @return Seed
     */
    public function setGerminationRate($germinationRate)
    {
        $this->germinationRate = $germinationRate;

        return $this;
    }

    /**
     * Get germinationRate
     *
     * @return string
     */
    public function getGerminationRate()
    {
        return $this->germinationRate;
    }

    /**
     * Set photoUrl
     *
     * @param string $photoUrl
     *
     * @return Seed
     */
    public function setPhotoUrl($photoUrl)
    {
        $this->photoUrl = $photoUrl;

        return $this;
    }

    /**
     * Get photoUrl
     *
     * @return string
     */
    public function getPhotoUrl()
    {
        return $this->photoUrl;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Seed
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Seed
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add plant
     *
     * @param \AppBundle\Entity\Plant $plant
     *
     * @return Seed
     */
    public function addPlant(\AppBundle\Entity\Plant $plant)
    {
        $this->plants[] = $plant;

        return $this;
    }

    /**
     * Remove plant
     *
     * @param \AppBundle\Entity\Plant $plant
     */
    public function removePlant(\AppBundle\Entity\Plant $plant)
    {
        $this->plants->removeElement($plant);
    }

    /**
     * Get plants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlants()
    {
        return $this->plants;
    }

    /**
     * Set seedCategory
     *
     * @param \AppBundle\Entity\SeedCategory $seedCategory
     *
     * @return Seed
     */
    public function setSeedCategory(\AppBundle\Entity\SeedCategory $seedCategory = null)
    {
        $this->seedCategory = $seedCategory;

        return $this;
    }

    /**
     * Get seedCategory
     *
     * @return \AppBundle\Entity\SeedCategory
     */
    public function getSeedCategory()
    {
        return $this->seedCategory;
    }
}
