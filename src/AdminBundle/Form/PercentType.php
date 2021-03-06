<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class PercentType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->add('cheat', NumberType::class, array(
                'scale' => 2,
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Накрутка для користувача (роздріб) %: ',
                'label_attr' => array('class' => 'admin-text-lebel')
            ))
            ->add('percent', NumberType::class, array(
                'scale' => 2,
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Знижка для користувача (банер знижки) %: ',
                'label_attr' => array('class' => 'admin-text-lebel')
            ))
            ->add('cheatWholesaler', NumberType::class, array(
                'scale' => 2,
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Накрутка для оптовика: %: ',
                'label_attr' => array('class' => 'admin-text-lebel')
            ))
            ->add('percentWholesaler', NumberType::class, array(
                'scale' => 2,
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Знижка для оптовика (банер знижки) %: ',
                'label_attr' => array('class' => 'admin-text-lebel')
            ))
            ->add('cheatDropshipper', NumberType::class, array(
                'scale' => 2,
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Накрутка для Дропшиперa: %: ',
                'label_attr' => array('class' => 'admin-text-lebel')
            ))
            ->add('percentDropshipper', NumberType::class, array(
                'scale' => 2,
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Знижка для Дропшиперa (банер знижки) %: ',
                'label_attr' => array('class' => 'admin-text-lebel')
            ));
        
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Percent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'adminbundle_percent';
    }

}
