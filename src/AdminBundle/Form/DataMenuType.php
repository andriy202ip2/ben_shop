<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class DataMenuType extends AbstractType {

        
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        //$builder->;
        
        $formModifier = function (FormEvent $event) {
            
            $form = $event->getForm();              
            $data = $event->getData();
            
            //echo $options['no_submit'];

            
            $is_no_model = $data->getModel() == NULL;
            
            //var_dump($data);    
            //$em = $this->container;
            
            if ($is_no_model) {
                
                $autos = array();
                
            } else {
                
                var_dump($data->getModel()->getName());
                var_dump($data->getAuto()->getName());
                var_dump($data->getName());
            }
            
            //
            
            //var_dump($data);
            
            $form->add('model', EntityType::class, array(
                        'class' => 'ShopMenuBundle:ModelMenu',
                        'choice_label' => 'name',
                        'attr' => array(
                            'class' => 'admin-selekt cat mid'
                        ),
                        'label' => 'Модель: '
                    ))
                    ->add('auto', EntityType::class, array(
                        'class' => 'ShopMenuBundle:AutoMenu',
                        'choices' => $autos,
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
            
        };

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier) {                                  
            $formModifier($event);
        });

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($formModifier) {            
            $formModifier($event);
        });


//'data' => rand(0, 1111)       
    }

    //
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Shop\MenuBundle\Entity\DataMenu'
        ));
        $resolver->setRequired('em')->setRequired('no_submit');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'shop_menubundle_datamenu';
    }

}
