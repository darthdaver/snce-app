<?php 

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

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
            ->add('description')
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
}

?>