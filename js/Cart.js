"use strict"
document.addEventListener("DOMContentLoaded", () => {
    let orderSubmitButton = document.querySelectorAll(".wrapper .product-container .products .order button");
    orderSubmitButton.forEach(button => {
        button.addEventListener("click", confirmOrder);
    });
    include("https://" + document.domain + "/js/showResponse.js");
});


function confirmOrder(event)
{
    fetch("https://" + document.domain + "/cart/confirmorder/", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json;charset=utf-8'
        },
    }).then(result => {
        return result.json();
    }).then(result => {
        let parentContainerNode = event.target.parentNode.parentNode.parentNode;
        let productContainer = document.querySelector(".wrapper .product-container");
        productContainer.innerHTML = "";
        showResponse(parentContainerNode, result);
    })
}

