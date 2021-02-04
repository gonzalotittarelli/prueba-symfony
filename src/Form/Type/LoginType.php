<?php

namespace App\Form\Type;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'Debe ingresar un mail'
                    ]),                    
                    new Email([
                        'message' => 'Debe ingresar un mail valido'
                    ]),
                ]
            ])
            ->add('password', PasswordType::class, [
                'constraints' => [
                    new NotNull([
                        'message' => 'Debe ingresar una clave'
                    ]),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Usuario::class,
            ]
        );
    }
}