<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/proj_aval_php/src/dao/ProductDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/proj_aval_php/src/model/Product.php';

$productDAO = new ProductDAO();
$product = new Product();

$product->setName(filter_input(INPUT_POST, "name_add"));

$price = str_replace(",", ".", filter_input(INPUT_POST, "price_add"));
$price_formatted = number_format($price, 2, '.', ',');

$product->setPrice($price_formatted);

$product->setColor(filter_input(INPUT_POST, "color_add"));

if ($productDAO->add($product)) { 
    echo "TRUE";
} else {
    echo "FALSE";
}