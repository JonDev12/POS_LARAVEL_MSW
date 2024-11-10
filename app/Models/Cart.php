<?php

namespace App\Models;



class Cart
{
    //Añadir un producto al carrito
    public static function add(Product $product)
    {
        // add the product to cart
        \Cart::session(userID())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->precio_venta,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

    }

    //Obtener el contenido del carrito
    public static function getCart(){

        $cart = \Cart::session(userID())->getContent();
        return $cart->sort();
    }
}
