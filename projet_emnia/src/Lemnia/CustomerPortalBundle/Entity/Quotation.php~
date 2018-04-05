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
}

