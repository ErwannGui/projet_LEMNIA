<?php

namespace Lemnia\CustomerPortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscription
 *
 * @ORM\Table(name="subscription")
 * @ORM\Entity(repositoryClass="Lemnia\CustomerPortalBundle\Repository\SubscriptionRepository")
 */
class Subscription
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
     * @ORM\Column(name="type", type="string",nullable=false)
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(name="service", type="string", nullable=false)
     */
    private $service;

    /**
     * @var date
     * @ORM\Column(name="endDate", type="datetime", nullable=false)
     */
    private $endDate;

    /**
     * @var state
     * @ORM\Column(name="state",type="string",nullable=false)
     */
    private $state;


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

