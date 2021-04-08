function addProduct(parentContainerNode, data)
{
    let productElem = document.createElement("div");
    productElem.setAttribute("product_id", data.product_id);
    productElem.classList.add("product");
    let titleElem = document.createElement("div");
    titleElem.classList.add("title")
    let titleSpan = document.createElement("span");
    titleSpan.innerHTML = data.product_name;
    titleElem.append(titleSpan);
    productElem.append(titleElem);

    let costElem = document.createElement("div");
    costElem.innerHTML = "Цена: ";
    let costSpan = document.createElement("span");
    costSpan.innerHTML = data.product_cost;
    costElem.append(costSpan);
    productElem.append(costElem);

    let countElem = document.createElement("div");
    countElem.innerHTML = "Количество: ";
    let countSpan = document.createElement("span");
    countSpan.innerHTML = data.product_count;
    countElem.append(countSpan);
    productElem.append(countElem);

    let button = document.createElement("button");
    button.innerHTML = "Удалить";
    productElem.append(button);

    parentContainerNode.append(productElem);

    return productElem;
}