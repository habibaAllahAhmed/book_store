function addToCart(bookId , that){
    let quantityInput = $(that).prev(),
    quantity = Number(quantityInput.val());

    if(quantity == 0){
        return;
    }

    let dataForm = {
        bookId : bookId,
        quantity : quantity,
    }

    $.ajax({
    url:"profile/addToCart",
    type : "POST",
    data: dataForm,
    success:
function(response){
    console.log(response);
quantityInput.val("");

let totalItems = response.data.totalItems;

$("#myTabContent #TotalItems").text(totalItems);
},

error: function(response){
    console.log(response.status);
    console.log(response.responseText);
},

});

}

function increaseOrderItem(orderItemId, btn){

    let cartEle = $(btn).parents(".card"),
    buttons = cartEle.find("button");

    buttons.prop('disabled', true);

let dataForm = {
    orderItemId :orderItemId
};

    $.ajax({
    url:"profile/increaseOrderItem",
    type : "POST",
    data : dataForm,
    success:
function(response){
    console.log(response);
    let bookId = response.data.orderItem.id;

    $(`#Cart .card[data-book-id="${bookId}"] .subtotal`).text(response.data.orderItem.subtotal);
    $(`#Cart .card[data-book-id="${bookId}"] input`).val(response.data.orderItem.quantity);
    $(`#Cart #cartTotalPrice`).text(response.data.totalPrice);
        $("#TotalItems").text(response.data.totalItemsIntoOrder); 


        buttons.prop('disabled', false);
},

error: 
function(response){

},

});
}

function decreaseOrderItem(orderItemId ,btn){

    let cartEle = $(btn).parents(".card"),
    buttons = cartEle.find("button");

    buttons.prop('disabled', true);

let dataForm = {
    orderItemId :orderItemId
};

    $.ajax({
    url:"profile/decreaseOrderItem",
    type : "POST",
    data : dataForm,
    success:
function(response){
    console.log(response);
    let bookId = response.data.orderItem.id;

if(response.data.orderItem.quantity == 0){
    $(`#Cart .card[data-book-id="${bookId}"]`).parent().remove();

    if($(`#Cart .card`).length ==0){
        
$("#Cart .modal-body").html(`
                    <p class="text-center w-75 m-auto alert alert-warning mb-4">Your Cart is empty</p>
                            `);
    }
}else{
        $(`#Cart .card[data-book-id="${bookId}"] .subtotal`).text(response.data.orderItem.subtotal);
        $(`#Cart .card[data-book-id="${bookId}"] input`).val(response.data.orderItem.quantity);   
    }
    
    $("#TotalItems").text(response.data.totalItemsIntoOrder); 
    $(`#Cart #cartTotalPrice`).text(response.data.totalPrice);

    buttons.prop('disabled', false);
},

error: 
function(response){

},

});
}

function deleteOrderItem(orderItemId ,btn){

    let cartEle = $(btn).parents(".card"),
    buttons = cartEle.find("button");

    buttons.prop('disabled', true);

let dataForm = {
    orderItemId :orderItemId
};

    $.ajax({
    url:"profile/deleteOrderItem",
    type : "POST",
    data : dataForm,
    success:
function(response){
    console.log(response);
    cartEle.parent().remove();

    if($(`#Cart .card`).length ==0){
        
$("#Cart .modal-body").html(`
                    <p class="text-center w-75 m-auto alert alert-warning mb-4">Your Cart is empty</p>
                            `);
    }else{
    $(`#Cart #cartTotalPrice`).text(response.data.totalPrice);
}

$("#TotalItems").text(response.data.totalItemsIntoOrder);
    buttons.prop('disabled', false);
},

error: 
function(response){

},

});
}

function fireOrder(orderId){
let dataForm = {
    orderId :orderId
};

    $.ajax({
    url:"profile/fireOrder",
    type : "POST",
    data : dataForm,
    success:
function(response){
    console.log(response);
    let order = response.data,

    $("#Cart .btn-close").get(0).click();

    $(`#TotalItems`).text(0);
    
            Swal.fire({
            title:"ordered!",
            text: "your order has been ordered",
            icon: "success",
            });

    let Alert = document.querySelector("#Ordered-tab-pane .alert");

if (Alert) {
    Alert.remove();

    $("#Ordered-tab-pane .table tbody").append(`
        <tr>
            <th>${order[0]['order_id']}</th>
            <td>${order[0]['name']}</td>
            <td>${order[0]['total_price']}</td>
            <td>
                <a href='#' onclick="getItemsIntoCart(${order[0]['order_id']}, 'showOrder')">
                    show
                </a>
            </td>
            <td>${order[0]['created_at']}</td>
        </tr>
    `);

    $("#Ordered-tab-pane").append(`
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link disabled" href="#">Previous</a>
                </li>

                <li class="page-item">
                    <a class="page-link active" href="#">1</a>
                </li>

                <li class="page-item">
                    <a class="page-link disabled" href="#">Next</a>
                </li>
            </ul>
        </nav>
    `);
} else {
    $("#Ordered-tab-pane .table tbody").append(`
        <tr>
            <th>${order[0]['order_id']}</th>
            <td>${order[0]['name']}</td>
            <td>${order[0]['total_price']}</td>
            <td>
                <a href='#' onclick="getItemsIntoCart(${order[0]['order_id']}, 'showOrder')">
                    show
                </a>
            </td>
            <td>${order[0]['created_at']}</td>
        </tr>
    `);
}
},

error: 
function(response){

},

});

}
