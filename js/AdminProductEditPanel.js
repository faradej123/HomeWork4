"use strict"
document.addEventListener("DOMContentLoaded", () => {
    include("https://" + document.domain + "/js/showResponse.js");
    let orderDeleteButton = document.querySelectorAll(".wrapper .product-container .products button");
    orderDeleteButton.forEach(button => {
        button.addEventListener("click", deleteProduct);
    });
    let newProductButton = document.querySelector("#create-product-form button");
    newProductButton.addEventListener("click", createProduct);
});


function deleteProduct(event)
{
    let productId = event.target.parentNode.getAttribute("product_id");
    fetch("https://" + document.domain + "/admin/deleteproduct/" + productId, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json;charset=utf-8'
        },
    }).then(result => {
        return result.json();
    }).then(result => {
        let parentContainerNode = event.target.parentNode.parentNode.parentNode;
        showResponse(parentContainerNode, result);
        if (result.messages["deleted_ok"]) {
            let deletingBlock = event.target.parentNode;
            deletingBlock.parentNode.removeChild(deletingBlock);
        }
    })
}

function createProduct(event)
{
    let productName = event.target.parentNode.querySelector("input[name='product-name']").value;
    let productCost = event.target.parentNode.querySelector("input[name='product-cost']").value;
    let productCount = event.target.parentNode.querySelector("input[name='product-count']").value;
    let data = {
        productName, productCost, productCount
    };
    fetch("https://" + document.domain + "/admin/createproduct/", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
    }).then(result => {
        return result.json();
    }).then(result => {
        /*let parentContainerNode = event.target.parentNode.parentNode.parentNode;
        showResponse(parentContainerNode, result);
        if (result.messages["deleted_ok"]) {
            let deletingBlock = event.target.parentNode;
            deletingBlock.parentNode.removeChild(deletingBlock);
        }*/
    })
}

