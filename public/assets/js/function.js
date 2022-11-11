$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "Api-Token": $('meta[name="api-token"]').attr("content"),
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("form[request-ajax=lbd]").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr("action");
        var method = form.attr("method");
        var href = form.attr("href");
        var data = form.serialize();
        let button = form.find("button[type=submit]");
        var token = $('meta[name="csrf-token"]').attr("content");
        data += "&_token=" + token;
        if (button.attr("show")) {
            Swal.fire({
                title: "Bạn chắc chắn?",
                text: button.attr("show"),
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Đồng ý",
            }).then((result) => {
                if (result.isConfirmed) {
                    formSubmit(url, method, href, data, button);
                }
            });
        } else {
            formSubmit(url, method, href, data, button);
        }
    });
});

function formSubmit(url, method, href, data, button) {
    var txtBtn = button.html().trim();

    let settings = {
        url,
        method,
        data,
        dataType: "json",
        beforeSend: function () {
            button
                .prop("disabled", true)
                .html(`<i class="fa fa-spinner fa-spin"></i> Đang xử lý...`);
        },
        complete: function () {
            button.prop("disabled", false).html(txtBtn);
        },
        success: function (response) {
            if (button.attr("callback")) {
                window[`${button.attr("callback")}`](response);
            }
            if (!button.attr("callback")) {
                //Swal(response.message, response.status === true ? "success" : "error");
                Swal.fire(
                    "Thông báo",
                    response.message,
                    response.status === true ? "success" : "error"
                );
            }
            if (
                response.status === true &&
                !button.attr("href") &&
                !button.attr("callback")
            ) {
                setTimeout(() => {
                    if (!href) {
                        location.reload();
                        return;
                    }
                    location.href = href;
                }, 2000);
            }
        },
        error: function (error) {
            console.log(error);
        },
    };
    $.ajax(settings);
}

function remove(url, type, id) {
    Swal.fire({
        title: "Bạn chắc chắn?",
        text: "Bạn sẽ không thể khôi phục lại dữ liệu này!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Đồng ý",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    type: type,
                    id: id,
                    '_token': $('meta[name="csrf-token"]').attr("content"),
                },
                dataType: "json",
                success: function (response) {
                    if (response.status == true) {
                        Swal.fire("Thông báo", response.message, "success");
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        Swal.fire("Thông báo", response.message, "error");
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    });
}

function callback(url, type, id) {
    $.ajax({
        url: url,
        type: "POST",
        data: {
            type: type,
            id: id,
            '_token': $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "json",
        success: function (response) {
            if (response.status == true) {
                Swal.fire("Thông báo", response.message, "success");
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                Swal.fire("Thông báo", response.message, "error");
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function level_user(data, show = null) {
    if (data == 1) {
        /*  return '<span class="badge badge-success">Thành viên</span>'; */
        $('#level_user').html('<span class="badge badge-success">Thành viên</span>');
    }
    if (data == 2) {
        /* return '<span class="badge badge-warning">Cộng tác viên</span>'; */
        $('#level_user').html('<span class="badge badge-warning">Cộng tác viên</span>');
    }
    if (data == 3) {
        /* return '<span class="badge badge-danger">Đại lý</span>'; */
        $('#level_user').html('<span class="badge badge-danger">Đại lý</span>');
    } else {
        /* return '<span class="badge badge-info">Admin</span>'; */
        $('#level_user').html('<span class="badge badge-info">Admin</span>');
    }

}


/* function coppy(element) {
    window.getSelection().removeAllRanges();
    let range = document.createRange();
    range.selectNode(typeof element === "string" ? document.getElementById(element) : element);
    window.getSelection().addRange(range);
    document.execCommand("copy");
    window.getSelection().removeAllRanges();
    swal("Sao chép thành công", "success");
} */

function coppy(element) {
  window.getSelection().removeAllRanges();
  let range = document.createRange();
  range.selectNode(typeof element === "string" ? document.getElementById(element) : element);
  window.getSelection().addRange(range);
  document.execCommand("copy");
  window.getSelection().removeAllRanges();
  Swal.fire('Thông báo', 'Sao chép thành công', 'success');
}
