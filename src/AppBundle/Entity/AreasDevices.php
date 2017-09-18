<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="areasdevices")
 */
class AreasDevices
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Many AreaDevices have One Area.
     *
     * @ORM\ManyToOne(targetEntity="Area", inversedBy="areasdevices")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     */
    private $area;

    /**
     * Many AreaDevices have One Device.
     *
     * @ORM\ManyToOne(targetEntity="Device", inversedBy="areasdevices")
     * @ORM\JoinColumn(name="device_id", referencedColumnName="id")
     */
    private $device;

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