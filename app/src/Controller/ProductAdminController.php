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

    class ProductAdminController extends AbstractController {
        /**
         * @Route("/", name="route_home_page")
         */
        public function home_page(){
            return $this->render('homepage/home_page.html.twig');
        }

        /**
         * @Route("/product/create", name="route_create_product", methods="POST")
         */
        public function create_product(EntityManagerInterface $em, Request $request){
            $form = $this->createForm(ProductFormType::class);
            
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                #$data = $form->getData();
                #$product = new Product();
                #$product->setName($data['name']);
                #$product->setDescription($data['description']);
                #image
                #tags

                #em->persist($product);
                #$em->flush();
                
                $product = $form->getData();

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
         * @Route("/product/{product}/edit", name="route_edit_product", methods="POST")
         */
        public function edit_product($product){
            return new Response(sprintf('Say: %s', $product));
        }
    }
?>