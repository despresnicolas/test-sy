<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Campus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('campus', EntityType::class, [
                'class' => Campus::class,
                'label' => 'Campus ',
                'choice_label' => 'nom',
                'multiple' => false,
                'required' => false,
            ])
            ->add('textQuery', TextType::class, [
                'label' => 'Le nom de la sortie contient',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'search',
                )
            ])
            ->add('dateDebut', DateType::class, [
                'label' => 'Entre ',
                'widget' => 'single_text',
                'years' => range(2022, 2050),
                'required' => false,
            ])
            ->add('dateFin', DateType::class, [
                'label' => 'et ',
                'widget' => 'single_text',
                'years' => range(2022, 2050),
                'required' => false,
            ])
            ->add('organisateur', CheckboxType::class, [
                'label' => 'Sorties dont je suis l\'organisateur/trice',
                'required' => false,
            ])
//            ->add('inscrit', CheckboxType::class, [
//                'label' => 'Sorties auxquelles je suis inscrit/e',
//                'required' => false,
//            ])
//            ->add('pasInscrit', CheckboxType::class, [
//                'label' => 'Sorties auxquelles je ne suis pas inscrit/e',
//                'required' => false,
//            ])
            ->add('passees', CheckboxType::class, [
                'label' => 'Sorties passées',
                'required' => false,
            ]);

    }

    /**
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'crsf_protection' => false
        ]);
    }
}