<?php

namespace Lemnia\UserBundle\Form\Type;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\UserBundle\Form\Type\RegistrationFormType AS FoSRegisterForm;

class RegistrationFormType extends FoSRegisterForm
{
    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', null, array('label' => 'form.lastName', 'translation_domain' => 'FOSUserBundle'))
            ->add('firstName', null, array('label' => 'form.firstName', 'translation_domain' => 'FOSUserBundle'))
            ->add('phoneNumber', null, array('label' => 'form.phoneNumber', 'translation_domain' => 'FOSUserBundle'))
        ;
    }
}
