<?php

namespace App\Zard\AdminBundle\Form;

use App\Zard\CoreBundle\Entity\Projects;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType,TextareaType,ChoiceType,HiddenType};

class ProjectsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Name',
                'empty_data' => '',
                'required' => false
            ])
            ->add('text', TextareaType::class, [
                'label' => 'Text',
                'required' => false,
                'attr' => [
                    'class' => 'applyCKEditor'
                ]
            ])
            ->add('color', TextType::class, [
                'label' => 'Text Color ',
                'required' => true,
                'empty_data' => '',
                'attr' => [
                    'autocomplete' => 'off'
                ],
            ])     
            ->add('listingOrder',TextType::class, [
                'label' => 'Order',
                'empty_data' => '',
                'required' => false
            ])
            ->add('gallery', HiddenType::class, [
                'label' => 'Galería',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'class' => 'dropzoneGallery',
                    'data-addform' => $options["configDropzone"]['ADD_FORM'],
                    'data-filetype' => $options["configDropzone"]['FILETYPE'],
                    'data-lang' => $options["configDropzone"]['LANG'],
                    'data-maxfilesize' => $options["configDropzone"]['MAXFILESIZE'],
                    'data-rules' => json_encode($options["configDropzone"]['rules_image']),
                    /* 'data-modeeditionimage' => $options["configDropzone"]['MODE_EDITION_IMAGE'],
                    'data-dimensionimage' => $options["configDropzone"]['DIMENSIONS'], */
                ]
            ])     
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projects::class,
        ])
        ->setRequired(array(
            'configDropzone'
        ));
    }
}
