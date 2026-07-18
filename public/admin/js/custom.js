// --------------------------- general functions -------------
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

var lang = $('html').attr('lang');

function displayValidation(errors) {
    $.each(errors, function (key, error) {
        var input,
            parentDiv,
            validation = `<span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>` + error[0] + `</strong>
                                    </span>`;

        if (key === 'type') {
            input = $("select[name='" + key + "']");
            input = input.parent('div');
            parentDiv = input.parent('.form-group');
        } else if (key === 'role_ids') {
            input = $("select[id='" + key + "']");
            input = input.parent('div');
            parentDiv = input.parent('.form-group');
        } else if (key === 'permission_ids') {
            input = $("input[name='" + key + "']");
            var container = input.parent('div').parent('div').parent('.row').parent('form');
            parentDiv = container.find('#permissions-validation');

        } else {
            input = $("input[name='" + key + "']");
            parentDiv = input.parent('.form-group');
        }

        parentDiv.addClass('has-danger');
        input.addClass('is-invalid');
        parentDiv.append(validation);
    })
}

function removeValidation() {
    $('div input[name]').each(function () {
        var inputName = $(this).attr('name'),
            input = $("input[name='" + inputName + "']"),
            parentDiv = input.parent('.form-group');

        // remove old validation before submit
        parentDiv.removeClass('focused');
        parentDiv.removeClass('has-danger');
        input.removeClass('is-invalid');
        parentDiv.find('.invalid-feedback').remove();
    });

    $('div select[name]').each(function () {
        var inputName = $(this).attr('name'),
            input = $("select[name='" + inputName + "']").parent('div'),
            parentDiv = input.parent('.form-group');
        // remove old validation before submit
        parentDiv.removeClass('focused');
        parentDiv.removeClass('has-danger');
        input.removeClass('is-invalid');
        parentDiv.find('.invalid-feedback').remove();
    });
}

function swalSuccess(data) {
    swal({
        title: lang == 'ar' ? 'جيد !' : 'Good !',
        text: data.message,
        icon: 'success',
        timer: 1500,
        buttons: false,
        showConfirmButton: false
    })
}

function swalError(data) {
    if (data) {
        data = data.message;
    }

    data = data || (lang == 'ar' ? 'حدث خطأ ما' : 'Something went wrong');
    swal({
        title: lang == 'ar' ? 'خطا' : 'Sorry',
        text: data,
        icon: 'error',
        timer: 6000,
        buttons: false,
        showConfirmButton: false
    })
}

//---------------------------- delete item ---------------------

$(document).on('click', '.delete-item', function (event) {
    event.preventDefault();
    var item = $(this),
        route = item.attr('route'),
        renderURL = item.attr('renderURL'),
        renderType = item.attr('renderType') || 'datatable',
        token = $('meta[name="csrf-token"]').attr('content'),
        dataTable = $(".dataTable");
    if (route) {
        swal({
            title: lang == 'ar' ? 'هل انت متاكد ؟' : 'Are you sure?',
            text: lang == 'ar' ? "بمجرد الحذف لن تستطيع استعاده البيانات" : 'Once deleted, you will not be able to recover this data !',
            icon: 'warning',
            buttons: [(lang == "ar" ? "! إلغاء" : "Cancel"), (lang == "ar" ? "!استمر ، حذف" : "Continue & Delete !")],
            showCancelButton: true,
            dangerMode: true,
            allowOutsideClick: false,
            showLoaderOnConfirm: true,
        })
            .then((willDelete) => {
                if (willDelete.dismiss != 'cancel') {
                    $.ajax({
                        url: route,
                        type: 'POST',
                        data: {
                            '_method': 'DELETE',
                            '_token': token,
                        },
                        success: function (data) {
                            if (data.status) {
                                swalSuccess(data);
                                if (renderType === 'datatable') {
                                    // console.log(1);
                                    if (renderURL) {
                                        // console.log(2)
                                        //console.log('ajax relod');
                                        $.ajax({
                                            url: renderURL,
                                            type: 'GET',
                                            data: {'_method': 'GET'},
                                            dataType: 'json',
                                            success: function (data) {
                                                // console.log(3)
                                                if (data.status) {
                                                    $(".dataTable").dataTable().fnDestroy();
                                                    $('#results').html(data.data);
                                                    $(".dataTable").dataTable();
                                                }
                                            },
                                        })
                                        // console.log(4)
                                    }
                                    // console.log(5)
                                } else if (renderType === 'htmltable') {
                                    // console.log(data.data)
                                    $('#results').html(data.data);
                                } else if (renderType === 'hard_reload') {
                                    setTimeout(function () {
                                        location.reload(true);
                                    }, 1500);
                                } else {
                                    $('#results').html(data.data);
                                }
                            } else {
                                swalError(data)
                            }
                        },
                        error: function () {
                            swalError();
                        }
                    })
                } else {
                    swal({
                        title: lang == 'ar' ? 'جيد !' : 'Good !',
                        text: lang == 'ar' ? "بياناتك بامان" : 'Your data is safe!',
                        icon: 'info',
                        timer: 1500,
                        buttons: false,
                        showConfirmButton: false
                    });
                }
            });
    }
});

// --------------------------- reset button ---------------------
// reset button
$("#reset_button , .reset_button").on("click", function (event) {
    let form = $(this).closest("form");
    event.preventDefault();
    swal({
        title: lang == "ar" ? "هل انت متاكد ؟" : "Are you sure?",
        text:
            lang == "ar"
                ? "سيتم الغاء البيانات المدخلة"
                : "You will reset the data you entered!",
        icon: "warning",
        buttons: [(lang == "ar" ? "!لا ، إلغاء" : "No, cancel it!"), (lang == "ar" ? "!نعم ، متأكد" : "Yes, I am sure!")],
        showCancelButton: true,
        dangerMode: true,
    }).then(function (isConfirm) {
        if (isConfirm.dismiss != "cancel") {
            location.reload(true);
        }
    });
});


/*$(document).on('click', 'button[type=submit], input[type=submit]', function () {
    var submitBtn = $(this);
    submitBtn.text(lang == "ar" ? "برجاء الإنتظار ...." : "Please Wait...").prop('disabled', true);
    this.submit();
});*/


/*
$(document).ready(function () {
    $('.selectpicker').selectpicker({
        style: '',
        styleBase: 'form-control',
    });
});
*/

//--------------------------- input js validation --------------
$(document).on('keypress', '.ar_validation', AcceptArOnly);

$(document).on('keypress', '.en_validation', AcceptEnOnly);

$(document).on('keypress', '.main_validation', MainValidation);

function MainValidation(event) {
    var arabicCharUnicodeRange = /[\u0600-\u06FF\ 0-9a-zA-Z]/;
    var key = event.which;
    // 0 = numpad
    // 8 = backspace
    // 32 = space
    if (key == 8 || key == 0 || key === 32) {
        return true;
    }

    var str = String.fromCharCode(key);
    if (arabicCharUnicodeRange.test(str)) {
        return true;
    }
    return false;
}

function AcceptArOnly(event) {
    var arabicCharUnicodeRange = /[\u0600-\u06FF\ 0-9]/;
    var key = event.which;
    // 0 = numpad
    // 8 = backspace
    // 32 = space
    if (key == 8 || key == 0 || key === 32) {
        return true;
    }

    var str = String.fromCharCode(key);
    if (arabicCharUnicodeRange.test(str)) {
        return true;
    }
    return false;
}

function AcceptEnOnly(event) {
    var englishCharUnicodeRange = /^[a-zA-Z0-9]+$/;
    var key = event.which;
    // 0 = numpad
    // 8 = backspace
    // 32 = space
    if (key == 8 || key == 0 || key === 32) {
        return true;
    }

    var str = String.fromCharCode(key);
    if (englishCharUnicodeRange.test(str)) {
        return true;
    }
    return false;
}

var url = $(".url");

url.keyup(function () {

    var prefix = 'http://';
    var prefix2 = 'https://';
    console.log(url.val().substr(0, prefix.length));
    if (url.val().substr(0, prefix.length) !== prefix && url.val().substr(0, prefix2.length) !== prefix2) {
        var oldVal = url.val();
        url.val((prefix + oldVal));
    }
});

// ---------------------- print -------------------
function printElement(strid) {
    var prtContent = document.getElementById(strid);
    let stylesHtml = '';
    for (const node of [...document.querySelectorAll('link[rel="stylesheet"], style')]) {
        stylesHtml += node.outerHTML;
    }
    var WinPrint = window.open('', '', 'letf=0,top=0,width=400,height=400,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write(stylesHtml);
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    // WinPrint.close();
}

// --------------------- numeric fields ----------------

$(document).ready(function () {
    // $(".integer-numbers").forceNumeric();
    $("input[type=number]").forceNumeric();

    $("input[type=checkbox][readonly]").click(function () {
        return false;
    });

    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});

// forceNumeric() plug-in implementation
jQuery.fn.forceNumeric = function () {
    return this.each(function () {
        $(this).keydown(function (e) {
            var key = e.which || e.keyCode;

            if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
                // numbers
                key >= 48 && key <= 57 ||
                // Numeric keypad
                key >= 96 && key <= 105 ||
                // comma, period and minus, . on keypad
                key == 190 || key == 188 || key == 109 || key == 110 ||
                // Backspace and Tab and Enter
                key == 8 || key == 9 || key == 13 ||
                // Home and End
                key == 35 || key == 36 ||
                // left and right arrows
                key == 37 || key == 39 ||
                // Del and Ins
                key == 46 || key == 45)
                return true;

            return false;
        });
    });
}



