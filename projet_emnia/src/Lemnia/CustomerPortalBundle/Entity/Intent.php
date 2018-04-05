<?php

namespace Lemnia\CustomerPortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Intent
 *
 * @ORM\Table(name="intent")
 * @ORM\Entity(repositoryClass="Lemnia\CustomerPortalBundle\Repository\IntentRepository")
 */
class Intent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="service",type="string",nullable=false)
     */
    private $service;

    /**
     * @var string
     * @ORM\Column(name="reference", type="string", nullable=false)
     */
    private $reference;

    /**
     * @var date
     * @ORM\Column(name="date",type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     * @ORM\Column(name="state", type="string", nullable=false)
     */
    private $state;

    /**
     * @ORM\OneToMany(targetEntity="Quotation", mappedBy="intent")
     */
    private $quotation;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->quotation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set service
     *
     * @param string $service
     *
     * @return Intent
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Intent
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Intent
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Intent
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Add quotation
     *
     * @param \Lemnia\CustomerPortalBundle\Entity\Quotation $quotation
     *
     * @return Intent
     */
    public function addQuotation(\Lemnia\CustomerPortalBundle\Entity\Quotation $quotation)
    {
        $this->quotation[] = $quotation;

        return $this;
    }

    /**
     * Remove quotation
     *
     * @param \Lemnia\CustomerPortalBundle\Entity\Quotation $quotation
     */
    public function removeQuotation(\Lemnia\CustomerPortalBundle\Entity\Quotation $quotation)
    {
        $this->quotation->removeElement($quotation);
    }

    /**
     * Get quotation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuotation()
    {
        return $this->quotation;
    }
}
