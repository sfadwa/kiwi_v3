<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('createdBy')
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedBy')
            ->add('isActive')
            ->add('name')
            ->add('dateTimeStart',DateTimeType::class, [
                'html5'=> true,
                'widget'=> 'single_text',
                'label'=> 'Start',
                'required'=>false,
                'attr' => ['min' => (new \DateTime('now'))->format('Y-m-d\TH:i')]
            ])
            ->add('dateTimeEnd',DateTimeType::class, [
                'html5'=> true,
                'widget'=> 'single_text',
                'label'=> 'End',
                'required'=>false,
                'attr' => ['min' => (new \DateTime('now'))->format('Y-m-d\TH:i')]
            ])
            ->add('company', EntityType::class, [
                'class' => Company::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
