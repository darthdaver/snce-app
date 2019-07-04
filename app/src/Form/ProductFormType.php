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

        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('imageFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => $imageConstraints
            ])
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                /** @var Product|null $data */
                $data = $event->getData();
                if (!$data) {
                    return;
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

?>