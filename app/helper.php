<?php 

//Devuelve ID del usuario autenticado
function userID(){
    return auth()->user()->id;
}

//Devuelve numero en formato de moneda
function money($number){
    return '$'.number_format($number,0,',','.');
}

//Devuelve el total en letras
function numerosLetras($number){
    return App\Models\NumerosEnLetras::convertir($number, 'Pesos', false, 'Centavos');
}

function isAdmin(){
    return auth()->user()->admin;
}