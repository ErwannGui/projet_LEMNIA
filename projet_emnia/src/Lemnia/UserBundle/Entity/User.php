<?php
/**
 @author Groupe 5 <https://github.com/ErwannGui/plateforme-Ydays>
 @copyright 2017 Groupe 5
 @version 1.0
*/
namespace Lemnia\UserBundle\Entity;

use FOS\UserBundle\Model\User AS FosUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="User")
 * @ORM\Entity(repositoryClass="Lemnia\UserBundle\Repository\UserRepository")
 */
class User extends FosUser
{   
    //génération de la classe Utilisateur et de ses guetters/setters ce qui permet de créer des objets utilisateurs et de les utiliser dans notre application

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var int
     *
     * @ORM\Column(name="phoneNumber", type="integer", nullable=true)
     */
    private $phoneNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="code_postal", type="integer", nullable=true)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string",nullable=true)
     */
    private $adresse;
    /**
     * @var string
     *
     * @ORM\Column(name="socity", type="string", nullable=true)
     */
    private $socity;
    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string",nullable=true)
     */
    private $job;
    /**
     * @var string
     *
     * @ORM\Column(name="nation", type="string", nullable=true)
     */
    private $nation;
    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", nullable=true)
     */
    private $city;

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    /**
     * Set phoneNumber
     *
     * @param integer $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return integer
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set socity
     *
     * @param string $socity
     *
     * @return User
     */
    public function setSocity($socity)
    {
        $this->socity = $socity;

        return $this;
    }

    /**
     * Get socity
     *
     * @return string
     */
    public function getSocity()
    {
        return $this->socity;
    }

    /**
     * Set job
     *
     * @param string $job
     *
     * @return User
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set nation
     *
     * @param string $nation
     *
     * @return User
     */
    public function setNation($nation)
    {
        $this->nation = $nation;

        return $this;
    }

    /**
     * Get nation
     *
     * @return string
     */
    public function getNation()
    {
        return $this->nation;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return User
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return integer
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}
