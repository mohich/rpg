<?php

namespace RpgBundle\Form;



use RpgBundle\Entity\Player;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
            ->add("username", TextType::class,
                ['label' => 'Username: '])
            ->add('password', RepeatedType::class, array(
            'first_name' => 'pass',
            'second_name' => 'confirm',
            'type' => PasswordType::class,
            /*'constraints'=>array('You entered an invalid value,it should include %num% characters',
                            'invalid_message_parameters' => array('%num%' => 3))*/
             ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
            $resolver->setDefaults(['data_class'=>Player::class]);
    }

    public function getName()
    {
             return 'rpg_bundle_player_type';
    }
}
