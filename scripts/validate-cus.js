$(function () {
    $("#MyForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: 'Vui lòng nhập vào địa chỉ email!',
                email: 'Địa chỉ email không hợp lệ!'
            }
        }
    });

    $.validator.setDefaults({
        highlight: function (element) {
            $(element)
                .closest('.form-control')
                .addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element)
                .closest('.form-control')
                .removeClass('is-invalid')
                .addClass('is-valid');
        }
    });

    $("#login-form").validate({
        rules: {
            txtEmail: {
                required: true,
                email: true
            },
            txtMatKhau: {
                required: true,
                password: true
            }
        },
        messages: {
            txtEmail: {
                required: 'Không được để trống email!',
                email: 'Địa chỉ email không hợp lệ!',
                remote: $.validator.format("{0} is already asscociated with an account")
            },
            txtMatKhau: {
                required: 'Không được để trống mật khẩu!',
                password: 'Mật khẩu chỉ được chứa kí tự và số!'
            }
        }
    });

    $.validator.setDefaults({
        highlight: function (element) {
            $(element)
                .closest('.form-control')
                .addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element)
                .closest('.form-control')
                .removeClass('is-invalid')
                .addClass('is-valid');
        }
    });


    $("#register-form").validate({
        rules: {
            txtEmail: {
                required: true,
                email: true
            },
            txtMatKhau: {
                required: true,
                minlength: 6,
                maxlength: 8
            },
            txtHoTen: {
                required: true,
                minlength: 3
            },
            txtSDT: {
                required: true,
                number,
                minlength: 8,
                maxlength: 10
            },
            txtNgaySinh: {
                required: true,
                date: true
            },
            txtGioiTinh: {
                required: true,
            },
            txtDiaChi: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            txtEmail: {
                required: 'Không được để trống email!',
                email: 'Địa chỉ email không hợp lệ!'
            },
            txtMatKhau: {
                required: 'Không được để trống mật khẩu!',
                minlength: 'Mật khẩu ít nhất 6 kí tự gồm chữ và số!',
                maxlength: 'Mật khẩu chỉ 6 kí tự gồm chữ và số!'
            },
            txtHoTen: {
                required: 'Không được để trống họ tên!',
                minlength: 'Họ tên không hợp lệ!'
            },
            txtSDT: {
                required: 'Không được để trống số điện thoại!',
                number: 'Chỉ được phép nhập số!',
                minlength: 'Số điện thoại ít nhất 8 kí tự!',
                maxlength: 'Số điện thoại chỉ dài 10 kí tự!'
            },
            txtNgaySinh: {
                required: 'Không được để trống ngày sinh!',
                date: 'Ngày sinh không hợp lệ!'
            },
            txtGioiTinh: {
                required: 'Không được để trống giới tính!',
            },
            txtDiaChi: {
                required: 'Không được để trống địa chỉ!',
                minlength: 'Địa chỉ quá ngắn!'
            }
        }
    });
});