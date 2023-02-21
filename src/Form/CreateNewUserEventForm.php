<?php

namespace App\Form;

use App\Entity\UserEvent;
use App\Repository\EventRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateNewUserEventForm extends AbstractType
{
    public function __construct(
        private readonly EventRepository $eventRepository,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('event', ChoiceType::class, ['label' => 'Exercise', 'placeholder' => 'Choose an exercise',
                'choices' =>  $this->eventRepository->getAllEventsIndexedByTitle(),
                'choice_attr' => function($val, $key, $index) {
                    return ['title' => $this->eventRepository->findOneBy(['id' => $val])->getExerciseType(), ];},
                'attr' => ['style' => 'border: 1px solid black; border-radius: 5px', 'class' => 'choose_event p-2'],
                'label_attr' => [ 'class' => 'p-3 m-5']]);

        $builder
            ->add('reps', IntegerType::class, ['label' => 'Number of reps',
                'attr' => ['style' => 'border: 1px solid black', 'class' => 'reps', 'placeholder' => 'Introduce nr. of reps',],
                'label_attr' => [ 'class' => 'p-3 m-5']])
            ->add('weight', IntegerType::class, ['label' => 'Weight used (nr or null for body-weight)',
                'attr' => ['style' => 'border: 1px solid black', 'class' => 'weight','placeholder' => 'Introduce weight',],
                'label_attr' => [ 'class' => 'p-3 m-5']]);
        $builder
            ->add('duration', IntegerType::class, ['label' => 'Desired duration (in minutes)',
                'attr' => ['style' => 'border: 1px solid black', 'class' => 'duration', 'placeholder' => 'Introduce workout duration',],
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
