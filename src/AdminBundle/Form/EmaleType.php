<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class EmaleType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder->add('emale', EmailType::class, array(
            'attr' => array(
                'class' => 'admin-input color_text'
            ),
            'label' => 'email1: '
        ))->add('emale2', EmailType::class, array(
            'attr' => array(
                'class' => 'admin-input color_text'
            ),
            'label' => 'email2: ',
            'required' => false

        ))->add('emale3', EmailType::class, array(
            'attr' => array(
                'class' => 'admin-input color_text'
            ),
            'label' => 'email3: ',
            'required' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Emale'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'adminbundle_emale';
    }

}
