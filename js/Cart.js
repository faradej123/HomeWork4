"use strict"
document.addEventListener("DOMContentLoaded", () => {
    let orderSubmitButton = document.querySelectorAll(".wrapper .product-container .products .order button");
    orderSubmitButton.forEach(button => {
        button.addEventListener("click", confirmOrder);
    });
    
});


function confirmOrder(event)
{
    //let productId = event.target.parentNode.getAttribute("product_id");
    let a = "https://" + document.domain + "/cart/confirmorder/";
    fetch("https://" + document.domain + "/cart/confirmorder/", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json;charset=utf-8'
        },
    }).then(result => {
        return result.json();
    }).then(result => {
        alert(true); //TO DO
    })

}

