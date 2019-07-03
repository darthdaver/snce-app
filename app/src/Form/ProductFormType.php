<?php 

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductFormType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /** @var Product|null $article */
        $product = $options['data'] ?? null;
        $isEdit = $product && $product->getId();

        $builder
            ->add('Name', TextType::class, [
                'help' => 'Choose something catchy!'
            ])
            ->add('Description', null, [
                'rows' => 15
            ])
            ->add('Image', FileType::class)
        ;

        if ($options['include_published_at']) {
            $builder->add('publishedAt', null, [
                'widget' => 'single_text',
            ]);
        }
    }
}

?>