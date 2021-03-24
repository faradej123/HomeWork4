document.addEventListener("DOMContentLoaded", () => {
    $productSubmitButtons = document.querySelectorAll(".wrapper .product-container .product button");
    document.addEventListener("click", addProductToCart);
});


function addProductToCart()
{
    fetch("https://" + document.domain + "/cart/addproduct/1", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json;charset=utf-8'
        },
    }).then(result => {
        return result.text();
    }).then(result => {
        alert(result);
    });
}