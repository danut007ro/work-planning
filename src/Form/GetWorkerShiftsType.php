<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Worker;
use App\Request\GetWorkerShiftsRequest;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class GetWorkerShiftsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('worker', EntityType::class, [
                'class' => Worker::class,
            ])
            ->add('date', DateType::class, [
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GetWorkerShiftsRequest::class,
        ]);
    }
}
