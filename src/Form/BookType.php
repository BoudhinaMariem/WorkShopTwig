<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ref')
            ->add('title')
            ->add('category', ChoiceType::class, [
                'choices'=>[
                    'Science'=>'science',
                    'Math'=>'math',
                    'History'=>'history'
                ],
                //liste deroullant
                'expanded'=>false,
                //une seule categorie
                'multiple'=>false
            ])
            ->add('publicationDate')
            ->add('published')
            ->add('idAuthor', EntityType::class,[
                'class'=>Author::class,
                'choice_label'=>'username',
                'multiple'=>false
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }


}
