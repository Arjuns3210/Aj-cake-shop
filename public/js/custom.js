function submitForm(form_id, form_method, errorOverlay = "") {
    var form = $("#" + form_id);
    var formdata = false;
    if (window.FormData) {
        formdata = new FormData(form[0]);
    }

        $.ajax({
            url: form.attr("action"),
            type: form_method,
            dataType: "html",
            data: formdata ? formdata : form.serialize(),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".btn-success").attr("disabled", false);
                var response = JSON.parse(data);
                // console.log(response);
                if (response["success"] == 0) {
                        Swal.fire({
                          width:400,
                          position: 'top-end',
                          icon: 'error',
                          title: '<h6 style="color:red;">'+response["message"]+'</h6>',
                          showConfirmButton: false,
                          // timer: 2000
                        });
                    
                } else {
                        Swal.fire({
                          width:400,
                          position: 'top-end',
                          icon: 'success',
                          title: '<h4 style="color:green;">'+response["message"]+'</h4>',
                          showConfirmButton: false,
                        });

                        if(form_id=='saveUser'){
                            setTimeout(function () {

                            window.location.href = "/cake-shop";
                            }, 3000);
                        }else{
                            setTimeout(function () {

                                location.reload();
                            }, 2000);
                        }
                }
            },
            error: function (data) {
                var errorMsg = "Something is wrong, please try again later.";
                $(".btn-success").attr("disabled", false);
                //removeLoading();
                Swal.fire({
                  width:400,
                  position: 'top-end',
                  icon: 'error',
                  title: 'error',
                  showConfirmButton: false,
                  timer: 2000
                });
            },
        });
    // }
}

$(document).on("keyup", ".required", function (event) {
        $(this).removeClass("border-danger");
    });

$(document).on("change",".required",function(event){
    $(this).removeClass("border-danger");
});