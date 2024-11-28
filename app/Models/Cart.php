<?php

namespace App\Models;


class Cart 
{
    //Agregar producto al carrito
    public static function add(Product $product)
    {
        // Quick Usage with the Product Model Association & User session binding
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

    //obtener contenido del carrito
    public static function getCart(){
        $cart = \Cart::session(userID())->getContent();
        return $cart->sort();
    }

    //Devuelve el total
    public static function getTotal(){
        return \Cart::session(userID())->getTotal();
    }

    //Decrementar carrito
    public static function decrement($id){
        \Cart::session(userID())->update($id, [
            'quantity' => -1
        ]);
    }

    //Incrementar carrito
    public static function increment($id){
        \Cart::session(userID())->update($id, [
            'quantity' => + 1
        ]);
    }

    //Eliminar producto del carrito
    public static function removeItem($id){
        \Cart::session(userID())->remove($id);
    }

    //Limpiar carrito
    public static function clear(){
        \Cart::session(userID())->clear();
    }

    //Total articulos
    public static function totalArticulos(){
        return \Cart::session(userID())->getTotalQuantity();
    }
}
