<?php 
    namespace App\Controller;

    use Doctrine\ORM\EntityManagerInterface;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\File\UploadedFile;
    use App\Repository\ProductRepository;
    use App\Form\ProductFormType;
    use App\Service\UploaderHelper;

    class ProductAdminController extends AbstractController {
        /**
         * @Route("/", name="route_home_page")
         */
        public function home_page(){
            return $this->render('homepage/home_page.html.twig');
        }

        /**
         * @Route("/product/create", name="route_create_product")
         */
        public function create_product(EntityManagerInterface $em, Request $request, UploaderHelper $uploaderHelper){
            $form = $this->createForm(ProductFormType::class);
            
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                /** @var Product $product */
                $product = $form->getData();
                dd($product);

                /** @var UploadedFile $uploadedFile */
                $uploadedFile = $form['imageFile']->getData();

                if ($uploadedFile) {
                    $newFilename = $uploaderHelper->uploadProductImage($uploadedFile);
                    dd($product);
                    $product->setImage($newFilename);
                }

                #$em->persist($product);
                #$em->flush();

                $this->addFlash('success', 'Product created!');

                return $this->redirectToRoute('route_list_products');
            }

            return $this->render('products/create_page.html.twig', [
                'productForm' => $form->createView()
            ]);
        }

        /**
         * @Route("/product/list", name="route_list_products")
         */
        public function list_products(ProductRepository $productsRepo){
            $products = $products->findAll();

            return $this->render('products/list_page.html.twig', [
                'products' => $products
            ]);
        }

        /**
         * @Route("/product/{product}/edit", name="route_edit_product")
         */
        public function edit_product($product){
            /** @var Product $product */
            $product = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadProductImage($uploadedFile);
                $product->setImage($newFilename);
            }

            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Product updated!');

            return $this->redirectToRoute('route_list_products');
        }
    }
?>