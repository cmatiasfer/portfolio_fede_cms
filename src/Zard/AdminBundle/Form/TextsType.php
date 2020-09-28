<?php

namespace App\Zard\AdminBundle\Form;

use App\Zard\CoreBundle\Entity\Texts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType,TextareaType,ChoiceType};

class TextsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('variable', TextType::class, [
                'label' => 'Variable',
                'attr' => [
                    'class' => 'col-sm-12'
                ]
            ])
            ->add('title', TextType::class, [
                'label' => 'Title',
                'required' => false,
                'empty_data' => '',
            ])
            ->add('text', TextareaType::class, [
                'label' => 'Text',
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'class' => 'applyCKEditor'
                ]
            ])
            ->add('seoTitle', TextType::class, [
                'label' => 'Seo Title',
                'required' => false,
                'empty_data' => ''
            ])
            ->add('seoDesc', TextareaType::class, [
                'label' => 'Seo Desc',
                'required' => false,
                'empty_data' => ''
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Texts::class,
        ]);
    }
}
