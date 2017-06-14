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
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     */
    private $area;

    /**
     * @ORM\ManyToOne(targetEntity="Seed", inversedBy="plants")
     * @ORM\JoinColumn(name="seed_id", referencedColumnName="id")
     */
    private $seed;

    /**
     * @ORM\Column(type="datetime", nullable=TRUE)
     * @Assert\Type("\DateTime")
     */
    private $seedlingDate;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $seedlingAmount;

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
     * @param \DateTime $seedlingDate
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
     * @return \DateTime
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
}
