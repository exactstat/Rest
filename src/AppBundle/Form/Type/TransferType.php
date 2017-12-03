<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 02.12.17 17:36
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Transfer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TransferType
 * @package AppBundle\Form\Type
 * @author Roman Senchuk frspm.roman@gmail.com
 */
class TransferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('senderAccount', TextType::class)
            ->add('receiverAccount', TextType::class)
            ->add('purpose', TextType::class)
            ->add('money', MoneyType::class)
            ->add('commissionOnSender', CheckboxType::class);

        if (\in_array('chd', $options, true)) {
            if ($options['label'] === 'chd') {
                unset($options['label']);
                $builder->add('chd', CHDType::class);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(
                [
                    'data_class' => Transfer::class,
                    'allow_extra_fields' => true,
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }
}