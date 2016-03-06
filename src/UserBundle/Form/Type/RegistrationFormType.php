<?php
namespace UserBundle\Form\Type;
use FOS\UserBundle\Form\Type\RegistrationFormType as FOSRegistrationFormType;
use FOS\UserBundle\FOSUserBundle;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/6/16
 * Time: 11:15 AM
 */
class RegistrationFormType extends FOSRegistrationFormType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('label' => false, 'translation_domain' => 'FOSUserBundle', 'attr' => ['placeholder' => 'form.email']))
            ->add('username', TextType::class, array('label' => false, 'translation_domain' => 'FOSUserBundle', 'attr' => ['placeholder' => 'form.username']))
            ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
                'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => false, 'attr' => ['placeholder' => 'form.password']),
                'second_options' => array('label' => false, 'attr' => ['placeholder' => 'form.password_confirmation']),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('language', EntityType::class, [
                'class' => 'PubLeashBundle\Entity\LanguageEnum',
                'choice_label' => 'name',
                'label' => false
            ])
            ->add('first_name', TextType::class, array('label' => false, 'translation_domain' => 'PubLeashBundle', 'attr' => ['placeholder' => 'user.name']))
            ->add('last_name', TextType::class, array('label' => false, 'translation_domain' => 'PubLeashBundle', 'attr' => ['placeholder' => 'user.surname']))
            ->add('address', TextType::class, array('label' => false, 'translation_domain' => 'PubLeashBundle', 'attr' => ['placeholder' => 'user.address']))
            ->add('city', TextType::class, array('label' => false, 'translation_domain' => 'PubLeashBundle', 'attr' => ['placeholder' => 'user.city']))
            ->add('country', CountryType::class, array('label' => false, 'translation_domain' => 'PubLeashBundle', 'attr' => ['placeholder' => 'user.country']))

        ;
    }


}