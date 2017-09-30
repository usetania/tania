<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="resources")
 */
class Resource
{
    /**
     * @ORM\OneToMany(targetEntity="ResourcesDevices", mappedBy="resource", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    private $resourcesdevices;

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
    private $type;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $dataType;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $unit;

    /**
     * @ORM\Column(type="datetime", nullable=TRUE)
     * @Assert\DateTime()
     */
    private $updatedAt;
     
    /**
    * @ORM\Column(type="datetime")
    * @Assert\Type("\DateTime")
    */
    private $createdAt;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->resourcesdevices = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set type
     *
     * @param string $type
     *
     * @return Resource
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set dataType
     *
     * @param string $dataType
     *
     * @return Resource
     */
    public function setDataType($dataType)
    {
        $this->dataType = $dataType;

        return $this;
    }

    /**
     * Get dataType
     *
     * @return string
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * Set unit
     *
     * @param string $unit
     *
     * @return Resource
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Resource
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
     * @return Resource
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
     * Add resourcesdevice
     *
     * @param \AppBundle\Entity\ResourcesDevices $resourcesdevice
     *
     * @return Resource
     */
    public function addResourcesdevice(\AppBundle\Entity\ResourcesDevices $resourcesdevice)
    {
        $this->resourcesdevices[] = $resourcesdevice;

        return $this;
    }

    /**
     * Remove resourcesdevice
     *
     * @param \AppBundle\Entity\ResourcesDevices $resourcesdevice
     */
    public function removeResourcesdevice(\AppBundle\Entity\ResourcesDevices $resourcesdevice)
    {
        $this->resourcesdevices->removeElement($resourcesdevice);
    }

    /**
     * Get resourcesdevices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResourcesdevices()
    {
        return $this->resourcesdevices;
    }
}
