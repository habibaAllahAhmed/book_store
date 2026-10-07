function showAlert(alert){
    if(alert != null){
    Swal.fire({
        toast: true,
  position: "top-end",
  timerProgressBar : false,
  showConfirmButton: false,
  timer: 3000,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  },
  icon: alert[0],
  title: alert[1],
});
}
}

function imgPath(imgName) {
  return window.location.origin + "/assets/images/" + imgName;
}

function showErrors(errors){
  for(let error in errors){
    $(`p.alert[data-error-name="${error}"]`).text(errors[error]).removeClass("d-none");
  }
}

function openModel(modelId){
  const myModal = new bootstrap.Modal(`#${modelId}`);
    // const modalElement = document.getElementById(modelId);
    // const myModal = bootstrap.Modal.getOrCreateInstance(modalElement);

myModal.show();
document.activeElement?.blur();
}

function bookComponent(book , status){

        let shortDesc = book['description'].slice(0,100);
        let additionalRows = "";

        if(status == 'books'){
additionalRows = `
                <div class='row'>
                    <div class='col-5'>
                        <p>stock :</p>
                    </div>
                    <div class='col-7 text-start'>
                        <p>${book['stock']}</p>
                    </div>
                </div>
                            <div class='input-group'>
            <input type='number' min='1' class='form-control' placeholder='Quantity' id='input-quantity-${book['id']}'>
  <button class='btn btn-outline-success' type='button' onclick='addToCart(${book['id']},this)' id='button-addon1'>Add to cart</button>
</div>
`
        }else if(status =='cart'){
additionalRows = `
                <div class='row'>
                    <div class='col-5'>
                        <p>subtotal :</p>
                    </div>
                    <div class='col-7 text-start'>
                        <p class="subtotal">${book['subtotal']}</p>
                    </div>
                </div>
          <div class="input-group w-50 text-center m-auto mb-3">
                                        <button class="btn btn-outline-danger" style="width:40px;" type="button" onclick="decreaseOrderItem(${book['order_item_id']} , this)" id="button-addon1"><i class="fa-solid fa-minus"></i></button>
                                        <input type="text" class="form-control text-center" placeholder="" aria-label="Example text with button addon" value="${book['quantity']}" disabled aria-describedby="button-addon1">
                                        <button class="btn btn-outline-success" style="width:40px;"  type="button" onclick="increaseOrderItem(${book['order_item_id']} , this)" id="button-addon1"><i class="fa-regular fa-plus"></i></button>
                                    </div>
`
        }else if(status =='showOrder'){
additionalRows = `
                <div class='row'>
                    <div class='col-5'>
                        <p>subtotal :</p>
                    </div>
                    <div class='col-7 text-start'>
                        <p class="subtotal">${book['subtotal']}</p>
                    </div>
                </div>
`
        }

     return `
 <div class='col-lg-6 col-xl-4'>
                      <div class='card position-relative p-3  bg-primary-subtle text-primary-emphasis mb-4 rounded-4 text-center' style='width: 19rem;' data-book-id="${book['order_item_id']}">
                      ${(status == 'cart') ? `<i class="fa-solid fa-trash-can text-danger position-absolute" onclick="deleteOrderItem( ${book['order_item_id']},this)" style="top:15px; right:15px;"></i>` : ""}
                          <img src='${imgPath(book.image == null ? "book.png" : `uploads/${book.image}`)}' style='width: 6rem;' class=' mx-auto card-img-top'>
                          <div class='card-body'>
                              <h5 class='card-title mb-4'>${book['title']}</h5>
                             <div class='row'>
                    <div class='col-5'>
                        <p> Author :</p>
                    </div>
                    <div class='col-7 text-start'>
                        <p>${book['author_name']}</p>
                    </div> 
                    </div> 
                <div class='row'>
                    <div class='col-5'>
                        <p>Description :</p>
                    </div>
                    <div class='col-7 text-start'>
                        <p>${shortDesc}</p>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-5'>
                        <p>Price :</p>
                    </div>
                    <div class='col-7 text-start'>
                        <p>${book['price']}</p>
                    </div>
                </div>
                ${additionalRows}
                          </div>
                      </div>
                  </div>

`;
}

function getItemsIntoCart(orderId = null , status = 'cart'){

    let  FormData = {}
    if(orderId != null){
FormData['orderId'] = orderId;
    }

    $.ajax({
    url:"profile/getItemsIntoCart",
    type : "POST",
    data: FormData,
    success:
function(response){
    console.log(response);
let books= response.data;
if(books.length == 0){
    $("#Cart .modal-body").html(`
                <p class="alert text-center w-75 m-auto alert alert-warning mb-4">Your Cart is empty</p>
                    `);
}else{
$("#Cart .modal-body").html(`
                    <h5 class="text-center mb-4">Total order price : <span class=" fw-bolder" id="cartTotalPrice">${books[0].total_price}</span></h5>
                                        <div class="row"></div>
${(status == 'cart')? `    <button class="btn-success btn w-100" onclick="fireOrder(${books[0]['order_id']})">order now</button>
` : ''}
                    `);
}

                    for(let book of books){
                        $("#Cart .modal-body > .row").append(bookComponent(book,status));
                    }

openModel("Cart");
},

error: 
function(response){

},

});
}