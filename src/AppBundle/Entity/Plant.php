<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="plants")
 */
class Plant
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Area", inversedBy="plants")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id", nullable=FALSE)
     */
    private $area;

    /**
     * @ORM\ManyToOne(targetEntity="Seed", inversedBy="plants")
     * @ORM\JoinColumn(name="seed_id", referencedColumnName="id", nullable=FALSE)
     */
    private $seed;

    /**
     * @ORM\Column(type="date", nullable=TRUE)
     * @Assert\Date()
     */
    private $seedlingDate;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $seedlingAmount;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $areaCapacity;

    /**
     * @ORM\Column(type="date", nullable=TRUE)
     * @Assert\Date()
     */
    private $harvestingDate;

    /**
     * @ORM\Column(type="date", nullable=TRUE)
     * @Assert\Date()
     */
    private $disposingDate;

    /**
     * @ORM\Column(type="text", nullable=TRUE)
     */
    private $note;

    /**
     * @ORM\Column(type="string", nullable=TRUE, length=10)
     */
    private $action;

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
     * Set seedlingDate
     *
     * @param \Date $seedlingDate
     *
     * @return Plant
     */
    public function setSeedlingDate($seedlingDate)
    {
        $this->seedlingDate = $seedlingDate;

        return $this;
    }

    /**
     * Get seedlingDate
     *
     * @return \Date
     */
    public function getSeedlingDate()
    {
        return $this->seedlingDate;
    }

    /**
     * Set seedlingAmount
     *
     * @param integer $seedlingAmount
     *
     * @return Plant
     */
    public function setSeedlingAmount($seedlingAmount)
    {
        $this->seedlingAmount = $seedlingAmount;

        return $this;
    }

    /**
     * Get seedlingAmount
     *
     * @return integer
     */
    public function getSeedlingAmount()
    {
        return $this->seedlingAmount;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Plant
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
     * @return Plant
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
     * Set area
     *
     * @param \AppBundle\Entity\Area $area
     *
     * @return Plant
     */
    public function setArea(\AppBundle\Entity\Area $area = null)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return \AppBundle\Entity\Area
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set seed
     *
     * @param \AppBundle\Entity\Seed $seed
     *
     * @return Plant
     */
    public function setSeed(\AppBundle\Entity\Seed $seed = null)
    {
        $this->seed = $seed;

        return $this;
    }

    /**
     * Get seed
     *
     * @return \AppBundle\Entity\Seed
     */
    public function getSeed()
    {
        return $this->seed;
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
     * Set areaCapacity
     *
     * @param integer $areaCapacity
     *
     * @return Plant
     */
    public function setAreaCapacity($areaCapacity)
    {
        $this->areaCapacity = $areaCapacity;

        return $this;
    }

    /**
     * Get areaCapacity
     *
     * @return integer
     */
    public function getAreaCapacity()
    {
        return $this->areaCapacity;
    }

    /**
     * Set harvestingDate
     *
     * @param \DateTime $harvestingDate
     *
     * @return Plant
     */
    public function setHarvestingDate($harvestingDate)
    {
        $this->harvestingDate = $harvestingDate;

        return $this;
    }

    /**
     * Get harvestingDate
     *
     * @return \DateTime
     */
    public function getHarvestingDate()
    {
        return $this->harvestingDate;
    }

    /**
     * Set disposingDate
     *
     * @param \DateTime $disposingDate
     *
     * @return Plant
     */
    public function setDisposingDate($disposingDate)
    {
        $this->disposingDate = $disposingDate;

        return $this;
    }

    /**
     * Get disposingDate
     *
     * @return \DateTime
     */
    public function getDisposingDate()
    {
        return $this->disposingDate;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Plant
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
     * Set action
     *
     * @param string $action
     *
     * @return Plant
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
}
