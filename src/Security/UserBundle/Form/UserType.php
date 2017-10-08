<?php

namespace Security\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username')->add('password')->add('email')->add('name')->add('surname')->add('isActive')->add('salt')
        ->add('roles', ChoiceType::class, 
                array('choices'  => array('ROLE_USER' => 'ROLE_USER', 'ROLE_TEAM' => 'ROLE_TEAM', 'ROLE_OPERATOR' => 'ROLE_OPERATOR', 'ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_ROOT' => 'ROLE_ROOT', 'ROLE_USER' => null)));

//array()

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Security\UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'security_userbundle_user';
    }


}
