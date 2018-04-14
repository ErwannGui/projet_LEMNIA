<?php

namespace Lemnia\CustomerPortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="Lemnia\CustomerPortalBundle\Repository\NotificationRepository")
 */
class Notification
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
     * @ORM\Column(name="text",type="string",nullable=true)
     */
    private $text;

    /**
     * @var string
     * @ORM\Column(name="strength",type="string",nullable=false)
     */
    private $strength;

    /**
     * @ORM\OneToOne(targetEntity="Subscription")
     * @ORM\JoinColumn(name="subscription_id",referencedColumnName="id",nullable=true)
     */
    private $subscritption;

    /**
     * @ORM\OneToOne(targetEntity="Intent")
     * @ORM\JoinColumn(name="intent_id", referencedColumnName="id", nullable=true)
     */
    private $intent;

    /**
     * @ORM\OneToOne(targetEntity="Ticket")
     * @ORM\JoinColumn(name="ticket_id",referencedColumnName="id",nullable=true)
     */
    private $ticket;

    /**
     * @var string
     * @ORM\Column(name="subject",type="string", nullable=false)
     */
    private $subject;

    /**
     * @ORM\ManyToOne(targetEntity="Lemnia\UserBundle\Entity\User", inversedBy="notification")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


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

