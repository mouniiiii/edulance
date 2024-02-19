<?php

// src/Form/OffreType.php

namespace App\Form;

use App\Entity\OffreGestion\Offre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; // Import EntityType

class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $language = [
            'English' => 'en',
            'Spanish' => 'es',
            'French' => 'fr',
            'German' => 'de',
            'Chinese' => 'zh',
            'Japanese' => 'ja',
            'Russian' => 'ru',
            'Portuguese' => 'pt',
            'Arabic' => 'ar',
            'Hindi' => 'hi',
            'Italian' => 'it',
            'Korean' => 'ko',
            'Dutch' => 'nl',
            'Turkish' => 'tr',
            'Polish' => 'pl',
            'Swedish' => 'sv',
            'Indonesian' => 'id',
            'Greek' => 'el',
            'Thai' => 'th',
            'Vietnamese' => 'vi',
        ];

        $builder
            ->add('Titre', TextType::class, [
                'label' => 'Title',
                'attr' => ['placeholder' => 'Enter your job title']
            ])
            ->add('IdCategory', EntityType::class, [ // Adjusted to getIdCategory
                'class' => 'App\Entity\OffreGestion\Categorie', // Adjust class path if needed
                'choice_label' => 'Titre', // Display property of the Categorie entity
                'label' => 'Category',
                'placeholder' => 'Choose a category', // Optional placeholder
                'required' => true, // Optional
            ])
            ->add('Type_Offre', ChoiceType::class, [
                'label' => 'Type_Offre',
                'choices' => [
                    'Offre d\'emploi' => 'Offre d\'emploi',
                    'Offre de service' => 'Offre de service'
                ],
                'placeholder' => 'Choose an option', // Optional
                'required' => true, // Optional
            ])
            

            ->add('ExperienceLevel', ChoiceType::class, [
                'label' => 'ExperienceLevel',
                'choices' => [
                    'Entry level' => 'Entry level',
                    'Junior' => 'Junior',
                    'Senior' => 'Senior'
                ],
                'placeholder' => 'Choose an option', // Optional
                'required' => true, // Optional
            ])


            ->add('Salary', ChoiceType::class, [
                'label' => 'Salary Range',
                'choices' => [
                    'Less than $30,000' => 'Less than $30,000',
                    '$30,000 - $50,000' => '$30,000 - $50,000',
                    '$50,000 - $70,000' => '$50,000 - $70,000',
                    '$70,000 - $100,000' => '$70,000 - $100,000',
                    'More than $100,000' => 'More than $100,000',
                ],
                'placeholder' => 'Choose an option', // Optional
                'required' => true, // Optional
            ])

            ->add('ExpirationDate', DateType::class, [
                'attr' => ['placeholder' => 'Select expiration date'],
                'html5' => false, 
                'format' => 'yyyy-MM-dd',
            ])
            
            
            ->add('Description', TextareaType::class, [
                'label' => 'Description',
            ])

            ->add('Language', ChoiceType::class, [
                'choices' => $language,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Select Languages'
            ])

            ->add('save', SubmitType::class, [
                'label' => 'Save',
                'attr' => ['class' => 'btn Post-Job-Offer']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
    