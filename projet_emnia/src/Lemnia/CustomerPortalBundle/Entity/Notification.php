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

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Notification
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set strength
     *
     * @param string $strength
     *
     * @return Notification
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get strength
     *
     * @return string
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Notification
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set subscritption
     *
     * @param \Lemnia\CustomerPortalBundle\Entity\Subscription $subscritption
     *
     * @return Notification
     */
    public function setSubscritption(\Lemnia\CustomerPortalBundle\Entity\Subscription $subscritption = null)
    {
        $this->subscritption = $subscritption;

        return $this;
    }

    /**
     * Get subscritption
     *
     * @return \Lemnia\CustomerPortalBundle\Entity\Subscription
     */
    public function getSubscritption()
    {
        return $this->subscritption;
    }

    /**
     * Set intent
     *
     * @param \Lemnia\CustomerPortalBundle\Entity\Intent $intent
     *
     * @return Notification
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

    /**
     * Set ticket
     *
     * @param \Lemnia\CustomerPortalBundle\Entity\Ticket $ticket
     *
     * @return Notification
     */
    public function setTicket(\Lemnia\CustomerPortalBundle\Entity\Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \Lemnia\CustomerPortalBundle\Entity\Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Set user
     *
     * @param \Lemnia\UserBundle\Entity\User $user
     *
     * @return Notification
     */
    public function setUser(\Lemnia\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Lemnia\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
