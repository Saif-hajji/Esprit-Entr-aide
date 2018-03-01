<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 26/02/2018
 * Time: 22:22
 */

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="reservationcovoiturage")
 */
class ReservationCovoiturage
{

    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $idReservation;
    /**
     * @ORM\Column(type="integer")
     */
    private $idUser;
    /**
     * @ORM\Column(type="integer")
     */
    private $idCOV;
    /**
     * @ORM\Column(type="integer")
     */
    private $role;


    /**
     * @var integer
     *
     * @ORM\Column(name="jetonR", type="integer")
     */
    private $jetonR;


    /**
     * @return mixed
     */
    public function getidReservation()
    {
        return $this->idReservation;
    }

    /**
     * @param mixed $idReservation
     */
    public function setidReservation($idReservation)
    {
        $this->idReservation = $idReservation;
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
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getIdCOV()
    {
        return $this->idCOV;
    }

    /**
     * @param mixed $idCOV
     */
    public function setIdCOV($idCOV)
    {
        $this->idCOV = $idCOV;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return int
     */
    public function getJetonR()
    {
        return $this->jetonR;
    }

    /**
     * @param int $jetonR
     */
    public function setJetonR($jetonR)
    {
        $this->jetonR = $jetonR;
    }


}










  


