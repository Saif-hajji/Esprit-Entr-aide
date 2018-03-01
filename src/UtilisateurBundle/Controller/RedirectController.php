<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 07/02/2018
 * Time: 17:23
 */

namespace UtilisateurBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RedirectController extends Controller
{
    public function redirect_adminAction()
    {
        return $this->render('::layout_admin.html.twig');
    }

    public function redirect_etudiantAction()
    {
        return $this->render('UtilisateurBundle:covoiturage:index.html.twig');
    }

    public function redirect_annAction()
    {
        return $this->render('::Lay_annoncesCov.html.twig');
    }

}