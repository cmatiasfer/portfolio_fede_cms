<?php

namespace App\Zard\AdminBundle\Form;

use App\Zard\CoreBundle\Entity\Home;
use App\Zard\CoreBundle\Entity\HomeGallery;
use App\Zard\CoreBundle\Service\AdminService;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Presta\ImageBundle\Form\Type\ImageType;

class HomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'required' => true,
                'empty_data' => ''
            ])
           
            ->add('orderGallery', ChoiceType::class, [
                'label' => 'Order Type',
                'required' => true,
                'choices' => array(
                    'Random' => 'order-random',
                    'By Project' => 'order-by-project',
                ),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Home::class,
        ]);
    }
}
