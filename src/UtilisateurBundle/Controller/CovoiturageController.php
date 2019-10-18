<?php

namespace UtilisateurBundle\Controller;

use UtilisateurBundle\Entity\Covoiturage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UtilisateurBundle\Entity\User;
use UtilisateurBundle\Entity\ReservationCovoiturage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SensioLabs\Security\Exception\RuntimeException;
use Swift_Message;
use UtilisateurBundle\Controller\MailController;
use UtilisateurBundle\Entity\Mail;
use UtilisateurBundle\Form\MailType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Mapping as ORM;

/**
 * Covoiturage controller.
 *
 */
class CovoiturageController extends Controller
{
    /**
     * Lists all covoiturage entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $covoiturages = $em->getRepository('UtilisateurBundle:Covoiturage')->findAll();

        return $this->render("UtilisateurBundke:covoiturage:index.html.twig", array(
            'covoiturages' => $covoiturages,
        ));
    }

    /**
     * Creates a new covoiturage entity.
     *
     */
    public function newAction(Request $request)
    {
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $idUser = $user->getId();
        }
        $covoiturage= new Covoiturage();

        $em=$this->getDoctrine()->getManager();
        $em1=$this->getDoctrine()->getManager();
        if($request->isMethod('POST')){
            $covoiturage->setId($idUser);
            $covoiturage->setDepart($request->get('depart'));
            $covoiturage->setArrivee($request->get('arrivee'));
            $covoiturage->setDateDepart($request->get('dateDepart'));
            $covoiturage->setHeureDepart($request->get('heureDepart'));
            $covoiturage->setDescription($request->get('description'));
            $covoiturage->setPrix($request->get('prix'));
            $covoiturage->setNombreDePlaces($request->get('nombreDeplaces'));
            $covoiturage->setNombreDeReservations(0);
            $covoiturage->setJetonReserve(0);


            $em->persist(($covoiturage));
            $em->flush();
            $this->sendMail();

           return $this->redirectToRoute('covoiturage_show');

        }
        $this->sendMail();
        return $this->render("UtilisateurBundle:covoiturage:show.html.twig",array());

    }

    /**
     * Finds and displays a covoiturage entity.
     *
     */
    public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $covoiturages=$em->getRepository("UtilisateurBundle:Covoiturage")->findAll();

        /**
        * @var $paginator \Knp\Component\Pager\Paginator
        */



        $paginator  = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $covoiturages, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 2)

        );

        return $this->render("UtilisateurBundle:covoiturage:show.html.twig", array(
            'covoiturages' => $result,

        ));
    }

    public function showmineAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $covoiturages=$em->getRepository("UtilisateurBundle:Covoiturage")->findByid_user($this->getUser());

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator  = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $covoiturages, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 1)

        );


        return $this->render("UtilisateurBundle:covoiturage:showmine.html.twig", array(
            'covoiturages' => $result,

        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $covoiturage=$em->getRepository("UtilisateurBundle:Covoiturage")->find($id);
        $em->remove($covoiturage);
        $em->flush();
        return $this->redirectToRoute("covoiturage_showmine");
    }

    public function editAction($id , Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $covoiturage=$em->getRepository("UtilisateurBundle:Covoiturage")->find($id);

        if ($request->isMethod('POST'))
        {

            $covoiturage->setDepart($request->get('depart'));
            $covoiturage->setArrivee($request->get('arrivee'));
            $covoiturage->setDateDepart($request->get('dateDepart'));
            $covoiturage->setHeureDepart($request->get('heureDepart'));
            $covoiturage->setDescription($request->get('description'));
            $covoiturage->setPrix($request->get('prix'));
            $covoiturage->setNombreDePlaces($request->get('nombreDeplaces'));
            $em->flush();

            return $this->redirectToRoute('covoiturage_showmine');
        }


        return $this->render('UtilisateurBundle:covoiturage:edit.html.twig',array("covoiturage"=>$covoiturage));


    }

    public function searchAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $em1=$this->getDoctrine()->getManager();
        if($request->isMethod('GET')) {

            $cle = $request->get('cle');
            if ($cle == "") {
                $covoiturages=$em->getRepository("UtilisateurBundle:Covoiturage")->findby(array(),array('idCov'=>'DESC'));
            } else {

                $covoiturages = $em1->getRepository("UtilisateurBundle:Covoiturage")->createQueryBuilder('covoiturages')

                    ->Where('covoiturages.Depart LIKE :depart')
                    ->orWhere('covoiturages.arrivee LIKE :arrivee')
                    ->orWhere('covoiturages.dateDepart LIKE :dateDepart')
                    ->orWhere('covoiturages.heureDepart LIKE :heureDepart')
                    ->orWhere('covoiturages.prix LIKE :prix')
                    ->orWhere('covoiturages.nombreDePlaces LIKE :nbp')

                    ->setParameter('depart', '%'.$cle.'%')
                    ->setParameter('arrivee', '%'.$cle.'%')
                    ->setParameter('dateDepart', '%'.$cle.'%')
                    ->setParameter('heureDepart', '%'.$cle.'%')
                    ->setParameter('prix', '%'.$cle.'%')
                    ->setParameter('nbp', '%'.$cle.'%')
                    ->getQuery()
                    ->getResult();
            }
            $paginator  = $this->get('knp_paginator');
            $result = $paginator->paginate(
                $covoiturages, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                $request->query->getInt('limit', 3)

            );
        }



        return $this->render('UtilisateurBundle:covoiturage:search.html.twig',array("covoiturages"=>$result)

        );
    }

    public function reserverCovoiturageAction(Request $request)
    {
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $idUser = $user->getId();
        }
        $reservation = new ReservationCovoiturage();
        $em = $this->getDoctrine()->getManager();
        $em1 = $this->getDoctrine()->getManager();
        $em3 = $this->getDoctrine()->getManager();

        if ($request->isMethod('GET')) {
            $idReservation = $request->get('idReservation');
            $idCov = $request->get('idCov');
            if (($idReservation == $idUser) == false) {

                $reserveur = $em3->getRepository("UtilisateurBundle:ReservationCovoiturage")->findOneBy(array('idUser' => $idUser, 'idCOV' => $idCov, 'role' => 2));


                if ($reserveur == null) {

                    $reservation->setRole(2);
                    $reservation->setIdCOV($idCov);
                    $reservation->setIdUser($idUser);
                    $em1->persist($reservation);
                    $em1->flush();

                    $this->sendMail();


                    $covoiturageC = $em->getRepository("UtilisateurBundle:Covoiturage")->find($idCov);
                    $covoiturageC->setNombreDeReservations($covoiturageC->getNombreDeReservations() + 1);

                    $em->flush();


                }
            }

            $this->sendMail();
            $covoiturages = $em->getRepository("UtilisateurBundle:Covoiturage")->findby(array(), array('idCov' => 'DESC'));

        // $paginator = $this->get('knp_paginator');
          //  $pagination = $paginator->paginate(
            //    $covoiturages,
              //  $request->query->getInt('page', 1)/*page number*/,
                //5/*limit per page*/);


        }

        return $this->render('UtilisateurBundle:covoiturage:search.html.twig',array("covoiturages"=>$covoiturages)
        );
    }

    public function afficherResCovoiturageAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $em1 = $this->getDoctrine()->getManager();


        if ($request->isMethod('GET')) {

            $listeR = array();
            $idCov = $request->get('idCov');
            $reservations = $em->getRepository('UtilisateurBundle:ReservationCovoiturage')->findBy(array('idCOV' => $idCov), array('idCOV' => 'DESC'));
            foreach ($reservations as $reservation) {
                $idReserveur = $reservation->getIdUser();
                $role = $reservation->getRole();
                if ($role == 2) {
                    $User = $em1->getRepository("UtilisateurBundle:User")->findOneBy(array('id' => $idReserveur));
                    array_push($listeR, $User);

                }
            }


        }
        dump($reservations);
        return $this->render('UtilisateurBundle:covoiturage:afficheReservation.html.twig', array("listeR" => $listeR, "idCov" => $idCov, 'reservations' => $reservations)

        );


    }

    public function suppResAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('GET')) {

            $idCov = $request->get('idCov');
            $idRes=$request->get('idRes');
            $covoiturageC = $em->getRepository("UtilisateurBundle:Covoiturage")->find($idCov);

            $covoiturageC->setNombreDeReservations($covoiturageC->getNombreDeReservations() - 1);
            $em->flush();


            $em1 = $this->getDoctrine()->getManager();
            $reservations=$em1->getRepository("UtilisateurBundle:ReservationCovoiturage")->find($idRes);

                    $em1->remove($reservations);
                    $em1->flush();

            return $this->redirectToRoute("covoiturage_showmine");
        }



    }

    public function sendMail()
    {

            $message = Swift_Message::newInstance()
                ->setSubject('Accusé de réception')
                ->setFrom('saif.symfony3@gmail.com')
                ->setTo('saifeddine.hajji@esprit.tn')
                ->setBody(

                   'success' );


            $this->get('mailer')->send($message);

        return $this->render('UtilisateurBundle:mail:email.html.twig');
    }


    public function confirmReservationAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $em1 = $this->getDoctrine()->getManager();
        $em2 = $this->getDoctrine()->getManager();
        $em3 = $this->getDoctrine()->getManager();

        if ($request->isMethod('GET')) {

            $listeR = array();
            $idCov = $request->get('idCov');
            $idConfirme = $request->get('idReservation');
            $Reservation = $em2->getRepository("UtilisateurBundle:ReservationCovoiturage")->findOneBy(array('idUser' => $idConfirme, 'idCOV' => $idCov));
            $Reservation->setJetonR(1);
            $em2->flush();

            $reservations = $em->getRepository("UtilisateurBundle:ReservationCovoiturage")->findBy(array('idCOV' => $idCov, 'role' => 2), array('idCOV' => 'DESC'));
            foreach ($reservations as $reservation) {
                $idReserveur = $reservation->getIdUser();
                $User = $em1->getRepository("UtilisateurBundle:User")->findOneBy(array('id' => $idReserveur));
                array_push($listeR, $User);


            }
            $covoiturageC = $em3->getRepository("UtilisateurBundle:Covoiturage")->find($idCov);
            $covoiturageC->setNombreDePlaces($covoiturageC->getNombreDePlaces()-1);

            $em3->flush();

        }
        return $this->render('UtilisateurBundle:covoiturage:confirmeReservation.html.twig', array("listeR" => $listeR, "idCov" => $idCov, "reservations" => $reservations)
        );

    }





    /**
     * @Route(/logout)
     * @throws \RuntimeException
     */
    public function logoutAction()
    {
        throw new RuntimeException();
    }




}
