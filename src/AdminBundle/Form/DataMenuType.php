<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DataMenuType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->add('model', EntityType::class, array(
                    'class' => 'ShopMenuBundle:ModelMenu',
                    'choice_label' => 'name',
                    'attr' => array(
                        'class' => 'admin-selekt cat'
                    ),
                    'label' => 'Модель: '
                ))
                ->add('auto', EntityType::class, array(
                    'class' => 'ShopMenuBundle:AutoMenu',
                    'choice_label' => 'name',
                    'attr' => array(
                        'class' => 'admin-selekt cat'
                    ),
                    'label' => 'Авто: '
                ))
                ->add('name', TextType::class, array(
                    'attr' => array(
                        'class' => 'admin-input'
                    ),
                    'label' => 'Рік: '
        ));
    }

    //
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Shop\MenuBundle\Entity\DataMenu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'shop_menubundle_datamenu';
    }

}
