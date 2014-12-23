<?php

namespace DK\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $builder->add('nameFirst', 'text', ['label' => 'First name:']);
        $builder->add('nameLast', 'text', ['label' => 'Last name:']);
    }

    public function getName() {
        return 'dk_user_profile';
    }

}
