<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Tbbc\MoneyBundle\Form\Type\MoneyType;

class ItemsType extends AbstractType
{

    private $em;
    private $no_submit;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $this->em = $options['em'];
        $this->no_submit = $options['no_submit'];

        $builder->add('model', EntityType::class, array(
            'class' => 'ShopMenuBundle:ModelMenu',
            'choice_label' => 'name',
            'attr' => array(
                'class' => 'admin-selekt cat mid'
            ),
            'label' => 'Модель: '
        ))
            ->add('auto', EntityType::class, array(
                'class' => 'ShopMenuBundle:AutoMenu',
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'admin-selekt cat aid'
                ),
                'label' => 'Авто: '
            ))
            ->add('data', EntityType::class, array(
                'class' => 'ShopMenuBundle:DataMenu',
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'admin-selekt cat'
                ),
                'label' => 'Рока: '
            ))
            ->add('sideId', ChoiceType::class, array(
                'choices' => array(
                    'Передня' => 1,
                    'Задня' => 2,
                ),
                'attr' => array(
                    'class' => 'admin-selekt cat'
                ),
                'label' => 'Сторона: '
            ))
            ->add('tId', ChoiceType::class, array(
                'choices' => array(
                    'Амортизатор' => 3,
                    'Пружина ' => 2,
                    'Поперечний важіль' => 5,
                ),
                'attr' => array(
                    'class' => 'admin-selekt cat'
                ),
                'label' => 'Запчастина: '
            ))
            ->add('itemIs', ChoiceType::class, array(
                'choices' => array(
                    'в наявності' => 1,
                    'під замовлення ' => 0,
                ),
                'attr' => array(
                    'class' => 'admin-selekt cat'
                ),
                'label' => 'Чи э в наявності: '
            ))
            ->add('img', FileType::class, array(
                'data_class' => null,
                'required' => false,
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Малюнок: '
            ))
            ->add('price', MoneyType::class, array(
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Ціна: '))
            ->add('name', CKEditorType::class, array(
                'config' => array(
                    'width' => '700px',
                ),
                'attr' => array(
                    'class' => 'admin-textrea'
                ),
                'label' => 'Код GH: ',
                'label_attr' => array('class' => 'admin-text-lebel')
            ))
            ->add('itemId', TextType::class, array(
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Айди продукта: '
            ))
            ->add('side', CKEditorType::class, array(
                'config' => array(
                    'width' => '700px',
                ),
                'attr' => array(
                    'class' => 'admin-textrea'
                ),
                'label' => 'Сторона Опис: ',
                'label_attr' => array('class' => 'admin-text-lebel')
            ))
            ->add('fit', CKEditorType::class, array(
                'config' => array(
                    'width' => '700px',
                ),
                'attr' => array(
                    'class' => 'admin-textrea'
                ),
                'label' => 'Застосування: ',
                'label_attr' => array('class' => 'admin-text-lebel')
            ))
            ->add('imgData', CKEditorType::class, array(
                'config' => array(
                    'width' => '700px',
                ),
                'attr' => array(
                    'class' => 'admin-textrea'
                ),
                'label' => 'Опис малюнку: ',
                'label_attr' => array('class' => 'admin-text-lebel')
            ))
            ->add('details', CKEditorType::class, array(
                'config' => array(
                    'width' => '700px',
                ),
                'attr' => array(
                    'class' => 'admin-textrea'
                ),
                'label' => 'Деталі: ',
                'label_attr' => array('class' => 'admin-text-lebel')
            ))
            ->add('acsesorisImg', FileType::class, array(
                'data_class' => null,
                'required' => false,
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Малюнок Аксесуару: '
            ))
            ->add('acsesorisPrice', MoneyType::class, array(
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Ціна  Аксесуару: '))
            ->add('acsesoriIs', ChoiceType::class, array(
                'choices' => array(
                    'в наявності' => 1,
                    'під замовлення ' => 0,
                ),
                'attr' => array(
                    'class' => 'admin-selekt cat'
                ),
                'label' => 'Чи э в наявності Аксесуар: '
            ))
            ->add('acsesorisId', TextType::class, array(
                'attr' => array(
                    'class' => 'admin-input'
                ),
                'label' => 'Айди Аксесуару: '
            ))
            ->add('acsesorisImgData', CKEditorType::class, array(
                'config' => array(
                    'width' => '700px',
                ),
                'attr' => array(
                    'class' => 'admin-textrea'
                ),
                'label' => 'Опис Аксесуару: ',
                'label_attr' => array('class' => 'admin-text-lebel')
            ));

        $formModifier = function (FormEvent $event) {

            $form = $event->getForm();
            $data = $event->getData();

            $autos = array();
            if ($data->getModel() == NULL) {
                $model_id = $this->em->getRepository('ShopMenuBundle:ModelMenu')->findOneBy([])->getId();
            } else {
                $model_id = $data->getModel()->getId();
                //var_dump($data->getModel()->getName());                
            }

            $autos = $this->em->getRepository('ShopMenuBundle:AutoMenu')->findBy(["modelMenuId" => $model_id]);

            if ($data->getAuto() == NULL) {
                $autos_id = $autos[0]->getId();
            } else {
                $autos_id = $data->getAuto()->getId();

                $is_contein = false;
                foreach ($autos as $auto) {
                    if ($auto->getId() == $autos_id) {
                        $is_contein = true;
                        break;
                    }
                }
                if (!$is_contein) {
                    $autos_id = $autos[0]->getId();
                }
                //var_dump($data->getAuto()->getName());
            }

            $datas = $this->em->getRepository('ShopMenuBundle:DataMenu')->findBy(["autoMenuId" => $autos_id]);


            //var_dump($data);

            $form->add('auto', EntityType::class, array(
                'class' => 'ShopMenuBundle:AutoMenu',
                'choices' => $autos,
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'admin-selekt cat aid'
                ),
                'label' => 'Авто: '
            ))->add('data', EntityType::class, array(
                'class' => 'ShopMenuBundle:DataMenu',
                'choices' => $datas,
                'choice_label' => 'name',
                'attr' => array(
                    'class' => 'admin-selekt cat'
                ),
                'label' => 'Рока: '
            ));
        };

        if (!$this->no_submit) {
            $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier) {
                $formModifier($event);
            });
        }

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($formModifier) {
            $formModifier($event);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Shop\MenuBundle\Entity\Items'
        ));
        $resolver->setRequired('em')->setRequired('no_submit');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'shop_menubundle_items';
    }

}
