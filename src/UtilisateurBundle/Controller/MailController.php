<?php

namespace UtilisateurBundle\Controller;

use UtilisateurBundle\Entity\Mail;
use UtilisateurBundle\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swift_Message;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller
{
    public function contacterAction(Request $request)
    {
        $mail = new Mail();
        $form = $this->createForm(MailType::class, $mail);


        //$request = Request::createFromGlobals();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $message = Swift_Message::newInstance()
                ->setSubject('Accusé de réception')
                ->setFrom('saif.symfony3@gmail.com')
                ->setTo($mail->getEmail())
                ->setBody(
                    $this->renderView(
                        'UtilisateurBundle:mail:email.html.twig',
                        array('nom' => $mail->getNom(), 'prenom' => $mail->getPrenom())
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
            return $this->redirect($this->generateUrl('my_app_mail_accuse'));
        }

        return $this->render('UtilisateurBundle:mail:index.html.twig', array('form' => $form->createView()));
    }

    public function successAction()
    {
        return new Response("email envoyé avec succès, Merci de vérifier votre adresse mail.");
    }


}
