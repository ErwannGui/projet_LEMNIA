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
}

