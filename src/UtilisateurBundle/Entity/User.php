<?php
// src/AppBundle/Entity/User.php

namespace UtilisateurBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    protected $email;
    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string", length=255, nullable=true)
     */
    protected $cin;
    /**
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", length=50, nullable=true)
     */
    protected $niveau;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=200, nullable=true)
     */
    protected $adresse;
    /**
     * @var integer
     *
     * @ORM\Column(name="numTel", type="integer", nullable=true)
     */
    protected $numTel;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $nom;
    /**
     * @ORM\OneToMany(targetEntity="Covoiturage", mappedBy="user")
     */
    private $covoiturages;
    /**
     * @ORM\column(type="string",length=255)
     */
    private $prenom;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCovoiturages()
    {
        return $this->covoiturages;
    }

    /**
     * @param mixed $covoiturages
     */
    public function setCovoiturages($covoiturages)
    {
        $this->covoiturages = $covoiturages;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param string $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * @param string $niveau
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    }

    /**
     * @return int
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * @param int $numTel
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;
    }
}