<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculatorType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'calculator',
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('a', NumberType::class, [
                'label' => 'First Number',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Type('numeric'),
                ],
            ])
            ->add('operation', ChoiceType::class, [
                'label' => 'Operation',
                'choices' => [
                    'Add' => 'add',
                    'Subtract' => 'subtract',
                    'Multiply' => 'multiply',
                    'Divide' => 'divide',
                ],
            ])
            ->add('b', NumberType::class, [
                'label' => 'Second Number',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Type('numeric'),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Calculate',
            ]);
    }
}
