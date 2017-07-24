<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="reservoirs")
 */
class Reservoir
{
    /**
     * Many Reservoirs have One Field.
     *
     * @ORM\ManyToOne(targetEntity="Field", inversedBy="reservoirs")
     * @ORM\JoinColumn(name="field_id", referencedColumnName="id")
     */
    private $field;

    /**
     * One Reservoir has Many areas.
     *
     * @ORM\OneToMany(targetEntity="Area", mappedBy="reservoir")
     */
    private $areas;

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
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Assert\NotBlank()
     */
    private $capacity;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $measurementUnit;

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

    public function __construct()
    {
        $this->areas = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Reservoir
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set capacity.
     *
     * @param string $capacity
     *
     * @return Reservoir
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity.
     *
     * @return string
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set measurementUnit.
     *
     * @param string $measurementUnit
     *
     * @return Reservoir
     */
    public function setMeasurementUnit($measurementUnit)
    {
        $this->measurementUnit = $measurementUnit;

        return $this;
    }

    /**
     * Get measurementUnit.
     *
     * @return string
     */
    public function getMeasurementUnit()
    {
        return $this->measurementUnit;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Reservoir
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Reservoir
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set field.
     *
     * @param \AppBundle\Entity\Field $field
     *
     * @return Reservoir
     */
    public function setField(\AppBundle\Entity\Field $field = null)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field.
     *
     * @return \AppBundle\Entity\Field
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Add area.
     *
     * @param \AppBundle\Entity\Area $area
     *
     * @return Reservoir
     */
    public function addArea(\AppBundle\Entity\Area $area)
    {
        $this->areas[] = $area;

        return $this;
    }

    /**
     * Remove area.
     *
     * @param \AppBundle\Entity\Area $area
     */
    public function removeArea(\AppBundle\Entity\Area $area)
    {
        $this->areas->removeElement($area);
    }

    /**
     * Get areas.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAreas()
    {
        return $this->areas;
    }
}
