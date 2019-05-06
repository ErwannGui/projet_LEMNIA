<?php

namespace Lemnia\CustomerPortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quotation
 *
 * @ORM\Table(name="quotation")
 * @ORM\Entity(repositoryClass="Lemnia\CustomerPortalBundle\Repository\QuotationRepository")
 */
class Quotation
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
     * @var float
     * @ORM\Column(name="amount",type="float",nullable=false)
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity="Intent", inversedBy="quotation")
     * @ORM\JoinColumn(name="intent_id",referencedColumnName="id")
     */
    private $intent;


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
     * Set amount
     *
     * @param float $amount
     *
     * @return Quotation
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set intent
     *
     * @param \Lemnia\CustomerPortalBundle\Entity\Intent $intent
     *
     * @return Quotation
     */
    public function setIntent(\Lemnia\CustomerPortalBundle\Entity\Intent $intent = null)
    {
        $this->intent = $intent;

        return $this;
    }

    /**
     * Get intent
     *
     * @return \Lemnia\CustomerPortalBundle\Entity\Intent
     */
    public function getIntent()
    {
        return $this->intent;
    }
}
