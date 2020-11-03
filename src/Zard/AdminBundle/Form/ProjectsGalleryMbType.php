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

class ProjectsGalleryMbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('listingOrder', TextType::class, [
                'label' => 'Listing Order',
                'required' => false
            ])
            ->add('visible', CheckboxType::class, [
                'label' => 'Visible Mobile',
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
