<?php


namespace Controller\PageControllers;


use Service\Order\Basket;
use Service\Product\ProductService;

class addProductToBasketController
{
    public function index(Request $request, string $id){
        $basket = (new Basket($request->getSession()));

        $productInfo = (new ProductService())->getInfo((int)$id);


        if ($productInfo === null) {
            return $this->render('error404.html.php');
        }

        $basket->addProduct((int)$request->request->get('product'));

        $isInBasket = $basket->isProductInBasket($productInfo->getId());

        return $this->render(
            'product/info.html.php',
            ['productInfo' => $productInfo, 'isInBasket' => $isInBasket]
        );
    }

}
