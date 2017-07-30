<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(name="areas")
 * @Vich\Uploadable
 */
class Area
{
    /**
     * Many Areas have One Reservoirs.
     *
     * @ORM\ManyToOne(targetEntity="Reservoir", inversedBy="areas")
     * @ORM\JoinColumn(name="reservoir_id", referencedColumnName="id")
     */
    private $reservoir;

    /**
     * @ORM\OneToMany(targetEntity="Plant", mappedBy="area", cascade={"persist", "remove"}, orphanRemoval=TRUE)
     */
    private $plants;

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
    private $growingMethod;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $capacity;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $measurementUnit;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Assert\File(maxSize="2M")
     * @Vich\UploadableField(mapping="area_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image;

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

    public function __construct()
    {
        $this->plants = new ArrayCollection();
        $this->image = new EmbeddedFile();
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
     * @return Area
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
     * Set growingMethod.
     *
     * @param int $growingMethod
     *
     * @return Area
     */
    public function setGrowingMethod($growingMethod)
    {
        $this->growingMethod = $growingMethod;

        return $this;
    }

    /**
     * Get growingMethod.
     *
     * @return int
     */
    public function getGrowingMethod()
    {
        return $this->growingMethod;
    }

    /**
     * Set capacity.
     *
     * @param int $capacity
     *
     * @return Area
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity.
     *
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set measurementUnit.
     *
     * @param int $measurementUnit
     *
     * @return Area
     */
    public function setMeasurementUnit($measurementUnit)
    {
        $this->measurementUnit = $measurementUnit;

        return $this;
    }

    /**
     * Get measurementUnit.
     *
     * @return int
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
     * @return Area
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
     * @return Area
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
     * Set reservoir.
     *
     * @param \AppBundle\Entity\Reservoir $reservoir
     *
     * @return Area
     */
    public function setReservoir(\AppBundle\Entity\Reservoir $reservoir = null)
    {
        $this->reservoir = $reservoir;

        return $this;
    }

    /**
     * Get reservoir.
     *
     * @return \AppBundle\Entity\Reservoir
     */
    public function getReservoir()
    {
        return $this->reservoir;
    }

    /**
     * Add plant.
     *
     * @param \AppBundle\Entity\Plant $plant
     *
     * @return Area
     */
    public function addPlant(\AppBundle\Entity\Plant $plant)
    {
        $this->plants[] = $plant;

        return $this;
    }

    /**
     * Remove plant.
     *
     * @param \AppBundle\Entity\Plant $plant
     */
    public function removePlant(\AppBundle\Entity\Plant $plant)
    {
        $this->plants->removeElement($plant);
    }

    /**
     * Get plants.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlants()
    {
        return $this->plants;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param EmbeddedFile $image
     */
    public function setImage(EmbeddedFile $image)
    {
        $this->image = $image;
    }

    /**
     * @return EmbeddedFile
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @Assert\Callback
     *
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        // check only when not null
        if ($this->imageFile != null) {
            if (!in_array($this->imageFile->getMimeType(), array(
                'image/jpeg',
                'image/gif',
                'image/png',
            ))) {
                $context
                    ->buildViolation('Wrong file type (only jpg,gif,png allowed)')
                    ->atPath('imageFile')
                    ->addViolation();
            }
        }
    }
}
