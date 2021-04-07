"use strict"
document.addEventListener("DOMContentLoaded", () => {
    let productSubmitButtons = document.querySelectorAll(".wrapper .product-container .product button");
    productSubmitButtons.forEach(button => {
        button.addEventListener("click", addProductToCart);
    });
    include("https://" + document.domain + "/js/showResponse.js");
});


function addProductToCart(event)
{
    let productId = event.target.parentNode.getAttribute("product_id");
    fetch("https://" + document.domain + "/cart/addproduct/" + productId, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json;charset=utf-8'
        },
    }).then(result => {
        return result.json();
    }).then(result => {
            let parentContainerNode = event.target.parentNode.parentNode.parentNode;
            showResponse(parentContainerNode, result);
            if(result["messages"]["new_product_qty"]) {
                let qtyElem = event.target.parentNode.querySelector(".count span")
                qtyElem.innerHTML = result["messages"]["new_product_qty"];
            }
    });
}

