<?php

namespace PubLeashBundle\Form;

use Doctrine\ORM\EntityRepository;
use PubLeashBundle\Form\Type\HiddenEntityType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('label' => false, 'translation_domain' => 'PubLeashBundle', 'attr' => ['placeholder' => 'publication.title']))
            ->add('description', TextType::class, array('label' => false, 'translation_domain' => 'PubLeashBundle', 'attr' => ['placeholder' => 'publication.description']))
            ->add('language', EntityType::class, [
                    'class' => 'PubLeashBundle\Entity\LanguageEnum',
                    'choice_label' => 'name',
                    'label' => false
                ]
            )
            ->add('authors', CollectionType::class, [
                'entry_type' => HiddenEntityType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_options' => [
                    'attr' => [
                        'allowDeleteOnlyRegistered' => true
                    ]
                ]
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PubLeashBundle\Entity\Publication'
        ));
    }
}
