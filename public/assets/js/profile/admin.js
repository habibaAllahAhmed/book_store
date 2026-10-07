function doneOrder(orderId ,btn){
let dataForm = {
    orderId :orderId
};

    $.ajax({
    url:"profile/doneOrder",
    type : "POST",
    data : dataForm,
    success:
function(response){
    console.log(response);
    let order = response.data,
    trEle = $(btn).parents(".tr");
            Swal.fire({
            title:"Done!",
            text: "order has been Updated",
            icon: "success",
            });
            
            trEle.remove();

            

        $("#Done-tab-pane .table tbody").append(`
                        <tr>
                <th>${order[0]['order_id']}</th>
                <td>${order[0]['name']}</td>
                <td>${order[0]['total_price']}</td>
                <td><a href='#' onclick="getItemsIntoCart(${order[0]['order_id']} , 'showOrder')">show</a></td>
                <td>${order[0]['created_at']}</td>
            </tr>
            `);
            
},

error: 
function(response){

},

});

}

function cancelOrder(orderId ,btn){
let dataForm = {
    orderId :orderId
};

    $.ajax({
    url:"profile/cancelOrder",
    type : "POST",
    data : dataForm,
    success:
function(response){
    console.log(response);
    let order = response.data,
    trEle = $(btn).parents(".tr");
            Swal.fire({
            title:"canceled!",
            text: "order has been Updated",
            icon: "success",
            });
            
            trEle.remove();

        $("#Cancelled-tab-pane .table tbody").append(`
                        <tr>
                <th>${order[0]['order_id']}</th>
                <td>${order[0]['name']}</td>
                <td>${order[0]['total_price']}</td>
                <td><a href='#'  onclick="cancelOrder(${order['order_id']} , 'showOrder')">show</a></td>
                <td>${order[0]['created_at']}</td>
            </tr>
            `);
            
},

error: 
function(response){

},

});

}
