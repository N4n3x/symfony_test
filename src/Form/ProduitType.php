<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('slug')
            ->add('Titre')
            ->add('Description')
            ->add('PrixTTC', MoneyType::class, ['divisor' => 1])
            ->add('Poids')
            ->add('Couleur', ChoiceType::class, ['choices' => $this->getColorChoice()])
            ->add('DateCreated', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('StockQte')
            ->add('Actif')
            ->add('marque', EntityType::class, ['class' => Marque::class, 'choice_label' => 'Nom'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
            'translation_domain' => 'forms'
        ]);
    }

    public function getColorChoice(){
        return array_flip(Produit::COULEUR);
    }
}
