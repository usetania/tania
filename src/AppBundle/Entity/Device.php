<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="devices")
 */
class Device
{
    /**
     * Many Reservoirs have One Field.
     *
     * @ORM\ManyToOne(targetEntity="Field", inversedBy="devices")
     * @ORM\JoinColumn(name="field_id", referencedColumnName="id")
     */
    private $field;

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
     * @ORM\Column(type="text", nullable=TRUE)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $deviceType;

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
}