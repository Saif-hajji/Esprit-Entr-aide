<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Covoiturage
 *
 * @ORM\Table(name="covoiturage")
 * @ORM\Entity(repositoryClass="UtilisateurBundle\Repository\CovoiturageRepository")
 */
class Covoiturage
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $idCov;
    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $idUser;
    /**
     * @ORM\Column(type="string" ,length=255)
     */
    private $Depart;
    /**
     * @ORM\Column(type="string" ,length=255)
     */
    private $arrivee;
    /**
     * @ORM\Column(type="string" ,length=255)
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="string" ,length=255)
     */
    private $heureDepart;

    /**
     * @ORM\Column(type="string" ,length=255)
     */
    private $description;
    /**
     * @ORM\Column(type="float" ,length=255)
     */
    private $prix;
    /**
     * @ORM\Column(type="integer")
     */
    private $nombreDePlaces;
    /**
     * @ORM\Column(name="nombreDeReservations", type="integer")
     */
    private $nombreDeReservations;

    /**
     * @ORM\Column(name="jetonReserve", type="integer")
     */
    private $jetonReserve;

    /**
     * @return mixed
     */
    public function getIdCov()
    {
        return $this->idCov;
    }

    /**
     * @param mixed $idCov
     */
    public function setIdCov($idCov)
    {
        $this->idCov = $idCov;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setId($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getDepart()
    {
        return $this->Depart;
    }

    /**
     * @param mixed $Depart
     */
    public function setDepart($Depart)
    {
        $this->Depart = $Depart;
    }

    /**
     * @return mixed
     */
    public function getArrivee()
    {
        return $this->arrivee;
    }

    /**
     * @param mixed $arriver
     */
    public function setArrivee($arrivee)
    {
        $this->arrivee = $arrivee;
    }

    /**
     * @return mixed
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * @param mixed $dateDepart
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;
    }


    /**
     * @param mixed $dateArriver
     */
    public function setDateArriver($dateArriver)
    {
        $this->dateArriver = $dateArriver;
    }

    /**
     * @return mixed
     */
    public function getHeureDepart()
    {
        return $this->heureDepart;
    }

    /**
     * @param mixed $heureDepart
     */
    public function setHeureDepart($heureDepart)
    {
        $this->heureDepart = $heureDepart;
    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getNombreDePlaces()
    {
        return $this->nombreDePlaces;
    }

    /**
     * @param mixed $nombreDePlaces
     */
    public function setNombreDePlaces($nombreDePlaces)
    {
        $this->nombreDePlaces = $nombreDePlaces;
    }

    /**
     * @return mixed
     */
    public function getNombreDeReservations()
    {
        return $this->nombreDeReservations;
    }

    /**
     * @param mixed $nombreDeReservations
     */
    public function setNombreDeReservations($nombreDeReservations)
    {
        $this->nombreDeReservations = $nombreDeReservations;
    }

    /**
     * @return mixed
     */
    public function getJetonReserve()
    {
        return $this->jetonReserve;
    }

    /**
     * @param mixed $jetonReserve
     */
    public function setJetonReserve($jetonReserve)
    {
        $this->jetonReserve = $jetonReserve;
    }
}