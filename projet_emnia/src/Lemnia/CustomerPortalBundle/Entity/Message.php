<?php

namespace Lemnia\CustomerPortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="Lemnia\CustomerPortalBundle\Repository\MessageRepository")
 */
class Message
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
     * @ORM\ManyToOne(targetEntity="Ticket", inversedBy="messages")
     * @ORM\JoinColumn(name="ticket_id", referencedColumnName="id",nullable=true)
     */
    private $ticket;

    /**
     * @var string
     * @ORM\Column(name="text_content", type="string", nullable=true)
     */
    private $textContent;

    /**
     * @var date
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     * @ORM\Column(name="sender_short_cut_name", type="string", nullable=true)
     */
    private $senderShortCutName;

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
     * Set textContent
     *
     * @param string $textContent
     *
     * @return Message
     */
    public function setTextContent($textContent)
    {
        $this->textContent = $textContent;

        return $this;
    }

    /**
     * Get textContent
     *
     * @return string
     */
    public function getTextContent()
    {
        return $this->textContent;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Message
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
     * Set senderShortCutName
     *
     * @param string $senderShortCutName
     *
     * @return Message
     */
    public function setSenderShortCutName($senderShortCutName)
    {
        $this->senderShortCutName = $senderShortCutName;

        return $this;
    }

    /**
     * Get senderShortCutName
     *
     * @return string
     */
    public function getSenderShortCutName()
    {
        return $this->senderShortCutName;
    }

    /**
     * Set ticket
     *
     * @param \Lemnia\CustomerPortalBundle\Entity\Ticket $ticket
     *
     * @return Message
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
}
