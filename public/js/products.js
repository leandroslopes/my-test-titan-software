$(function () {
  //$.noConflict();

  /**
   * Add a new product
   */
  $("#frm_add_product").submit(function (event) {
    $name = $("#name_add").val();
    $price = $("#price_add").val();
    $color = $("#color_add").val();

    if ($name !== "" && $price !== "") {
      $.ajax({
        url: "add_product.php",
        type: "post",
        data: $("#frm_add_product").serialize(),
        success: function (response) {
          add = response.trim();
          console.log(add);

          if (add === "TRUE") {
            location.reload();
            alert("Produto Adicionado!");
          } else {
            location.reload();
            alert("Produto Não Adicionado! Tente novamente.");
          }
        },
        error: function () {
          mensagem(2, url, "");
        },
      });
    } else {
      alert("Informe os campos obrigatórios!");
    }

    event.preventDefault();
  });

  $(document).on("click", ".delete", function () {
    var product, product_id;

    product = $(this).parent().parent()[0];
    product_id = product.cells[3].getElementsByTagName("input")[0].value;

    $.ajax({
      url: "delete_product.php",
      type: "post",
      data: "id=" + product_id,
      success: function (response) {
        var product_delete;

        product_delete = response.trim();

        if (product_delete === "TRUE") {
            location.reload();
            alert("Produto Excluído!");
          } else {
            location.reload();
            alert("Produto Não Excluído! Tente novamente.");
          }
      },
    });
  });
});