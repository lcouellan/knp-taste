<?php


namespace App\Form\Type;

use App\Entity\User;
use App\Validator\Constraint\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'constraints' => [
                    new UniqueConstraint(['field' => 'username', 'entity' => User::class])
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new UniqueConstraint(['field' => 'email', 'entity' => User::class])
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match',
                'required' => true,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat password'],
                'constraints' => [
                    new Length([
                        'min' => 8
                    ])
                ]
            ])
            ->add('validate', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}