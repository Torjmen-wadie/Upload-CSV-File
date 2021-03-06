<?php

namespace App\Form;

use App\Entity\Upload;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', FileType::class, [
            'label' => false,
            'constraints' => [
              new File([ 
                'mimeTypes' => [ // We want to let upload  files
                    'text/plain',
                    'application/csv',
                    'application/x-csv',

                 ],
                'mimeTypesMessage' => "Vous devez sélectionner un fichier de type CSV.",
              ])
            ],
          ])
            ->add('Telecharger',SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Upload::class,
        ]);
    }
}
