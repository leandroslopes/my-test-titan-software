<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/proj_aval_php/src/dao/ProductDAO.php';

$productDAO = new ProductDAO();

if ($productDAO->delete(filter_input(INPUT_POST, "id"))) { 
    echo "TRUE";
} else {
    echo "FALSE";
}