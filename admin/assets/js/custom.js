function post(data, url, method) {
    $.ajax({
        url: url,
        type: method,
        data: data,
        success: function (data) {
            var response = $.parseJSON(data);
            if (response.status == 'success') {
                swal({
                    title: response.message,
                    text: '',
                    type: 'success'
                }, function () {
                    window.location = response.redirectUrl;
                });
            } else {
                Swal({ title: 'Error', text: '', type: 'error' })
            }
        }
    })
}

function deleteData(url, data, method) {
    var form_data = new FormData();
    $.each($.parseJSON(data), function (key, value) {
        form_data.append(key, value);
    });
    swal({
        title: "Delete?",
        text: "Are you sure you want to delete?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false,
        confirmButtonColor: "#f60e0e"
    }, function (e) {


        $.ajax({
            url: url,
            type: method,
            processData: false,
            contentType: false,
            data: form_data,
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.status == 'success') {
                    swal({
                        title: response.message,
                        text: '',
                        type: 'success'
                    }, function () {
                        location.reload();
                    });
                } else {
                    Swal({ title: 'Error', text: '', type: 'error' })
                }
            }
        })
    })
    }

function postFiles(formName, url, method) {
    var formdata = new FormData($(formName)[0])
    $.ajax({
        type: method,
        url: url,
        data: formdata,
        contentType: false,
        processData: false,
        success: function (data) {
            var response = $.parseJSON(data);
            if (response.status == 'success') {
                swal({
                    title: response.message,
                    text: '',
                    type: 'success'
                }, function () {
                    window.location = response.redirectUrl;
                });
            } else {
                Swal({title:'Error', text:'', type:'error'})
            }

        }
    })
}
$("#create-product").validate({
    rules: {
        name: {
            required: true,
        },
        quantity: {
            required: true,
        },
        description: {
            required: true,
        },
        category_id: {
            required: true,
        },
        product_images: {
            required: true,
        },
        thumnail_images: {
            required: true,
        },
        discounted_price: {
            required: true,
        },
        original_price: {
            required: true,
        },
    },
    messages: {

    },
    submitHandler: function (form) {
        // alert($(this));
        postFiles(form, "ajax.php", "post");
    }
});


    // !function () { "use strict"; tinyMCE.baseURL = tinyMCE.baseURL+"/assets/plugin/tinymce", tinymce.init({ selector: "#tinymce", height: 500, plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste code"], toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image", content_css: "assets/plugin/tinymce/content.min.css" }), tinymce.init({ selector: "h2.editable", inline: !0, toolbar: "undo redo", menubar: !1 }), tinymce.init({ selector: "div.editable", inline: !0, plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"], toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image" }) }(jQuery);

    // tinymce.init({
    //     selector: 'textarea',  // change this value according to your HTML
    //     plugins: 'advlist autolink link image lists charmap print preview'
    // });