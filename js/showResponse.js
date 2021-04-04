function showResponse(parentContainerNode, response)
{
    if(!parentContainerNode) {
        return false;
    } 
    let messageBlock = parentContainerNode.querySelector("#messages");
    if(messageBlock) {
        parentContainerNode.removeChild(messageBlock);
    }
    let infoBlock = document.createElement("div");
    infoBlock.id = "messages";
    if (response["errors"].length != 0) {
        let errors = document.createElement("div");
        errors.classList.add("errors");
        for(let error of Object.keys(response.errors)) {
            let errorBlock = document.createElement("div");
            errorBlock.innerHTML = response.errors[error];
            errors.append(errorBlock);
        }
        infoBlock.append(errors);
    }
    if (response["messages"].length != 0) {
        let messagesNode = document.createElement("div");
        messagesNode.classList.add("successfuly");
        for(let mess of Object.keys(response.messages)) {
            if(mess == "new_product_qty") {
                continue;
            }
            let oneMessageBlock = document.createElement("div");
            oneMessageBlock.innerHTML = response.messages[mess];
            messagesNode.append(oneMessageBlock);
        }
        infoBlock.append(messagesNode);
    }
    parentContainerNode.prepend(infoBlock);
}