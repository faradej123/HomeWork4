"use strict"
document.addEventListener("DOMContentLoaded", () => {
    let productSubmitButtons = document.querySelectorAll(".wrapper .product-container .product button");
    productSubmitButtons.forEach(button => {
        button.addEventListener("click", addProductToCart);
    });
    
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
        if (result) {
            let parentContainerNode = event.target.parentNode.parentNode.parentNode;
            let messageBlock = parentContainerNode.querySelector("#messages");
            if(messageBlock) {
                parentContainerNode.removeChild(messageBlock);
            }
            let infoBlock = document.createElement("div");
            infoBlock.id = "messages";
            if (result["errors"].length != 0) {
                let errors = document.createElement("div");
                errors.classList.add("errors");
                for(let error of Object.keys(result.errors)) {
                    let errorBlock = document.createElement("div");
                    errorBlock.innerHTML = result.errors[error];
                    errors.append(errorBlock);
                }
                infoBlock.append(errors);
            }
            if (result["messages"].length != 0) {
                let messagesNode = document.createElement("div");
                messagesNode.classList.add("successfuly");
                for(let mess of Object.keys(result.messages)) {
                    if(mess == "new_product_qty") {
                        updateQtyInProduct(result.messages[mess]);
                        continue;
                    }
                    let oneMessageBlock = document.createElement("div");
                    oneMessageBlock.innerHTML = result.messages[mess];
                    messagesNode.append(oneMessageBlock);
                }
                infoBlock.append(messagesNode);
            }
            parentContainerNode.prepend(infoBlock);
        }
    });

    function updateQtyInProduct(qty)
    {
        let qtyElem = event.target.parentNode.querySelector(".count span")
        qtyElem.innerHTML = qty;
    }
}

