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
 * @ORM\Table(name="seeds")
 * @Vich\Uploadable
 */
class Seed
{
    /**
     * Many Seeds have One seedCategory.
     *
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
        $this->image = new EmbeddedFile();
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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Assert\File(maxSize="2M")
     * @Vich\UploadableField(mapping="seed_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName")
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
     * @return Seed
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
     * Set quantity.
     *
     * @param int $quantity
     *
     * @return Seed
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set measurementUnit.
     *
     * @param int $measurementUnit
     *
     * @return Seed
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
     * Set producerName.
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
     * Get producerName.
     *
     * @return string
     */
    public function getProducerName()
    {
        return $this->producerName;
    }

    /**
     * Set originContry.
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
     * Get originContry.
     *
     * @return string
     */
    public function getOriginCountry()
    {
        return $this->originCountry;
    }

    /**
     * Set note.
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
     * Get note.
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set expirationMonth.
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
     * Get expirationMonth.
     *
     * @return string
     */
    public function getExpirationMonth()
    {
        return $this->expirationMonth;
    }

    /**
     * Set expirationYear.
     *
     * @param int $expirationYear
     *
     * @return Seed
     */
    public function setExpirationYear($expirationYear)
    {
        $this->expirationYear = $expirationYear;

        return $this;
    }

    /**
     * Get expirationYear.
     *
     * @return int
     */
    public function getExpirationYear()
    {
        return $this->expirationYear;
    }

    /**
     * Set germinationRate.
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
     * Get germinationRate.
     *
     * @return string
     */
    public function getGerminationRate()
    {
        return $this->germinationRate;
    }

    /**
     * Set updatedAt.
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
     * @return Seed
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
     * Add plant.
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
     * Set seedCategory.
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
     * Get seedCategory.
     *
     * @return \AppBundle\Entity\SeedCategory
     */
    public function getSeedCategory()
    {
        return $this->seedCategory;
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
