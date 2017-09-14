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
 * @ORM\Table(name="fields")
 * @Vich\Uploadable
 */
class Field
{
    /**
     * One Field has Many Reservoirs.
     *
     * @ORM\OneToMany(targetEntity="Reservoir", mappedBy="field")
     */
    private $reservoirs;

    /**
     * One Field has Many Areas.
     *
     * @ORM\OneToMany(targetEntity="Area", mappedBy="field")
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
     * @ORM\Column(type="decimal", precision=10, scale=8, nullable=TRUE)
     */
    private $lat;

    /**
     * @ORM\Column(type="decimal", precision=11, scale=8, nullable=TRUE)
     */
    private $lng;

    /**
     * @ORM\Column(type="text", nullable=TRUE)
     */
    private $description;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Assert\File(maxSize="2M")
     * @Vich\UploadableField(mapping="field_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName")
     *
     * @var \Vich\UploaderBundle\Entity\File
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
        $this->areas = new ArrayCollection();
        $this->reservoirs = new ArrayCollection();
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
     * @return Field
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
     * Set lat.
     *
     * @param string $lat
     *
     * @return Field
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat.
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng.
     *
     * @param string $lng
     *
     * @return Field
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng.
     *
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Field
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set updated datetime.
     *
     * @param string $updatedAt
     *
     * @return Field
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updated datetime.
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set created datetime.
     *
     * @param string $createdAt
     *
     * @return Field
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get created datetime.
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add reservoir.
     *
     * @param \AppBundle\Entity\Reservoir $reservoir
     *
     * @return Field
     */
    public function addReservoir(\AppBundle\Entity\Reservoir $reservoir)
    {
        $this->reservoirs[] = $reservoir;

        return $this;
    }

    /**
     * Remove reservoir.
     *
     * @param \AppBundle\Entity\Reservoir $reservoir
     */
    public function removeReservoir(\AppBundle\Entity\Reservoir $reservoir)
    {
        $this->reservoirs->removeElement($reservoir);
    }

    /**
     * Get reservoirs.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservoirs()
    {
        return $this->reservoirs;
    }

    /**
     * Add area.
     *
     * @param \AppBundle\Entity\Area $area
     *
     * @return Field
     */
     public function addArea(\AppBundle\Entity\Reservoir $area)
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
