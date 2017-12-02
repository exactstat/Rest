<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 02.12.17 17:55
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\CHD;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CHDType
 * @package AppBundle\Form\Type
 * @author Roman Senchuk frspm.roman@gmail.com
 */
class CHDType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cardNumber', TextType::class)
            ->add('firstName', TextType::class)
            ->add('secondName', TextType::class)
            ->add('expMon', TextType::class)
            ->add('expYear', TextType::class)
            ->add('code', TextType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(['data_class' => CHD::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'card';
    }
}