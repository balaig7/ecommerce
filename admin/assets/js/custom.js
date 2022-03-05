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
                Swal({
                    title: 'Error',
                    text: '',
                    type: 'error'
                })
            }
        }
    })
}

function deleteData(url, data, method) {
    var form_data = new FormData();
    console.log(form_data)
    $.each($.parseJSON(data), function (key, value) {
        form_data.append(key, value);
    });
    swal({
        title: "Delete?",
        text: "Are you sure you want to delete?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false,
        confirmButtonColor: "#f60e0e"
    }, function (isConfirm) {
        if (isConfirm) {
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
                        Swal({
                            title: 'Error',
                            text: '',
                            type: 'error'
                        })
                    }
                }
            })
        }else {
            swal("Cancelled", "", "error");
        }
    })

}

function postFiles(formName, url, method,ckeditorData) {

    var formdata = new FormData($(formName)[0])
    formdata.append('description', ckeditorData);


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
                Swal({
                    title: 'Error',
                    text: '',
                    type: 'error'
                })
            }

        }
    })
}


