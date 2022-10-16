<?php

require_once 'src/dao/ProductDAO.php';

$productDAO = new ProductDAO();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto de Avaliação PHP - Titan Sofware</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="public/js/products.js"></script>

    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <h1>Projeto de Avaliação PHP - Titan Sofware</h1>
    </header>
    <main>
        <section>
            <h2>Cadastrar Produtos</h2>
            <form name="frm_add_product" id="frm_add_product">
                <label for="name">Produto:</label><br>
                <input type="text" id="name_add" name="name_add" value="" placeholder="Notebook"><br>
                <label for="price">Preço (R$):</label><br>
                <input type="text" id="price_add" name="price_add" value="" placeholder="5,599.00"><br>
                <label for="color">Color:</label><br>
                <select name="color_add" id="color_add">
                    <option value="AZUL">AZUL</option>
                    <option value="VERMELHO">VERMELHO</option>
                    <option value="AMARELO">AMARELO</option>
                </select><br><br>
                <input type="submit" value="Cadastrar">
            </form>
        </section> <br>
        <section>
            <h2>Filtrar Produtos</h2>
            <form name="frm_filter" id="frm_filter" action="/filter.php" method="POST">
                <label for="name">Produto:</label><br>
                <input type="text" id="product" name="product" value="" placeholder="Notebook"><br>
                <label for="color">Color:</label><br>
                <select name="color" id="color">
                    <option value="AZUL">AZUL</option>
                    <option value="VERMELHO">VERMELHO</option>
                    <option value="AMARELO">AMARELO</option>
                </select><br>
                <label for="color">Preço:</label><br>
                <select name="compare" id="compare">
                    <option value="largest">MAIOR</option>
                    <option value="smaller">MENOR</option>
                    <option value="equal">IGUAL</option>
                </select>
                <input type="text" id="price" name="price" value="" placeholder="5,599.00"><br><br>
                <input type="submit" value="Filtrar">
            </form>
        </section> <br>
        <section>
            <h2>Lista de Produtos</h2>
            <?= $productDAO->list(); ?>
        </section>
    </main>
    <footer></footer>
</body>
</html>