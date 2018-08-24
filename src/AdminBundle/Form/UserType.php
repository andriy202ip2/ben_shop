<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, array(
            'attr' => array(
                'class' => 'admin-input'
            ),
            'label' => 'Логін: '
        ))
            ->add('password', PasswordType::class, array(
                'attr' => array(
                    'class' => 'admin-input color_text'
                ),
                'label' => 'Пароль: '
            ))
            ->add('email', EmailType::class, array(
                'attr' => array(
                    'class' => 'admin-input color_text'
                ),
                'label' => 'Email: '
            ))
            ->add('name', TextType::class, array(
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Імя: '
            ))
            ->add('surname', TextType::class, array(
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Прізвище: '
            ))
            ->add('isActive', CheckboxType::class, array(
                'attr' => array(
                    'class' => 'admin-chekbox'
                ),
                'required' => false,
                'label' => 'Чи активований: '
            ))
            /*                ->add('salt', TextType::class, array(
                                'attr' => array(
                                    'class' => 'admin-input'
                                ),
                                'required' => false,
                                'label' => 'Сіль Паролю: '
                            ))*/
            ->add('role', ChoiceType::class, array(
                'attr' => array(
                    'class' => 'admin-selekt cat'
                ),
                'label' => 'Роль: ',
                'choices' => array(
                    'ОПТОВИК' => 'ROLE_USER',
                    'ДРОПШИППЕР' => 'ROLE_TEAM',
                    /*'ROLE_OPERATOR' => 'ROLE_OPERATOR', */
                    'АДМІНІСТРАТОР' => 'ROLE_ADMIN',
                    'СУПЕР АДМІНІСТРАТОР' => 'ROLE_ROOT',),
                'empty_data' => 'ROLE_USER'
            ))
            ->add('storeAddress', TextareaType::class, array(
                'attr' => array(
                    'class' => 'admin-textrea'
                ),
                'label' => 'Aдреса магазину, СТО, сайту: ',
                'label_attr' => array('class' => 'admin-text-lebel')
            ));

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
