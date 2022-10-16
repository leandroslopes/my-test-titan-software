<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/proj_aval_php/src/connection/ConnectionMySQL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/proj_aval_php/src/model/Product.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/proj_aval_php/src/util/TableUtil.php';

class ProductDAO
{
    /**
     *
     * @var ConnectionMySql 
     */
    private $connection;

    /**
     * Add product.
     * @param Product $product
     * @return boolean
     */
    public function add($product)
    {
        $this->connection = new ConnectionMySql();
        $id = $product->getId();
        $name = $product->getName();
        $color = $product->getColor();
        $price = $product->getPrice();

        if (empty($id)) {
            $statement = $this->connection->open()->prepare("INSERT INTO products (name, color, price) VALUES (?, ?, ?)");
            $statement->bind_param("ssd", $name, $color, $price);
            $add = $statement->execute();
        } else {
            $statement = $this->connection->
                open()->
                prepare("UPDATE products 
                        SET name = ?, color = ?, price = ? 
                        WHERE id = ?");
            $statement->bind_param("ssdi", $name, $color, $price, $id);
            $update = $statement->execute();
        }

        $statement->close();
        $this->connection->close();

        if ($add || $update) {
            return true;
        }
        return false;
    }

    /**
     * Delete product.
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        $this->connection = new ConnectionMySql();

        $statement = $this->connection->open()->prepare("DELETE FROM products WHERE id = ?");
        $statement->bind_param("i", $id);
        $delete = $statement->execute();

        $statement->close();
        $this->connection->close();

        if ($delete) {
            return true;
        }
        return false;
    }

    /**
     * List products.
     * @return string
     */
    public function list()
    {
        $this->connection = new ConnectionMySql();
        $htmlTop = "";
        $html = "";
        $htmlVoid = "";
        $htmlBottom = "";

        $statement = $this->connection->open()->prepare("SELECT a.id, a.name, a.color, a.price FROM products AS a ORDER BY a.name");
        $statement->execute();
        $result = $statement->get_result();
        $countRows = $result->num_rows;

        $arrayHeaderTable = array("NOME", "COLOR", "PREÇO");
        $htmlTop .= TableUtil::criarTopo($arrayHeaderTable);
        $html .= "<tbody>";

        while ($product = $result->fetch_assoc()) {
            $html .= "<tr>";

            $html .= "<td>" . $product["name"] . "</td>";
            $html .= "<td>" . $product["color"] . "</td>";
            $html .= "<td>" . $product["price"] . "</td>";

            $html .= "<td>";
            $html .= "<input type='hidden' name='id_product' id='id_product' value='" . $product["id"] . "'/>";
            $html .= "<img src='public/img/delete.png' width='16' title='Excluir' alt='Excluir' class='delete cursor' />";
            $html .= "</td>";

            $html .= "</tr>";
        }

        //$htmlBottom .= TableUtil::criarRodape(5);
        $htmlVoid .= TableUtil::criarConteudoVazio(5);

        if ($countRows > 0) {
            return $htmlTop . $html . $htmlBottom;
        }
        return $htmlTop . $htmlVoid;
    }
}
