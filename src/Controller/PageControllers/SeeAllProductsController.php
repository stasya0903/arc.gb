<?php


namespace Controller\PageControllers;


use Framework\BaseController;
use http\Client\Request;
use Service\Product\ProductService;

class SeeAllProductsController extends BaseController
{
    public function index(Request $request){

        $productList = (new ProductService())->getAll(
            $request->query->get('sort', '')
        );

        return $this->render(
            'product/list.html.php',
            ['productList' => $productList]
        );
    }

}
