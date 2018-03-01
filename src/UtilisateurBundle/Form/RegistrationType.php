<?php
/**
 * Created by PhpStorm.
 * User: oussa
 * Date: 04/02/2018
 * Time: 6:03 PM
 */

namespace UtilisateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')->add('prenom')->add('roles', ChoiceType::class, array(
                'label' => 'Type',
                'choices' => array(
                    'ADMIN' => 'ROLE_ADMIN',
                    'ETUDIANT' => 'ROLE_USER',
                    'ENSEIGNANT' => 'ROLE_enseignant'
                ),
                'required' => true,
                'multiple' => true)
        );
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'utilisateur_bundle_user_registration_type';
    }
}