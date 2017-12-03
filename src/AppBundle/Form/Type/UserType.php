<?php
/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 02.12.17 18:18
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UserType
 * @author Nazar Salo <salo.nazar@gmail.com>
 */
class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email', EmailType::class)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('phone', IntegerType::class)
            ->add('passportId', TextType::class)
            ->add('address', TextType::class)
//            ->add('plainPassword', PasswordType::class, ['required' => true])
        ;
    }
}