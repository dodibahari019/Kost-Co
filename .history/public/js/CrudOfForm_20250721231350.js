$(document).ready(function(){
    $(document).on("keyup", ".classRp", function () {
        var v = $(this).val();
        var q = formatRupiah(v);
        $(this).val(q);
    });
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ?  rupiah : '');
    }

    $(document).on("submit", "#DestroyOfFormId", function (event) {
        event.preventDefault();
        let me = $(this);
        let href = me.attr("action");
        let formData = $("#DestroyOfFormId").serialize();
        let table = $("#tableResult").attr("action");
        // var tableAttr = me.parent().attr('tableId');
        var tableAttr = me.closest('table').attr('id');
        var tableId = $("#"+tableAttr+"");
        Swal.fire({
            title: 'Peringatan',
            text: 'Kamu yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2600FF',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: href,
                    data: formData,
                    success: function (result) {
                        tableId.DataTable().ajax.reload(null, false);
                        tableId.DataTable().draw(false);
                        Swal.fire({
                            confirmButtonColor: "#2600FF",
                            title: "Success!",
                            text: "Data berhasil dihapus",
                            icon: "success",
                            timer:1000
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Penghapusan Gagal",
                        });
                    },
                });
            }
        });
    });

    $(document).on("submit", "#DestroyOfFormIdSales", function (event) {
        event.preventDefault();
        let me = $(this);
        let href = me.attr("action");
        let formData = $("#DestroyOfFormIdSales").serialize();
        let table = $("#tableResult").attr("action");
        // var tableAttr = me.parent().attr('tableId');
        var tableAttr = me.closest('table').attr('id');
        var tableId = $("#"+tableAttr+"");
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2600FF',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: href,
                    data: formData,
                    success: function (result) {
                        tableId.DataTable().ajax.reload(null, false);
                        tableId.DataTable().draw(false);
                        ReloadDataOfShit();
                        Swal.fire({
                            confirmButtonColor: "#2600FF",
                            title: "Success!",
                            text: "Data berhasil dihapus",
                            icon: "success",
                            timer:1000
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Penghapusan Gagal",
                        });
                    },
                });
            }
        });
    });

    $(document).on("submit", "#CreateForm", function (event) {
        event.preventDefault();
        var me = $(this);
        let href = me.attr("action");
        var form = $("#CreateForm");
        let formData = form.serialize();
        let tableAttr = me.attr('dataTableId');
        var tableId = $(tableAttr).DataTable(); // Mengakses instance DataTable yang benar
        var windowId = me.closest('.windowContainer').first().attr('windowId');

        // Reset error messages
        form.find(".help-block").remove();
        form.find(".form-floating").removeClass("has-error");

        $.ajax({
            type: "post",
            url: href,
            data: formData,
            success: function (result) {
                tableId.ajax.reload(null, false); // Reload dataTable
                $('#' + windowId).PopupWindow('close');
                Swal.fire({
                    confirmButtonColor: "#2600FF",
                    title: "Success!",
                    text: "Data Berhasil Disimpan",
                    icon: "success",
                    timer: 1000
                });
            },
            error: function (xhr) {
                var res = xhr.responseJSON;
                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors, function (key, value) {
                        $("#" + key)
                            .closest(".form-group")
                            .addClass("has-error")
                            .append(
                                '<span class="help-block" style="color: #DC3545;">' +
                                    value +
                                "</span>"
                            );
                    });
                }
            },
        });
    });

    $(document).on("submit", ".postClass", function (event) {
        event.preventDefault();
        var me = $(this);
        let href = me.attr("action");
        var form = $(".postClass");
        let formData = me.serialize();
        let table = $("#tableResult").attr("action");
        var windowId = me.closest('.windowContainer').first().attr('windowId');
        var tableAttr = me.attr('dataTableId');
        var tableId = $(tableAttr);
        var dataTable = $("#table").DataTable();
        form.find(".help-block").remove();
        form.find(".form-floating").removeClass("has-error");
        $.ajax({
            type: "post",
            url: href,
            data: formData,
            success: function (result) {
                tableId.DataTable().draw(false);
                $('#'+windowId+"").PopupWindow('close');
                tableId.DataTable().ajax.reload(null, false);
                $("#formModal").modal("hide");
                Swal.fire({
                    confirmButtonColor: "#2600FF",
                    title: "Success!",
                    text: "Data Telah Berhasil Disimpan",
                    icon: "success",
                    timer : 1000
                });
                // document.getElementById('subViewData').click();
            },
            error: function (xhr) {
                var res = xhr.responseJSON;
                // console.log('ini error',res);
                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors, function (key, value) {
                        $("#" + key)
                            Swal.fire({
                                icon: "error",
                                title: "Opps!",
                                text: value,
                                confirmButtonColor: "#2600FF",
                                timer: 1500
                            })
                    });
                }
            },
        });
    });

    $(document).off("submit", ".postClassGambar").on("submit", ".postClassGambar", function (event) {
        event.preventDefault();
        var me = $(this);
        let href = me.attr("action");
        var form = $(".postClassGambar");
        // let formData = me.serialize();
        let formData = new FormData(this);
        let table = $("#tableResult").attr("action");
        var windowId = me.closest('.windowContainer').first().attr('windowId');
        var tableAttr = me.attr('dataTableId');
        var tableId = $(tableAttr);
        var dataTable = $("#table").DataTable();
        form.find(".help-block").remove();
        form.find(".form-floating").removeClass("has-error");
        $.ajax({
            type: "post",
            url: href,
            data: formData,
            processData: false,
            contentType: false,
            success: function (result) {
                tableId.DataTable().draw(false);
                $('#'+windowId+"").PopupWindow('close');
                tableId.DataTable().ajax.reload(null, false);
                $("#formModal").modal("hide");
                Swal.fire({
                    confirmButtonColor: "#2600FF",
                    title: "Success!",
                    text: "Data Telah Berhasil Disimpan",
                    icon: "success",
                    timer : 1000
                });
                // document.getElementById('subViewData').click();
            },
            error: function (xhr) {
                var res = xhr.responseJSON;
                // console.log('ini error',res);
                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors, function (key, value) {
                        $("#" + key)
                            Swal.fire({
                                icon: "error",
                                title: "Opps!",
                                text: value,
                                confirmButtonColor: "#2600FF",
                                timer: 1500
                            })
                    });
                }
            },
        });
    });

    $(document).on("submit", "#editForm", function (event) {
        event.preventDefault();
        var me = $(this);
        let href = me.attr("action");
        let formData = $("#editForm").serialize();
        // let table = $("#tableResult").attr("action");
        // var tableAttr = me.parent().attr('tableId');
        // var tableId = $(tableAttr);
        var tableAttr = me.attr('dataTableId');
        // alert(tableAttr);
        var tableId = $(tableAttr);
        var windowId = me.closest('.windowContainer').first().attr('windowId');
        var form = $("#editForm");
        // alert(windowId);
        form.find(".help-block").remove();
        form.find(".form-group").removeClass("has-error");
        $.ajax({
            type: "post",
            url: href,
            data: formData,
            success: function (result) {
                tableId.DataTable().draw(false);
                $('#'+windowId+"").PopupWindow('close');
                // $("#formModal").modal("hide");

                tableId.DataTable().ajax.reload(null, false);
                Swal.fire({
                    confirmButtonColor: "#2600FF",
                    title: "Success!",
                    text: "Data Has Been Edited",
                    icon: "success",
                    timer:1000
                });
            },
            error: function (xhr) {
                var res = xhr.responseJSON;
                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors, function (key, value) {
                        $("#" + key)
                            .closest(".form-group")
                            .addClass("has-error")
                            .append(
                                '<span class="help-block" style="color: red;">' +
                                    value +
                                    "</span>"
                            );
                    });
                }
            },
        });
    });

    $(document).off("submit", "#editFormGambar").on("submit", "#editFormGambar", function (event) {
        event.preventDefault();
        var me = $(this);
        let href = me.attr("action");
        // let formData = $("#editFormGambar").serialize();
        var formData = new FormData(this);
        // let table = $("#tableResult").attr("action");
        // var tableAttr = me.parent().attr('tableId');
        // var tableId = $(tableAttr);
        var tableAttr = me.attr('dataTableId');
        // alert(tableAttr);
        var tableId = $(tableAttr);
        var windowId = me.closest('.windowContainer').first().attr('windowId');
        var form = $("#editFormGambar");
        // alert(windowId);
        form.find(".help-block").remove();
        form.find(".form-group").removeClass("has-error");
        $.ajax({
            type: "post",
            url: href,
            data: formData,
            processData: false,
            contentType: false,
            success: function (result) {
                tableId.DataTable().draw(false);
                $('#'+windowId+"").PopupWindow('close');
                // $("#formModal").modal("hide");

                tableId.DataTable().ajax.reload(null, false);
                Swal.fire({
                    confirmButtonColor: "#2600FF",
                    title: "Success!",
                    text: "Data Has Been Edited",
                    icon: "success",
                    timer:1000
                });
            },
            error: function (xhr) {
                var res = xhr.responseJSON;
                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors, function (key, value) {
                        $("#" + key)
                            .closest(".form-group")
                            .addClass("has-error")
                            .append(
                                '<span class="help-block" style="color: red;">' +
                                    value +
                                    "</span>"
                            );
                    });
                }
            },
        });
    });

    $(document).on("submit", ".notif", function (event) {
        event.preventDefault();
        let me = $(this);
        let id = me.attr('id');
        let href = me.attr("action");
        let message = me.attr('message');
        let yes = me.attr('yes');
        let ConfirmYes = me.attr('ConfirmYes');
        let table = $("#tableResult").attr("action");
        // var tableAttr = me.parent().attr('tableId');
        var tableAttr = me.closest('table').attr('id');
        var tableId = $("#"+tableAttr+"");

        // let formData = me.serialize();
        var formData = new FormData(this);
        Swal.fire({
            title: 'Peringatan',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2600FF',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: href,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (result) {
                        // tableId.DataTable().ajax.reload(null, false);
                        history.go(0);

                        tableId.DataTable().draw(false);
                        Swal.fire({
                            confirmButtonColor: "#2600FF",
                            title: "Success!",
                            text: ConfirmYes,
                            icon: "success",
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        });
                    },
                });
            }
        });
    });

    $(document).on("submit", "#ProcessOfFormId", function (event) {
        event.preventDefault();
        let me = $(this);
        let href = me.attr("action");
        let formData = $("#ProcessOfFormId").serialize();
        let table = $("#tableResult").attr("action");
        // var tableAttr = me.parent().attr('tableId');
        var tableAttr = me.closest('table').attr('id');
        var tableId = $("#"+tableAttr+"");
        Swal.fire({
            title: 'Peringatan',
            text: 'Kamu yakin ingin menandai selesai data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2600FF',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: href,
                    data: formData,
                    success: function (result) {
                        tableId.DataTable().ajax.reload(null, false);
                        tableId.DataTable().draw(false);
                        Swal.fire({
                            confirmButtonColor: "#2600FF",
                            title: "Success!",
                            text: "Data berhasil ditandai selesai",
                            icon: "success",
                            timer:1000
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Penandaan Selesai Gagal",
                        });
                    },
                });
            }
        });
    });

    $(document).on("submit", "#ApprovedOfFormId", function (event) {
        event.preventDefault();
        let me = $(this);
        let href = me.attr("action");
        // let formData = $("#ApprovedOfFormId").serialize();
        let formData = me.serialize();
        let table = $("#tableResult").attr("action");
        let message = me.attr("message") ?? "Apakah kamu yakin?";
        // var tableAttr = me.parent().attr('tableId');
        var tableAttr = me.closest('table').attr('id');
        var tableId = $("#"+tableAttr+"");
        Swal.fire({
            title: 'Peringatan',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2600FF',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: href,
                    data: formData,
                    success: function (result) {
                        tableId.DataTable().ajax.reload(null, false);
                        tableId.DataTable().draw(false);
                        Swal.fire({
                            confirmButtonColor: "#2600FF",
                            title: "Success!",
                            text: "Data berhasil ditandai selesai",
                            icon: "success",
                            timer:1000
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Penandaan Selesai Gagal",
                        });
                    },
                });
            }
        });
    });

    $(document).on("submit", "#formLogin", function (event) {
        event.preventDefault();

        let form = $(this);
        let actionUrl = form.attr("action");
        let formData = form.serialize();

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: formData,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Login berhasil!',
                    text: response.message,
                    confirmButtonColor: "#2600FF",
                    timer: 1500
                }).then(() => {
                    window.location.href = response.redirect;
                });
            },
            error: function (xhr) {
                let res = xhr.responseJSON;
                Swal.fire({
                    icon: "error",
                    title: "Login Gagal",
                    text: res?.message || "Terjadi kesalahan saat login.",
                    confirmButtonColor: "#2600FF",
                    timer: 2000
                });
            }
        });
    });

    $(document).on("submit", "#formLogout", function (event) {
        event.preventDefault(); // hentikan submit default

        Swal.fire({
            title: 'Peringatan',
            text: 'Yakin ingin logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2600FF',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = $('#formLogout');
                let actionUrl = form.attr("action");
                let formData = form.serialize(); // ambil _token

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: formData,
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Logout Berhasil',
                            text: response.message,
                            confirmButtonColor: "#2600FF",
                            timer: 1500
                        }).then(() => {
                            window.location.href = response.redirect;
                        });
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Logout',
                            text: 'Terjadi kesalahan saat logout.',
                            confirmButtonColor: "#2600FF"
                        });
                    }
                });
            }
        });
    });





























})
