<?php

namespace Lemnia\CustomerPortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sepa
 *
 * @ORM\Table(name="sepa")
 * @ORM\Entity(repositoryClass="Lemnia\CustomerPortalBundle\Repository\SepaRepository")
 */
class Sepa
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
     *
     * @ORM\COlumn(name="iban", type="string", nullable=true)
     */
    private $iban;

    /**
     * @var int
     *
     * @ORM\Column(name="bic", type="integer", nullable=true)
     */
    private $bic;

    /**
     * @var date
     *
     * @ORM\Column(name="date_signature", type="date", nullable=true)
     */
    private $dateSignature;

    /**
     * @ORM\OneToOne(targetEntity="Lemnia\UserBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $userId;

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
     * Set iban
     *
     * @param string $iban
     *
     * @return Sepa
     */
    public function setIban($iban)
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * Get iban
     *
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Set bic
     *
     * @param integer $bic
     *
     * @return Sepa
     */
    public function setBic($bic)
    {
        $this->bic = $bic;

        return $this;
    }

    /**
     * Get bic
     *
     * @return integer
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * Set dateSignature
     *
     * @param \DateTime $dateSignature
     *
     * @return Sepa
     */
    public function setDateSignature($dateSignature)
    {
        $this->dateSignature = $dateSignature;

        return $this;
    }

    /**
     * Get dateSignature
     *
     * @return \DateTime
     */
    public function getDateSignature()
    {
        return $this->dateSignature;
    }

    /**
     * Set userId
     *
     * @param \Lemnia\UserBundle\Entity\User $userId
     *
     * @return Sepa
     */
    public function setUserId(\Lemnia\UserBundle\Entity\User $userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \Lemnia\UserBundle\Entity\User
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
