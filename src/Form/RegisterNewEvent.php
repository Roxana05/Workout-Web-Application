<?php

namespace App\Form;

use App\Entity\UserEvent;
use App\Repository\EventRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterNewEvent extends AbstractType
{
    public function __construct(
        private readonly EventRepository $eventRepository,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Exercise title', 'required' => true,
                'attr' => ['style' => 'border: 1px solid black; border-radius: 5px', 'class' => 'p-2'],
                'label_attr' => [ 'class' => 'p-3 m-5']])
            ->add('imageName', TextType::class, ['label' => 'The name of the image file associated with the exercise (if there is one)',
                'attr' => ['style' => 'border: 1px solid black; border-radius: 5px', 'class' => 'p-2'],
                'label_attr' => [ 'class' => 'p-3 m-5'], 'required' => false])
            ->add('exerciseType', ChoiceType::class, ['label' => 'Exercise Type', 'placeholder' => 'Select main workout type',
                'attr' => ['style' => 'border: 1px solid black; border-radius: 5px', 'class' => 'p-2'],
                'choices' => ['weight' => 'weight', 'cardio' => 'cardio'],
                'label_attr' => [ 'class' => 'p-3 m-5']])
            ->add('exerciseSubType', ChoiceType::class, ['label' => 'Exercise Sub-Type', 'placeholder' => 'Select secondary workout type',
            'required' => false,
            'attr' => ['style' => 'border: 1px solid black; border-radius: 5px', 'class' => 'p-2'],
            'choices' => ['leg' => 'leg', 'core' => 'core', 'chest' => 'chest', 'back' => 'back', 'arm' => 'arm'],
            'label_attr' => [ 'class' => 'p-3 m-5']])
            ->add('description', TextareaType::class, ['label' => 'Description',
                'required' => false,
                'attr' => ['style' => 'border: 1px solid black; border-radius: 5px', 'class' => 'p-2', 'placeholder' => 'Workout description',],
                'label_attr' => [ 'class' => 'p-3 m-5']]);

        $builder
            ->add('save', SubmitType::class, ['label' => 'sadg', 'attr' => [
                'class' => 'body-modal-submit hidden'
            ]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'type' => null,
        ]);
    }
}
