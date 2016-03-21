<?php

namespace PubLeashBundle\Form;

use Doctrine\ORM\EntityRepository;
use PubLeashBundle\Entity\Publication;
use PubLeashBundle\Entity\User;
use PubLeashBundle\Form\Type\HiddenEntityType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
            )->add('authors', EntityType::class, [
                'label' => false,
                'expanded' => false,
                'multiple' => true,
                'class' => User::class
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event){

//            /** @var Publication $publication */
//            $publication = $event->getForm()->getData();
//            $eventAuthors = $event->getData()['authors'];
//            /** @var User $author */
//            foreach($publication->getAuthors() as $author){
//                if(!in_array($author->getId(), $eventAuthors)){
//                    $author->removePublication($publication);
//                }
//            }
        });

        $builder->addEventListener(FormEvents::SUBMIT, function(FormEvent $event) {
//            /** @var Publication $publication */
//            $publication = $event->getData();
//            /** @var User $author */
//            foreach($publication->getAuthors() as $author){
//                $author->addPublication($publication);
//            }
//            $publication->add
        });
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
