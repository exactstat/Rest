<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 02.12.17 17:36
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Money;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TransferType
 * @package AppBundle\Form\Type
 * @author Roman Senchuk frspm.roman@gmail.com
 */
class MoneyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount', IntegerType::class)
            ->add('cents', IntegerType::class)
            ->add('currency', ChoiceType::class, ['choices'=>[
                'usd' => Money::USD_C,
                'uah' => Money::UAH_C,
                'eur' => Money::EUR_C,
                'euro' => Money::EUR_C
            ]]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(['data_class' => Money::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }
}