<?php 

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Entity\Product;
use App\Form\TagFormType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Validator\Constraints\Count;

class ProductFormType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /** @var Product|null $product */
        $product = $options['data'] ?? null;
        $isEdit = $product && $product->getId();

        $imageConstraints = [
            new Image([
                'maxSize' => '10M'
            ])
        ];

        $tagsConstraints = [
            'min' => 1, 
            'minMessage' => "Please insert at least one tag"
        ];

        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class, [
                'required' => false
            ])
            ->add('imageFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => $imageConstraints
            ])
            ->add('tags', CollectionType::class, [
                'entry_type' => TagFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => false,
                'constraints' => new Count(array('min' => 1, 
                'minMessage' => "Please insert at least one tag"))
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

?>