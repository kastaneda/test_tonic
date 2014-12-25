<?php

namespace DK\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('nameFirst', 'text', ['label' => 'form.name_first', 'translation_domain' => 'UserBundle']);
        $builder->add('nameLast', 'text', ['label' => 'form.name_last', 'translation_domain' => 'UserBundle']);
    }

    public function getName()
    {
        return 'dk_user_registration';
    }
}
