<?php

namespace App\Zard\AdminBundle\Form;

use App\Zard\CoreBundle\Entity\Projects;
use App\Zard\CoreBundle\Entity\ProjectsGallery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType, TextareaType, CheckboxType, HiddenType, ChoiceType};
use Presta\ImageBundle\Form\Type\ImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjectsGalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageMobileFile', ImageType::class, [
                'label' => 'Image Mobile ',
                'help' => 'Dimensions: min. 767x1152px / Formats: .jpg, .png, .jpeg / Max. 2048kB',
                'required' => false,
                'upload_button_class' => 'btn btn-sm btn-default',
                'preview_height' => 'auto',
                'max_width' => 768,
                'max_height' => 1150,
                'enable_remote' => false,
                'upload_mimetype' => 'image/jpeg',
                'aspect_ratios' => [] // Needs to be empty
            ])
            ->add('listingOrder', TextType::class, [
                'label' => 'Listing Order',
                'required' => false
            ])
            ->add('visible', CheckboxType::class, [
                'label' => 'Visible',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProjectsGallery::class,
        ]);
    }
}
