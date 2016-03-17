<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/15/16
 * Time: 5:38 PM
 */

namespace PubLeashBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class HiddenEntityType extends AbstractType
{

    public function getParent()
    {
        return HiddenType::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);
    }

    public function getBlockPrefix()
    {
        return 'hidden_entity';
    }
}