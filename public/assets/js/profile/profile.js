
$(document).ready(function () {
    let type = window.location.search.replace('?' , '').split('-')[0];
    $(`#${type}-tab`).get(0)?.click();
});

$("#AddAuthorForm").submit(function(e){
  e.preventDefault();
  let dataForm = new FormData(this);

$.ajax({
  url:"profile/addAuthor",
  type : "POST",
  data: dataForm,
        contentType : false,
        processData: false,
  success:
function(response){
    
  let author = response.data;

    $("#AddAuthorForm").get(0).reset();
    $(`#AddAuthorForm p.alert`).addClass("d-none");
    $("#addAuthor .btn-close").get(0).click();

    $("#Authors-tab-pane > .row").prepend(`
       <div class='col-lg-6 col-xl-4'>
                      <div class='authors p-3  bg-primary-subtle text-primary-emphasis mb-4 card rounded-4 text-center' style='width: 19rem;'>
                          <img src='${imgPath('author.png')}' style='width: 6rem;' class=' mx-auto card-img-top'>
                          <div class='card-body'>
                              <h5 class='card-title mb-4'>${author.name}</h5>
                              <div class='row'>
                                  <div class='col-4'>
                                      <p> Bio :</p>
                                  </div>
                                  <div class='col-8 text-start'>
                                      <p>${author.bio.slice(0,100)}...</p>
                                  </div>
                              </div>
                              <button class='btn btn-success'
    onclick='openAddBookPopup(${author.id}, "${author.name}")'
    data-bs-toggle='modal'
    data-bs-target='#addBook'>
    Add Book
</button>
                          </div>
                      </div>
                  </div>
      `);
},

error: 
function(response){
      if(response.status == 422){
          let errors = response.responseJSON.data;
        showErrors(errors);
      }
},

});

});

$("#BooksFilter").submit(function(e){
  e.preventDefault();

  let dataForm = new FormData(this);

$.ajax({
  url:"profile/filterBooks",
  type : "POST",
  data: dataForm,
  success:
function(response){
console.log(response);
  let books = response.data.data;

   $("#Books-tab-pane .item2 > .row").html("");

   if(books.length != 0){

        $("#Books-tab-pane nav").remove();

     for(let i = 0 ; i < books.length ; i++){

      $("#Books-tab-pane .item2 > .row").append(bookComponent(books[i] , 'books'));
      
    }

        $("#Books-tab-pane").append(preparePagination(response.data));

     
  }else{
    $("#Books-tab-pane .item2 > .row").append(`<p class='m-auto text-center alert alert-danger'>there are no books </p>`);
}
},

error: 
function(response){
    
},

});

});

function preparePagination(data)
{

   let books = data.data;

    if (books.length != 0) {

        let prepareLI = "",
        pagesNumber = Math.ceil( data.total / 10),  
        prevPageNumber = (data.currentPage > 1) ? data.currentPage -1 : data.currentPage,
        nextPageNumber = (data.currentPage < pagesNumber) ? data.currentPage + 1 : data.currentPage,
        isNextPageDisabled = (data.currentPage < pagesNumber) ? '' : 'disabled',
        isPrevPageDisabled = (data.currentPage > 1) ? '' : 'disabled';


        for (let i = 1; i <= pagesNumber; i++) {
            let isActive = (data.currentPage == i) ? 'active' : '';
            prepareLI += `
    <li class='page-item'><a class='page-link ${isActive}' onclick="changePage(${i})" data-page=${i}>${i}</a></li>
`;
        }

       return `
    <nav aria-label='Page navigation example'>
    <ul class='pagination'>
    <li class='page-item'><a class='page-link ${isPrevPageDisabled}' onclick="changePage(${prevPageNumber})" data-page='${prevPageNumber}' >Previous</a></li>
${prepareLI}
    <li class='page-item'><a class='page-link ${isNextPageDisabled}' onclick="changePage(${nextPageNumber})" data-page='${nextPageNumber}' >Next</a></li>
    </ul>
</nav>
`
    }else{
        return "";
    }
}

function changePage(page){

  $("#BooksFilter #ChangePage").val(page);
  $("#BooksFilter").trigger('submit');
}

function openAddBookPopup(authorId  ,authorName){
$("#AuthorId option").val(authorId).text(authorName);
$("#AuthorIdOfBook").val(authorId);
openModel("addBook");

}

$("#AddBookForm").submit(function(e){
    e.preventDefault();

    let dataForm = new FormData(this);

    $.ajax({
        url : "profile/addBook",
        type : "POST",
        data: dataForm,
        contentType : false,
        processData: false,
        success: function(response){
            let book = response.data;

    $("#AddBookForm").get(0).reset();
    $(`#AddBookForm p.alert`).addClass("d-none");
  $("#addBook .btn-close").get(0).click();

          let shortDesc = book['description'].slice(0,100);

          $("#Books-tab-pane > .row").prepend(`
 <div class='col-lg-6 col-xl-4'>
                        <div class='books p-3  bg-primary-subtle text-primary-emphasis mb-4 card rounded-4 text-center' style='width: 19rem;'>
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
                <div class='row'>
                    <div class='col-5'>
                        <p>stock :</p>
                    </div>
                    <div class='col-7 text-start'>
                        <p>${book['stock']}</p>
                    </div>
                </div>
                          </div>
                      </div>
                  </div>

`
 );
        },
        error: function(response){
            if(response.status == 422){
                let errors = response.responseJSON.data;
                showErrors(errors);
            }
        }
    });
});

function banUser(userId , text){
      Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: `Yes, ${text} it!`,
  }).then((result) => {
  if(result.isConfirmed){
let dataForm = {
    'userId' : userId
};

    $.ajax({
        url : "profile/banUser",
        type : "POST",
        data: dataForm,
        success: function(response){
            console.log(response);
            let user = response.data,
            isAdminBanned = (user.is_banned ) ?
                "<span class='badge text-bg-danger position-absolute' style='top:10px; right : 10px'>banned</span>" : '',
            isButtonBanned = (user['is_banned']) ? `<button class='btn btn-danger w-100' onclick="banUser(${user['id']}, 'unban')">unBan</button>` :
                `<button class='btn btn-success w-100' onclick="banUser(${user['id']}, 'ban')">Ban</button>`;

            $(`.card[data-user-id='${user.id}']`).html(`
                ${isAdminBanned}
                <img src='${imgPath(`${user.role}.png`)}' style='width: 6rem;' class=' mx-auto card-img-top'>
                <div class='card-body'>
                              <h5 class='card-title mb-4'>${user['name']}</h5>
                              <div class='row'>
                                  <div class='col-4'>
                                      <p> Email :</p>
                                  </div>
                                  <div class='col-8 text-start'>
                                      <p>${user['email']}</p>
                                  </div>
                              </div>
                              <div class='row'>
                                  <div class='col-4'>
                                      <p>Gender :</p>
                                  </div>
                                  <div class='col-8 text-start'>
                                      <p>${user['gender']}</p>
                                  </div>
                              </div>
                              <div class='row'>
                                  <div class='col-4'>
                                      <p>Phone :</p>
                                  </div>
                                  <div class='col-8 text-start'>
                                      <p>${user['phone']}</p>
                                  </div>
                              </div>
                              ${isButtonBanned}
                          </div>
                      
                `);

            Swal.fire({
            title: `${(user.is_banned)? "banned" : "unbanned"}`,
            text: "your user has been  updated",
            icon: "success",
            });



        },
error: function(response) {

    if (response.status == 422) {

        let message = response.responseJSON.message;

        showAlert(['error', message]);
    }
}
    });

    }
});

}