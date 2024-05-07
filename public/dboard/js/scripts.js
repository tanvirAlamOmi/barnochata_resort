/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

/**
 * Redirects the page
 */
window.redirectPage = function (redirect_url) {
    if (redirect_url) {
      if (redirect_url.indexOf('#') == 0) {
        window.location.hash = redirect_url;
        window.location.reload();
      } else {
        window.location.replace(redirect_url);
      }
    } else {
      window.location.reload();
    }
  };

  //delete
  $(document).on('click', '.change-confirmation', function(e) {
    e.preventDefault();
    var request_url = $(this).data('request-url');
    var redirect_url = $(this).data('redirect-url');
    var _id = $(this).data('id');
    var title = $(this).data('title');
    var description = $(this).data('description');
    var _this = this;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
      title: 'Are you sure?',
      text: description,
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: `Yes, ${title} it!`
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: request_url,
          type: 'POST',
          data: {
            "_token": csrfToken,
            "id":_id ,
            },
          success: function success(result) {
            Swal.fire(`${title}d`, `The record has been ${title}d.`, 'success').then(function () {
              redirectPage(redirect_url);
            });
          },
          error: function error(e) {
            Swal.fire('Error!', `An error occurred while performing action.`, 'error');
          }
        });
      }
    });
  });


// instant image read and display
function readImageURL(input, preview){
    if (input.files && input.files[0])
    {
        if(input.files[0].size <= 5600000)
        {
            var imgDiv = document.getElementById(preview);
            imgDiv.classList.remove("hide");
            var alertDiv = document.getElementById(preview+"Alert");
            alertDiv.classList.add("hide");
            var reader = new FileReader();
            reader.onload = function (e)
            {
                $('#'+preview)
                .attr('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
        }else{
            var imgDiv = document.getElementById(preview);
            imgDiv.classList.add("hide");
            var alertDiv = document.getElementById(preview+"Alert");
            alertDiv.classList.remove("hide");

        }
    }
}

// validate email
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

$('.quantity_class').attr('onkeyup',"this.value=this.value.replace(/[^0-9:]/g,'');");
$('.quantity__class').attr('onkeyup',"this.value=this.value.replace(/[^0-9\.:]/g,'');");
