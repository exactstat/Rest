<?php
/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 01.12.17 21:24
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User;

/**
 * Class RegistrationFormType
 * @package AppBundle\Form\Type
 * @author Nazar Salo <salo.nazar@gmail.com>
 */
class RegistrationFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('username', TextType::class, ['required' => true])
            ->add('email',TextType::class, ['required' => true])
            ->add('plainPassword', PasswordType::class, ['required' => true])
        ;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'allow_extra_fields' => true,
            'intention' => 'registration',
            'data_class' => User::class
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getBlockPrefix()
    {
        return 'registration';
    }
}