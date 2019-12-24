<?php

namespace App\Form;

use App\Entity\Medecin;
use Doctrine\Common\Annotations\Annotation\Attribute;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class MedecinType extends AbstractType
{ public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
            ->add('prenom',TextType::class)
            ->add('nom',TextType::class)
            ->add('datenaissance', DateType::class, ['widget' => 'single_text'])
            ->add('Email') 
            ->add('Tel') 
            ->add('service')
            ->add('specialites',null,['multiple'=>true])
            ;
    }
   
  public function configureOptions(OptionsResolver $resolver)
    
    {
        $resolver->setDefaults(['data_class' => Medecin::class,]);
    }
}