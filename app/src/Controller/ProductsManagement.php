<?php 
    namespace App\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;

    class ProductsManagement extends AbstractController {
        /**
         * @Route("/", name="route_home_page")
         */
        public function home_page(){
            return $this->render('homepage/home_page.html.twig');
        }

        /**
         * @Route("/product/create", name="route_create_page")
         */
        public function create_page(){
            return $this->render('products/create_page.html.twig');
        }

        /**
         * @Route("/product/create", name="route_create_product", methods="POST")
         */
        public function create_product(){
            return $this->render('products/create_product.html.twig');
        }

        /**
         * @Route("/product/list", name="route_list_page")
         */
        public function list_page(){
            return $this->render('products/list_page.html.twig');
        }

        /**
         * @Route("/product/edit", name="route_edit_page")
         */
        public function edit_page(){
            return $this->render('products/edit_page.html.twig');
        }

        /**
         * @Route("/product/{product}/edit", name="route_edit_product", methods="POST")
         */
        public function edit_product($product){
            return new Response(sprintf('Say: %s', $product));
        }
    }
?>