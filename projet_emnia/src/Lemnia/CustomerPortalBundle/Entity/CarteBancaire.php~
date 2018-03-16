<?php

namespace Lemnia\CustomerPortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CarteBancaire
 *
 * @ORM\Table(name="carte_bancaire")
 * @ORM\Entity(repositoryClass="Lemnia\CustomerPortalBundle\Repository\CarteBancaireRepository")
 */
class CarteBancaire
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
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="numero_carte", type="integer", nullable=true)
     */
    private $numeroCarte;

    /**
     * @var date
     *
     * @ORM\Column(name="date_expiration", type="date", nullable=true)
     */
    private $dateExpiration;

    /**
     * @var int
     *
     * @ORM\Column(name="pictogramme", type="integer", nullable=true)
     */
    private $pictogramme;

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
     * Set type
     *
     * @param string $type
     *
     * @return CarteBancaire
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set numeroCarte
     *
     * @param integer $numeroCarte
     *
     * @return CarteBancaire
     */
    public function setNumeroCarte($numeroCarte)
    {
        $this->numeroCarte = $numeroCarte;

        return $this;
    }

    /**
     * Get numeroCarte
     *
     * @return integer
     */
    public function getNumeroCarte()
    {
        return $this->numeroCarte;
    }

    /**
     * Set dateExpiration
     *
     * @param \DateTime $dateExpiration
     *
     * @return CarteBancaire
     */
    public function setDateExpiration($dateExpiration)
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }

    /**
     * Get dateExpiration
     *
     * @return \DateTime
     */
    public function getDateExpiration()
    {
        return $this->dateExpiration;
    }

    /**
     * Set pictogramme
     *
     * @param integer $pictogramme
     *
     * @return CarteBancaire
     */
    public function setPictogramme($pictogramme)
    {
        $this->pictogramme = $pictogramme;

        return $this;
    }

    /**
     * Get pictogramme
     *
     * @return integer
     */
    public function getPictogramme()
    {
        return $this->pictogramme;
    }

    /**
     * Set userId
     *
     * @param \Lemnia\UserBundle\Entity\User $userId
     *
     * @return CarteBancaire
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
