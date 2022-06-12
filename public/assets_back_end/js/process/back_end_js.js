Notiflix.Loading.Init({
    svgColor: "#1f6bff",
    fontFamily: "Quicksand",
    useGoogleFont: true,
});

Notiflix.Confirm.Init({
    titleColor: '#212121',
    okButtonColor: '#f8f8f8',
    okButtonBackground: '#1f6bff',
    cancelButtonColor: '#f8f8f8',
    cancelButtonBackground: '#a9a9a9',
    width: '300px',
    useGoogleFont: true,
    fontFamily: 'Quicksand',
});

// $.ajaxSetup({
//     beforeSend() {
//         Notiflix.Loading.Pulse();
//     },
//     complete(status) {
//         Notiflix.Loading.Remove();
//     }
// });

$('document').ready(function () {
    $('textarea').each(function () {
        $(this).val($(this).val().trim());
    });
});

function formatDate(dateMilli) {
    var d = (new Date(dateMilli) + '').split(' ');
    d[2] = d[2] + ',';
    return [d[0], d[1], d[2], d[3]].join(' ');
}

var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'LKR',

    // These options are needed to round to whole numbers if that's what you want.
    //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
    //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});

var baseUrl = window.location.origin;
var new_grn_vat = $('#new_grn_vat');
var new_grn_foreign_model = $('#new_grn_foreign_model');
var new_invoice_vat = $('#new_invoice_vat');
var new_grn_type = $('#new_grn_type');
var new_invoiceproduct_vat = $('#new_invoiceproduct_vat');
var new_grn_warehouse = $('#new_grn_warehouse');


new_grn_warehouse.ready(function () {

    $.ajax({
        type: "GET",
        url: "/admin/warehouse/get/warehouselist",
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();
            response.forEach(element => {
                new_grn_warehouse.append('<option value="' + element['id'] + '">' + element['name'] + ' (' + (element['code']) + ')</option>');
            });
        }
    });
});

new_grn_foreign_model.ready(function () {

    $.ajax({
        type: "GET",
        url: "/admin/foreign_models/get/foreignModelList",
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            response.forEach(element => {
                new_grn_foreign_model.append('<option value="' + element['id'] + '">' + element['foreign_model_name'] + '</option>');
            });
        }
    });
});

new_grn_vat.ready(function () {

    $.ajax({
        type: "GET",
        url: "/admin/vat/get/vatlist",
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            response.forEach(element => {
                new_grn_vat.append('<option value="' + element['id'] + '">Name : ' + element['vat_name'] + ', Value : ' + element['value'] + '%</option>');
            });
        }
    });
});

new_invoice_vat.ready(function () {

    $.ajax({
        type: "GET",
        url: "/admin/vat/get/vatlist",
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            response.forEach(element => {
                new_invoice_vat.append('<option value="' + element['id'] + '">Name : ' + element['vat_name'] + ', Value : ' + element['value'] + '%</option>');
            });
        }
    });
});

// new_grnproduct_vat.ready(function () {

//     $.ajax({
//         type: "GET",
//         url: "/admin/vat/get/vatlist",
//         beforeSend: function () {
//             Notiflix.Loading.Pulse();
//         },
//         success: function (response) {
//             Notiflix.Loading.Remove();

//             response.forEach(element => {
//                 new_grnproduct_vat.append('<option value="' + element['id'] + '">' + element['vat_name'] + ' : ' + element['value'] + '%</option>');
//             });
//         }
//     });
// });

new_invoiceproduct_vat.ready(function () {

    $.ajax({
        type: "GET",
        url: "/admin/vat/get/vatlist",
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            response.forEach(element => {
                new_invoiceproduct_vat.append('<option value="' + element['id'] + '">' + element['vat_name'] + ' : ' + element['value'] + '%</option>');
            });
        }
    });
});

new_grn_type.ready(function () {
    $.ajax({
        type: "GET",
        url: "/admin/grnType/get/grnTypelist",
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            response.forEach(element => {
                new_grn_type.append('<option value="' + element['id'] + '">' + element['grn_type'] + '</option>');
            });
        }
    });
});

var new_category_modal = $("#new_category");
var new_category_modal_link = $("#new_category_modal_link");
var new_category_modal_close_btn = $("#new_category_modal_close_btn");
var category_image_form = $("#category_image_form");
var category_image_upload_input = $("#category_image_upload");
var category_image_delete_button = $("#category_image_delete");

var category_image_preview_div = $("#category_image_preview_div");
var category_image_name_preview_label = $("#category_image_name_preview");
var category_image_upload_preview_img = $("#category_image_upload_preview");
var category_image_upload_loading = $('#category_image_upload_loading');
var category_image_name_success_status = $('#category_image_name_success_status');

var productCategoryTempMap = {};
var new_category_sku = $("#new_category_sku");
var new_category_name = $("#new_category_name");
var new_category_sub = $("#new_category_sub");
var new_category_sub_id = $("#new_category_sub_id");

var new_category_save_btn = $("#new_category_save_btn");
var new_category_code = $("#new_category_code");

function categoryImageUploadDefaultView() {
    category_image_upload_input.val('');
    category_image_upload_preview_img.attr("src", null);
    category_image_upload_preview_img.addClass("d-none")
    category_image_name_success_status.addClass("d-none")
    category_image_preview_div.removeClass("d-none");
}

function categoryModalDefaultView() {
    new_category_name.val("");
    new_category_sub.val("");
    categoryImageUploadDefaultView();
}

function categoryModalSaveBtnModal(status) {
    ((status == 1) ? new_category_save_btn.html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Save') : new_category_save_btn.html('<i class="fa fa-pencil" aria-hidden="true"></i> Update'));
}

new_category_modal_link.click(function (e) {
    e.preventDefault();
    categoryModalDefaultView();
    categoryImageUploadDefaultView();
    categoryModalSaveBtnModal(1);
});

category_image_upload_input.change(function (e) {
    e.preventDefault();
    var x = URL.createObjectURL(e.target.files[0]);
    category_image_upload_preview_img.attr("src", x);
    category_image_upload_preview_img.removeClass("d-none");
    category_image_preview_div.addClass("d-none");
});

category_image_delete_button.click(function (e) {
    e.preventDefault();
    categoryImageUploadDefaultView();
});

category_image_form.on('submit', function (event) {
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "/admin/product/category/uploadCategoryImage",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            if (response['type'] == 'error') {
                categoryImageUploadDefaultView();
                Notiflix.Notify.Failure(response['des']);

            } else if (response['type'] == 'success') {
                category_image_upload_preview_img.removeClass("d-none");
                category_image_name_success_status.removeClass("d-none");
                Notiflix.Notify.Success(response['des']);

            }
        }
    });
});

var productCategoryTempMap = new_category_sub.typeahead({
    source: function (query, process) {
        return $.get('/admin/product/category/get/suggetions', {
            query: query,
        }, function (data) {
            productCategoryTempMap = {};
            data.forEach(element => {
                productCategoryTempMap[element['name']] = element['id'];
            });
            return process(data);
        });
    }
});

productCategoryTempMap.change(function (e) {
    var tempId = productCategoryTempMap[new_category_sub.val()];
    if (tempId != undefined) {
        new_category_sub_id.val(tempId);
    }
});

new_category_sub.keyup(function (e) {
    if ($(this).val().length == 0) {
        new_category_sub.val("");
        new_category_sub_id.val("");
        Notiflix.Notify.Warning("Invalid Category")
    }
});

new_category_save_btn.click(function (e) {
    e.preventDefault();

    var categoryName = new_category_name.val();
    var categorySKU = new_category_sku.val();
    var categorySubCategory = new_category_sub_id.val();

    Notiflix.Confirm.Show('Category Save Confirmation', 'Please confirm to save this category', 'Confirm', 'Ignore', function () {

        $.ajax({
            type: "GET",
            url: "/admin/product/category/db/save",
            data: {
                sku: categoryName,
                name: categoryName,
                category_id: categorySubCategory,
            },
            beforeSend: function () {
                Notiflix.Loading.Pulse();
            },
            success: function (response) {
                if ($.isEmptyObject(response.error)) {
                    Notiflix.Loading.Remove();

                    if (response['type'] == 'error') {

                        Notiflix.Notify.Failure(response['des']);

                    } else if (response['type'] == 'success') {

                        categoryModalDefaultView();
                        new_category_modal.modal('hide');
                        Notiflix.Notify.Success(response['des']);
                        category_table.ajax.reload(null, false);

                    }


                } else {
                    $.each(response.error, function (key, value) {
                        Notiflix.Loading.Remove();
                        Notiflix.Notify.Failure(value);
                    });
                }

            }

        });

    }, function () { });


});

var category_table = $('#category_list').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: true,
    pageLength: 20,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default'
    },
    {
        extend: 'csv',
        className: 'btn btn-default'
    }
    ],
    ajax: {
        url: '/admin/product/category/get/categoryList',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

function update_category_func(id) {

    $.ajax({
        type: "GET",
        url: "/admin/product/category/get/category_view_for_update",
        data: {
            id: id,
        },
        success: function (response) {

            new_category_modal.modal('toggle');
            categoryModalSaveBtnModal(2);

            new_category_code.val(response['code']);
            new_category_name.val(response['name']);
            ((response['get_sub_category_by_id'] == null) ? new_category_sub.val('-') : new_category_sub.val(response['get_sub_category_by_id']['name']));
            category_image_upload_preview_img.attr("src", baseUrl + "/assets_front_end/image/categories/" + response['get_category_image']['name']);
            category_image_upload_preview_img.removeClass("d-none");
            category_image_preview_div.addClass("d-none");

        }
    });

}

new_category_modal_close_btn.click(function (e) {
    e.preventDefault();

    new_category_modal.modal('hide');

});

function change_category_status_func(id, status) {

    $.ajax({
        type: "GET",
        url: "/admin/product/category/get/category_view_for_disable",
        data: {
            id: id,
            status: status
        },
        success: function (response) {

            if (response['type'] == 'error') {

                Notiflix.Notify.Failure(response['des']);

            } else if (response['type'] == 'success') {

                categoryModalDefaultView();
                Notiflix.Notify.Success(response['des']);
                category_table.ajax.reload(null, false);

            }

        }
    });

}

var new_brand_modal = $('#add_brand_modal');
var new_brand_name = $('#new_brand_name');
var new_product_select_brand = $('#new_product_select_brand');
var new_brand_save_btn = $('#new_brand_save_btn');

new_brand_save_btn.click(function (e) {
    e.preventDefault();

    Notiflix.Confirm.Show('Brand Save Confirmation', 'Please confirm to save this brand?', 'Confirm', 'Ignore', function () {

        $.ajax({
            type: "GET",
            url: "/admin/brand/db/save",
            data: {
                brand_name: new_brand_name.val(),
            },
            success: function (response) {
                if ($.isEmptyObject(response.error)) {

                    $.ajax({
                        type: "GET",
                        url: '/admin/brand/get/all',
                        success: function (responseListData) {

                            new_product_select_brand.html('');
                            new_brand_name.val('');
                            new_brand_modal.modal('hide');

                            $.each(responseListData, function (index, element) {
                                if (response['id'] == element['id']) {
                                    new_product_select_brand.append('<option selected value="' + element['id'] + '">' + element['name'] + '</option>');
                                } else {
                                    new_product_select_brand.append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
                                }
                            });
                        }
                    });

                } else {
                    $.each(response.error, function (key, value) {
                        Notiflix.Loading.Remove();
                        Notiflix.Notify.Failure(value);
                    });
                }
            }
        });

    }, function () { });

});

var product_image1_upload = $("#product_image1_upload");
var product_image1_upload_preview = $("#product_image1_upload_preview");
var product_image2_upload = $("#product_image2_upload");
var product_image2_upload_preview = $("#product_image2_upload_preview");
var product_insert_form_reset = $("#product_insert_form_reset");
var new_product_form = $("#new_product_form");
var new_product_des = $("#new_product_des");
var new_product_code = $("#new_product_code");
var product_view_modal = $("#product_view_modal");
var product_view_content = $("#product_view_content");
var product_view_code_name = $("#product_view_code_name");
var product_view_img1 = $("#product_view_img1");
var product_view_img2 = $("#product_view_img2");
var quickEdit_update = $('#quickEdit_update');
var update_product_form = $('#update_product_form');
var update_product_des = $('#update_product_des');

var product_list = $('#product_list');

var product_category_edit_modal = $('#product_category_edit_modal');
var edit_product_category_select_name = $('#edit_product_category_select_name');
var edit_product_select_category = $('#edit_product_select_category');
var edit_category_update_btn = $('#edit_category_update_btn');

product_list.DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [20, 30, 40, 50, 100],
    responsive: false,
    pageLength: 20,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default'
    },
    {
        extend: 'csv',
        className: 'btn btn-default'
    }
    ]
});

$('.summernote').summernote({
    height: 300
});

product_image1_upload.change(function (e) {
    e.preventDefault();
    var x = URL.createObjectURL(e.target.files[0]);
    product_image1_upload_preview.attr("src", x);
});

product_image2_upload.change(function (e) {
    e.preventDefault();
    var x = URL.createObjectURL(e.target.files[0]);
    product_image2_upload_preview.attr("src", x);
});

product_insert_form_reset.click(function (e) {
    e.preventDefault();
    location.reload();
});

new_product_form.on('submit', function (e) {
    e.preventDefault();

    Notiflix.Confirm.Show('Product Save Confirmation', 'Please confirm to save this product?', 'Confirm', 'Ignore', function () {

        var formData = new FormData(new_product_form[0]);

        $.ajax({
            url: "/admin/db/save",
            method: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                Notiflix.Loading.Pulse();
            },
            success: function (response) {
                Notiflix.Loading.Remove();

                console.log(response);

                if ($.isEmptyObject(response.error)) {
                    if (response['type'] == 'error') {
                        Notiflix.Notify.Failure(response['des']);
                    } else if (response['type'] == 'success') {
                        Notiflix.Notify.Success(response['des']);

                        new_product_form.trigger("reset");
                        new_product_des.summernote('reset');
                        product_image1_upload_preview.attr("src", baseUrl + "/assets_back_end/img/image_upload_icon.svg");
                        product_image2_upload_preview.attr("src", baseUrl + "/assets_back_end/img/image_upload_icon.svg");
                        new_product_code.val(response['code']);

                    }
                } else {
                    $.each(response.error, function (key, value) {
                        Notiflix.Notify.Failure(value);
                    });
                }
            }
        });

    }, function () { });
});

// LOCATION.RELOAD
// NEED TO UPDATE
// =====================================
function change_product_status_func(id, status) {

    Notiflix.Confirm.Show('Product Edit Confirmation', 'Please confirm to change status this product?', 'Confirm', 'Ignore', function () {

        $.ajax({
            type: "GET",
            url: "/admin/changeStatus",
            data: {
                id: id,
                status: status,
            },
            success: function (response) {

                if (response['type'] == 'error') {

                    Notiflix.Notify.Failure(response['des']);

                } else if (response['type'] == 'success') {

                    location.reload();

                }

            }
        });

    }, function () { });

}

// LOCATION.RELOAD
// NEED TO UPDATE
// =====================================
function product_default_price_edit(id) {

    var default_price = prompt("Enter New Price:");

    if (typeof (parseFloat(default_price)) == 'number') {

        $.ajax({
            type: "GET",
            url: "/admin/product/db/updateDefaultPrice",
            data: {
                id: id,
                price: default_price
            },
            beforeSend: function () {
                Notiflix.Loading.Pulse();
            },
            success: function (response) {

                if ($.isEmptyObject(response.error)) {
                    Notiflix.Loading.Remove();
                    if (response['type'] == 'error') {
                        Notiflix.Notify.Failure(response['des']);
                    } else if (response['type'] == 'success') {
                        location.reload();
                    }

                } else {
                    $.each(response.error, function (key, value) {
                        Notiflix.Loading.Remove();
                        Notiflix.Notify.Failure(value);
                    });
                }

            }
        });

    } else {
        Notiflix.Notify.Failure('You did not Enter a Valid Number');
    }

}

function product_category_edit(id) {

    $.ajax({
        type: "GET",
        url: "/admin/product/view/updateCategory",
        data: {
            id: id
        },
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();
            edit_product_category_select_name.html(response[1]);
            edit_product_select_category.html('');

            $.each(response[0], function (key, value) {
                edit_product_select_category.append('<option value=' + value['id'] + '>' + value['name'] + '</option>');
            });

            edit_product_select_category.val(response[2]);

            product_category_edit_modal.modal('toggle');
        }
    });

}

// LOCATION.RELOAD
// NEED TO UPDATE
// =====================================
edit_category_update_btn.click(function (e) {
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/admin/product/db/updateCategory",
        data: {
            category_id: edit_product_select_category.val()
        },
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {

            if ($.isEmptyObject(response.error)) {
                Notiflix.Loading.Remove();
                if (response['type'] == 'error') {
                    Notiflix.Notify.Failure(response['des']);
                } else if (response['type'] == 'success') {
                    location.reload();
                }

            } else {
                $.each(response.error, function (key, value) {
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Failure(value);
                });
            }

        }
    });

});

function product_quick_edit(id) {

    $.ajax({
        type: "GET",
        url: "/admin/product/get/edit",
        data: {
            id: id
        },
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();
            console.log(response);
            $('#product_update_code_name').html(response['code'] + ' - ' + response['lang1_name']);
            $('#product_edit_modal').modal('toggle');
        }
    });
}

quickEdit_update.click(function (e) {
    e.preventDefault();

    Notiflix.Confirm.Show('Product Description Update Confirmation', 'Please confirm to update description of this product?', 'Confirm', 'Ignore', function () {

        var formData = new FormData(update_product_form[0]);

        $.ajax({
            url: "/admin/product/db/updateDescription",
            method: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                Notiflix.Loading.Pulse();
            },
            success: function (response) {
                Notiflix.Loading.Remove();

                if ($.isEmptyObject(response.error)) {
                    if (response['type'] == 'error') {
                        Notiflix.Notify.Failure(response['des']);
                    } else if (response['type'] == 'success') {
                        Notiflix.Notify.Success(response['des']);
                        update_product_form.trigger("reset");
                        update_product_des.summernote('reset');
                        $('#product_view_modal').modal('hide');
                    }
                } else {
                    $.each(response.error, function (key, value) {
                        Notiflix.Notify.Failure(value);
                    });
                }
            }
        });

    }, function () { });

});

function product_quick_view(id) {
    product_view_modal.modal('toggle');

    $.ajax({
        type: "GET",
        url: "/admin/product/get/details",
        data: {
            id: id
        },
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();
            product_view_code_name.html(response['code'] + ' - ' + response['lang1_name']);
            product_view_content.html(response['description']);
            product_view_img1.attr("src", baseUrl + "/assets_front_end/image/products/" + response['get_product_image'][0]['get_media']['name']);
            if (response['get_product_image'].length == 2) {
                product_view_img2.attr("src", baseUrl + "/assets_front_end/image/products/" + response['get_product_image'][1]['get_media']['name']);
            }
        }
    });

}

new_supplier_form = $("#new_supplier");
new_supplier_modal = $("#new_supplier_modal");
update_supplier_modal = $("#update_supplier_modal");

var update_supplier_name = $("#update_supplier_name");
var update_supplier_company_name = $("#update_supplier_company_name");
var update_supplier_registration_number = $("#update_supplier_registration_number");
var update_supplier_street_address = $("#update_supplier_street_address");
var update_supplier_city = $("#update_supplier_city");
var update_supplier_tel1 = $("#update_supplier_tel1");
var update_supplier_tel2 = $("#update_supplier_tel2");
var update_supplier_email = $("#update_supplier_email");
var update_supplier_bank_details = $("#update_supplier_bank_details");
var update_supplier_form = $("#update_supplier_form");

var supplier_table = $('#supplier_list').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: true,
    pageLength: 20,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default'
    },
    {
        extend: 'csv',
        className: 'btn btn-default'
    }
    ],
    ajax: {
        url: '/admin/supplier/get/supplierList',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

new_supplier_form.on('submit', function (e) {
    e.preventDefault();

    Notiflix.Confirm.Show('Supplier Save Confirmation', 'Please confirm to save this supplier?', 'Confirm', 'Ignore', function () {

        var formData = new FormData(new_supplier_form[0]);

        $.ajax({
            method: "POST",
            url: "/admin/supplier/db/save",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                Notiflix.Loading.Pulse();
            },
            success: function (response) {
                Notiflix.Loading.Remove();

                if ($.isEmptyObject(response.error)) {
                    if (response['type'] == 'error') {
                        Notiflix.Notify.Failure(response['des']);
                    } else if (response['type'] == 'success') {
                        Notiflix.Notify.Success(response['des']);

                        new_supplier_modal.modal('hide');
                        new_supplier_form.trigger("reset");
                        supplier_table.ajax.reload(null, false);
                    }
                } else {
                    $.each(response.error, function (key, value) {
                        Notiflix.Notify.Failure(value);
                    });
                }
            }
        });

    }, function () { });
});

function createSupplierModalView(data) {
    update_supplier_modal.modal('toggle');

    update_supplier_name.val(data['name']);
    update_supplier_company_name.val(data['company_name']);
    update_supplier_registration_number.val(data['company_regis']);
    update_supplier_street_address.val(data['street_address']);
    update_supplier_city.val(data['city']);
    update_supplier_tel1.val(data['tel1']);
    update_supplier_tel2.val(data['tel2']);
    update_supplier_email.val(data['email']);
    update_supplier_bank_details.val(data['bank_details']);

}

function update_supplier_func_view(id) {

    $.ajax({
        type: "GET",
        url: "/admin/supplier/get/category_view_for_update",
        data: { id: id },
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();
            createSupplierModalView(response);
        }
    });

}

update_supplier_form.on('submit', function (e) {
    e.preventDefault();

    Notiflix.Confirm.Show('Supplier Update Confirmation', 'Please confirm to update this supplier?', 'Confirm', 'Ignore', function () {

        var formData = new FormData(update_supplier_form[0]);

        $.ajax({
            method: "POST",
            url: "/admin/supplier/db/updateSupplier",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                Notiflix.Loading.Pulse();
            },
            success: function (response) {
                Notiflix.Loading.Remove();

                if ($.isEmptyObject(response.error)) {
                    if (response['type'] == 'error') {
                        Notiflix.Notify.Failure(response['des']);
                    } else if (response['type'] == 'success') {
                        Notiflix.Notify.Success(response['des']);
                        update_supplier_form.trigger("reset");
                        update_supplier_modal.modal('hide');
                        supplier_table.ajax.reload(null, false);
                    }
                } else {
                    $.each(response.error, function (key, value) {
                        Notiflix.Notify.Failure(value);
                    });
                }
            }
        });

    }, function () { });

});

function change_supplier_status_func(id, status) {

    Notiflix.Confirm.Show('Supplier Edit Confirmation', 'Please confirm to change status this supplier?', 'Confirm', 'Ignore', function () {

        $.ajax({
            type: "GET",
            url: "/admin/supplier/db/changeStatus",
            data: {
                id: id,
                status: status,
            },
            success: function (response) {

                if (response['type'] == 'error') {
                    Notiflix.Notify.Failure(response['des']);
                } else if (response['type'] == 'success') {
                    supplier_table.ajax.reload(null, false);
                }

            }
        });

    }, function () { });
}

var new_grnproduct_product = $("#new_grnproduct_product");
var new_grnproduct_product_id = $("#new_grnproduct_product_id");
var new_grnproduct_unit_price = $("#new_grnproduct_unit_price");
var new_grn_foreign_model = $("#new_grn_foreign_model");
var new_grnproduct_imei_number = $("#new_grnproduct_imei_number");

var new_grnproduct_save_btn = $("#new_grnproduct_save_btn");

var productTempMap = new_grnproduct_product.typeahead({
    source: function (query, process) {
        return $.get('/admin/product/get/suggetions', {
            query: query,
        }, function (data) {
            productCategoryTempMap = {};
            data.forEach(element => {
                productTempMap[element['name']] = element['id'];
            });
            return process(data);
        });
    }
});

productTempMap.change(function (e) {
    var tempId = productTempMap[new_grnproduct_product.val()];
    if (tempId != undefined) {
        new_grnproduct_product_id.val(tempId);
    }
});



new_grnproduct_product.keyup(function (e) {
    if ($(this).val().length == 0) {
        new_grnproduct_product.val("");
        new_grnproduct_product_id.val("");
    }
});

new_grnproduct_save_btn.click(function (e) {
    e.preventDefault();

    addProductToGrn();

});

new_grnproduct_imei_number.keyup(function (e) {
    if (e.keyCode === 13) {
        e.preventDefault();
        addProductToGrn();
    }
});

function addProductToGrn() {
    $.ajax({
        type: "GET",
        url: "/admin/grn/session/addProduct",
        data: {
            product_id: new_grnproduct_product_id.val(),
            unit_price: new_grnproduct_unit_price.val(),
            foreign_model: new_grn_foreign_model.val(),
            imei_number: new_grnproduct_imei_number.val(),
        },
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            if ($.isEmptyObject(response.error)) {
                if (response['type'] == 'error') {
                    Notiflix.Notify.Failure(response['des']);
                    new_grnproduct_imei_number.val("");
                } else if (response['type'] == 'success') {
                    Notiflix.Notify.Success(response['des']);
                    grn_field_remove();
                    get_grnProductTotal();
                    grnAddedProductList_table.ajax.reload(null, false);
                }
            } else {
                $.each(response.error, function (key, value) {
                    Notiflix.Notify.Failure(value);
                });
            }

            new_grnproduct_imei_number.focus();

        }
    });
}

function grn_field_remove() {
    new_grnproduct_imei_number.val('');
}

var new_grn_total_view = $('#new_grn_total_view');
var new_grn_supplier = $('#new_grn_supplier');
var new_grn_supplier_id = $('#new_grn_supplier_id');
var grn_product_view_modal = $('#grn_product_view_modal');
var grn_product_view_code_name = $('#grn_product_view_code_name');
var grn_product_view_content = $('#grn_product_view_content');
var grn_product_view_img1 = $('#grn_product_view_img1');
var grn_product_view_img2 = $('#grn_product_view_img2');
var new_grn_save_btn = $('#new_grn_save_btn');
var new_grn_po_ref = $('#new_grn_po_ref');
var new_grn_remark = $('#new_grn_remark');
var new_grn_code = $('#new_grn_code');
var new_grn_logistic_name = $('#new_grn_logistic_name');
var new_grn_logistic_amount = $('#new_grn_logistic_amount');
var new_grn_logistic_ref = $('#new_grn_logistic_ref');
var new_grn_logistic_paid_date = $('#new_grn_logistic_paid_date');

var grn_supplierTempMap = new_grn_supplier.typeahead({
    source: function (query, process) {
        return $.get('/admin/supplier/get/suggetions', {
            query: query,
        }, function (data) {
            productCategoryTempMap = {};
            data.forEach(element => {
                grn_supplierTempMap[element['name']] = element['id'];
            });
            return process(data);
        });
    }
});

grn_supplierTempMap.change(function (e) {
    var tempId = grn_supplierTempMap[new_grn_supplier.val()];
    if (tempId != undefined) {
        new_grn_supplier_id.val(tempId);
    }
});

new_grn_supplier.keyup(function (e) {
    if ($(this).val().length == 0) {
        new_grn_supplier.val("");
        new_grn_supplier_id.val("");
        Notiflix.Notify.Warning("Invalid Supplier")
    }
});

function get_grnProductTotal() {
    $.ajax({
        type: "GET",
        data: {
            vat_id: new_grn_vat.val()
        },
        url: "/admin/grn/session/getTotal",
        success: function (response) {

            if ($.isEmptyObject(response.error)) {
                new_grn_total_view.html(response);
            } else {
                $.each(response.error, function (key, value) {
                    Notiflix.Notify.Failure(value);
                });
            }

        }
    });
}

new_grn_vat.change(function (e) {
    e.preventDefault();

    get_grnProductTotal();
});

var grnAddedProductList_table = $('#grn_save_product_list').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: false,
    pageLength: 20,
    searching: false,
    paging: false,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default d-none'
    },
    {
        extend: 'csv',
        className: 'btn btn-default d-none'
    }
    ],
    ajax: {
        url: '/admin/grn/session/grnAddedProductList',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

function grn_product_remove_func(index) {

    Notiflix.Confirm.Show('Confirmation Required', 'Please Confirm to Remove Item From List?', 'Yes', 'No',
        function () {
            $.ajax({
                type: "GET",
                url: "/admin/grn/session/removeProduct",
                data: {
                    grn_product_id: index,
                },
                beforeSend: function () {
                    Notiflix.Loading.Pulse();
                },
                success: function (response) {
                    Notiflix.Loading.Remove();

                    if ($.isEmptyObject(response.error)) {
                        if (response['type'] == 'error') {
                            Notiflix.Notify.Failure(response['des']);
                        } else if (response['type'] == 'success') {
                            Notiflix.Notify.Success(response['des']);
                            grnAddedProductList_table.ajax.reload(null, false);
                            get_grnProductTotal();
                        }
                    } else {
                        $.each(response.error, function (key, value) {
                            Notiflix.Notify.Failure(value);
                        });
                    }
                }
            });
        },
        function () { }
    );

}

function grn_product_view_func(id) {
    alert(id);
}

function grn_product_view_func(id) {

    grn_product_view_modal.modal('toggle');
    $.ajax({
        type: "GET",
        url: "/admin/product/get/details",
        data: {
            id: id
        },
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();
            grn_product_view_code_name.html(response['code'] + ' - ' + response['lang1_name']);
            grn_product_view_content.html(response['description']);
            grn_product_view_img1.attr("src", baseUrl + "/assets_front_end/image/products/" + response['get_product_image'][0]['get_media']['name']);
            if (response['get_product_image'].length == 2) {
                grn_product_view_img2.attr("src", baseUrl + "/assets_front_end/image/products/" + response['get_product_image'][1]['get_media']['name']);
            }
        }
    });
}

new_grn_save_btn.click(function (e) {
    e.preventDefault();

    Notiflix.Confirm.Show('Confirmation Required', 'Please Confirm to Save GRN?', 'Yes', 'No',
        function () {
            $.ajax({
                type: "GET",
                url: "/admin/grn/db/saveGRN",
                data: {
                    grn_type: new_grn_type.val(),
                    supplier_id: new_grn_supplier_id.val(),
                    po_ref: new_grn_po_ref.val(),
                    remark: new_grn_remark.val(),
                    grn_vat: new_grn_vat.val(),
                    warehouse_id: new_grn_warehouse.val(),
                    logistic_name: new_grn_logistic_name.val(),
                    logistic_amount: new_grn_logistic_amount.val(),
                    logistic_ref: new_grn_logistic_ref.val(),
                    logistic_paid_date: new_grn_logistic_paid_date.val(),
                },
                beforeSend: function () {
                    Notiflix.Loading.Pulse();
                },
                success: function (response) {
                    Notiflix.Loading.Remove();
                    if ($.isEmptyObject(response.error)) {
                        if (response['type'] == 'error') {
                            Notiflix.Notify.Failure(response['des']);
                        } else if (response['type'] == 'success') {
                            Notiflix.Notify.Success('Successfully Saved GRN');

                            new_grn_code.val(response['des']);
                            new_grn_clear_fields();
                            grnAddedProductList_table.ajax.reload(null, false);
                            get_grnProductTotal();
                        }
                    } else {
                        $.each(response.error, function (key, value) {
                            Notiflix.Notify.Failure(value);
                        });
                    }
                }
            });
        },
        function () { });
});

function new_grn_clear_fields() {
    new_grn_supplier.val('');
    new_grn_supplier_id.val('');
    new_grn_po_ref.val('');
    new_grn_remark.val('');
    new_grn_logistic_name.val('');
    new_grn_logistic_amount.val('');
    new_grn_logistic_ref.val('');
    new_grn_logistic_paid_date.val('');
    new_grnproduct_product.focus();
}

var purchase_list = $('#purchase_list').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: false,
    pageLength: 20,
    searching: true,
    paging: true,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default d-none'
    },
    {
        extend: 'csv',
        className: 'btn btn-default d-none'
    }
    ],
    ajax: {
        url: '/admin/grn/get/purchaseList',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

var view_purchase_modal = $('#view_purchase');
var view_purchase_payment_modal = $('#view_purchase_payment');
var edit_purchase_modal = $('#edit_purchase');

var view_purchase_supplier_name = $('#view_purchase_supplier_name');
var view_purchase_supplier_address = $('#view_purchase_supplier_address');
var view_purchase_supplier_tel = $('#view_purchase_supplier_tel');
var view_purchase_supplier_email = $('#view_purchase_supplier_email');

var view_purchase_warehouse_name = $('#view_purchase_warehouse_name');
var view_purchase_warehouse_address = $('#view_purchase_warehouse_address');
var view_purchase_warehouse_tel = $('#view_purchase_warehouse_tel');
var view_purchase_warehouse_email = $('#view_purchase_warehouse_email');

var view_purchase_reference = $('#view_purchase_reference');
var view_purchase_date = $('#view_purchase_date');
var view_purchase_status = $('#view_purchase_status');
var view_purchase_payment_status = $('#view_purchase_payment_status');

var view_purchase_table = $('#view_purchase_table');

function view_purchase_func(id) {

    $.ajax({
        type: "GET",
        url: "/admin/grn/view/purchase",
        data: {
            id: id,
        },
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            view_purchase_table.html('');

            if ($.isEmptyObject(response.error)) {

                view_purchase_modal.modal('toggle');

                view_purchase_supplier_name.html((response[0]['get_supplier']['name'] == null) ? '-' : response[0]['get_supplier']['name']);
                view_purchase_supplier_address.html((response[0]['get_supplier']['street_address'] == null) ? '-' : response[0]['get_supplier']['street_address'] + ', ' + response[0]['get_supplier']['city']);
                view_purchase_supplier_tel.html((response[0]['get_supplier']['tel1'] == null) ? '-' : 'Tel: ' + response[0]['get_supplier']['tel1']);
                view_purchase_supplier_email.html((response[0]['get_supplier']['email'] == null) ? '-' : 'Email: ' + response[0]['get_supplier']['email']);

                view_purchase_warehouse_name.html((response[0]['getwarehouse']['name'] == null) ? '-' : response[0]['getwarehouse']['name']);
                view_purchase_warehouse_address.html((response[0]['getwarehouse']['address'] == null) ? '-' : response[0]['getwarehouse']['address']);
                view_purchase_warehouse_tel.html((response[0]['getwarehouse']['telephone'] == null) ? '-' : response[0]['getwarehouse']['telephone']);
                view_purchase_warehouse_email.html((response[0]['getwarehouse']['email'] == null) ? '-' : response[0]['getwarehouse']['email']);

                view_purchase_reference.html((response[0]['grn_code'] == null) ? '-' : 'Reference ' + response[0]['grn_code']);
                view_purchase_date.html('Date: ' + formatDate(response[0]['created_at']));
                view_purchase_status.html('Status: ' + response[0]['get_grn_type']['grn_type']);

                var tbody = "";
                var total = 0;

                if (JSON.stringify(response[0]['get_purchases']) == '[]') {
                    view_purchase_payment_status.html('Payment Status: Pending');
                } else {
                    view_purchase_payment_status.html((response[0]['tot_balance'] != 0) ? 'Payment Status: Done' : 'Payment Status: Pending');
                }

                $.each(response[0]['get_g_r_n_products'], function (key, value) {
                    tbody += '<tr>' +
                        '<td>' + ++key + '</td>' +
                        '<td>' + value['get_foreign_model']['foreign_model_name'] + '</td>' +
                        '<td>' + value['get_product']['lang1_name'] + '</td>' +
                        '<td>' + value['imei'] + '</td>' +
                        '<td>' + formatter.format(value['unit_price']) + '</td>' +
                        '</tr>'
                });

                tbody += '<tr>' +
                    '<td colspan="4" class="text-end font-weight-500">Total Sub Amount</td>' +
                    '<td class="text-end font-weight-500">' + formatter.format(response[0]['total']) + '</td>' +
                    '</tr>';

                tbody += '<tr>' +
                    '<td colspan="4" class="text-end font-weight-500">VAT</td>' +
                    '<td class="text-end font-weight-500">' + response[0]['vat_value'] + '%</td>' +
                    '</tr>';

                tbody += '<tr>' +
                    '<td colspan="4" class="text-end font-weight-500">Total Net Amount</td>' +
                    '<td class="text-end font-weight-500">' + formatter.format(response[0]['net_grn_total']) + '</td>' +
                    '</tr>';

                tbody += '<tr>' +
                    '<td colspan="4" class="text-end font-weight-500">Paid</td>' +
                    '<td class="text-end font-weight-500">' + formatter.format(response[0]['tot_paid']) + '</td>' +
                    '</tr>';

                tbody += '<tr>' +
                    '<td colspan="4" class="text-end font-weight-500">Balance</td>' +
                    '<td class="text-end font-weight-500">' + formatter.format(response[0]['tot_balance']) + '</td>' +
                    '</tr>';

                tbody += '<tr>' +
                    '<td colspan="4" class="text-end font-weight-500">Logistic Amount</td>' +
                    '<td class="text-end font-weight-500">' + formatter.format(response[0]['logistic_amount']) + '</td>' +
                    '</tr>';

                tbody += '<tr>' +
                    '<td colspan="4" class="text-end font-weight-500">GRN Grand Total</td>' +
                    '<td class="text-end font-weight-500">' + formatter.format(response[0]['net_grn_total_with_logistic_amount']) + '</td>' +
                    '</tr>';

                view_purchase_table.html(tbody);

            } else {
                $.each(response.error, function (key, value) {
                    Notiflix.Notify.Failure(value);
                });
            }
        }
    });

}

function print_purchase_func(id) {
    alert('print purchase' + id);
}

function edit_pending_purchase_func(id) {
    edit_purchase_modal.modal('toggle');
}

function view_purchase_payment_func() {
    view_purchase_payment_modal.modal('toggle');
}

function add_purchase_payment_func(id) {
    alert('add purchase payment' + id);
}

function return_purchase_func(id) {
    alert('return purchase' + id);
}

function delete_purchase_func(id) {
    alert('delete purchase' + id);
}

// Able to Develop
// ======================================================

var stock_list = $('#all_stock_list').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: false,
    pageLength: 20,
    searching: true,
    paging: true,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default d-none'
    },
    {
        extend: 'csv',
        className: 'btn btn-default d-none'
    }
    ],
    ajax: {
        url: '/admin/stock/get/allstock',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

var stock_list = $('#product-wise_stock').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: false,
    pageLength: 20,
    searching: true,
    paging: true,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default d-none'
    },
    {
        extend: 'csv',
        className: 'btn btn-default d-none'
    }
    ],
    ajax: {
        url: '/admin/stock/get/product-wise_stock',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

var new_invoiceproduct_product = $("#new_invoiceproduct_product");
var new_invoiceproduct_product_id = $("#new_invoiceproduct_product_id");
var new_invoiceproduct_unit_price = $("#new_invoiceproduct_unit_price");


var productTempMap = new_invoiceproduct_product.typeahead({
    source: function (query, process) {
        return $.get('/admin/product/get/suggetions', {
            query: query,
        }, function (data) {
            productCategoryTempMap = {};
            data.forEach(element => {
                productTempMap[element['name']] = element['id'];
            });
            return process(data);
        });
    }
});

productTempMap.change(function (e) {
    var tempId = productTempMap[new_invoiceproduct_product.val()];
    if (tempId != undefined) {
        new_invoiceproduct_product_id.val(tempId);

        $.ajax({
            type: "GET",
            url: "/admin/product/db/getProductPrice",
            data: {
                id: new_invoiceproduct_product_id.val()
            },
            success: function (response) {

                new_invoiceproduct_unit_price.val(response);
            }
        });

    }
});

new_invoiceproduct_product.keyup(function (e) {
    if ($(this).val().length == 0) {
        new_invoiceproduct_product.val("");
        new_invoiceproduct_product_id.val("");
    }
});

var new_invoice_code = $('#new_invoice_code');
var new_invoice_ref = $('#new_invoice_ref');
var new_invoice_billing_to = $('#new_invoice_billing_to');
var new_invoice_billing_to_id = $('#new_invoice_billing_to_id');
var new_invoice_billing_address = $('#new_invoice_billing_address');
var new_invoice_remark = $('#new_invoice_remark');
var new_invoiceproduct_unit_price = $('#new_invoiceproduct_unit_price');
var new_invoiceproduct_qty = $('#new_invoiceproduct_qty');
var new_invoiceproduct_discount = $('#new_invoiceproduct_discount');
var new_invoiceproduct_vat = $('#new_invoiceproduct_vat');
var new_invoiceproduct_save_btn = $('#new_invoiceproduct_save_btn');
var new_invoice_pay_done_date = $('#new_invoice_pay_done_date');
var new_invoice_type = $('#new_invoice_type');
var new_invoice_save_btn = $('#new_invoice_save_btn');
var new_invoice_total_view = $('#new_invoice_total_view');

var invoice_customerTempMap = new_invoice_billing_to.typeahead({
    source: function (query, process) {
        return $.get('/admin/customer/get/suggetions', {
            query: query,
        }, function (data) {
            data.forEach(element => {
                invoice_customerTempMap[element['name']] = element['id'];
            });
            return process(data);
        });
    }
});

invoice_customerTempMap.change(function (e) {
    var tempId = invoice_customerTempMap[new_invoice_billing_to.val()];
    if (tempId != undefined) {
        new_invoice_billing_to_id.val(tempId);

        $.ajax({
            type: "GET",
            url: "/admin/customer/get/suggetions/address",
            data: {
                id: new_invoice_billing_to_id.val()
            },
            success: function (response) {
                new_invoice_billing_address.val(response);
            }
        });

    }
});

new_invoice_billing_to.keyup(function (e) {
    if ($(this).val().length == 0) {
        new_invoice_billing_to.val("");
        new_invoice_billing_to_id.val("");
        Notiflix.Notify.Warning("Invalid Customer")
    }
});

function invoice_field_remove() {
    new_invoiceproduct_product.val('');
    new_invoiceproduct_product_id.val('');
    new_invoiceproduct_qty.val('');
    new_invoiceproduct_unit_price.val('');
    new_invoiceproduct_discount.val('0');
}

new_invoiceproduct_save_btn.click(function (e) {
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "/admin/invoice/session/addProduct",
        data: {
            product_id: new_invoiceproduct_product_id.val(),
            unit_price: new_invoiceproduct_unit_price.val(),
            qty: new_invoiceproduct_qty.val(),
            vat: new_invoiceproduct_vat.val(),
            discount: new_invoiceproduct_discount.val(),
        },
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            if ($.isEmptyObject(response.error)) {

                if (response == 'RESP1') {
                    Notiflix.Notify.Failure('This product does not have any stock');
                } else if (response == 'RESP2') {
                    Notiflix.Notify.Failure('Invalid stock');
                } else {

                    Notiflix.Notify.Success('Product add to invoice list successfully');

                    console.log(response)
                    invoiceAddedProductList_table.ajax.reload(null, false);

                    invoice_field_remove();
                    get_invoiceProductTotal();

                    new_invoiceproduct_product.focus();
                }

            } else {
                $.each(response.error, function (key, value) {
                    Notiflix.Notify.Failure(value);
                });
            }
        }
    });
});

function get_invoiceProductTotal() {
    $.ajax({
        type: "GET",
        data: {
            vat_id: new_invoice_vat.val()
        },
        url: "/admin/invoice/session/getTotal",
        success: function (response) {

            if ($.isEmptyObject(response.error)) {
                new_invoice_total_view.html(response);
            } else {
                $.each(response.error, function (key, value) {
                    Notiflix.Notify.Failure(value);
                });
            }
        }
    });
}

new_invoice_vat.change(function (e) {
    e.preventDefault();

    get_invoiceProductTotal();
});

var invoiceAddedProductList_table = $('#invoice_save_product_list').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: false,
    pageLength: 20,
    searching: false,
    paging: false,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default d-none'
    },
    {
        extend: 'csv',
        className: 'btn btn-default d-none'
    }
    ],
    ajax: {
        url: '/admin/invoices/session/invoiceTableView',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

function invoice_product_remove_func(index) {

    if (index != null) {
        $.ajax({
            type: "GET",
            url: "/admin//invoices/removeFromSession",
            data: {
                index: index,
            },
            success: function (response) {
                console.log(response);
                if (response != '2') {
                    get_invoiceProductTotal();
                    Notiflix.Notify.Success('Product from invoice list successfully');
                    invoiceAddedProductList_table.ajax.reload(null, false);
                }
            }
        });
    }
}

new_invoice_save_btn.click(function (e) {
    e.preventDefault();


    Notiflix.Confirm.Show('Confirmation Required', 'Please Confirm to Save Invoice?', 'Yes', 'No',
        function () {

            $.ajax({
                type: "GET",
                url: "/admin/invoice/db/save",
                data: {
                    invoice_ref: new_invoice_ref.val(),
                    customer_id: new_invoice_billing_to_id.val(),
                    type_id: new_invoice_type.val(),
                    pay_done_date: new_invoice_pay_done_date.val(),
                    invoice_billing_to: new_invoice_billing_to.val(),
                    invoice_billing_address: new_invoice_billing_address.val(),
                    invoice_remark: new_invoice_remark.val(),
                    invoice_vat: new_invoice_vat.val(),
                },
                beforeSend: function () {
                    $(this).prop("disabled", true);
                    $('#invoice_and_print_save_btn').prop("disabled", true);
                    Notiflix.Loading.Pulse();
                },
                success: function (response) {
                    $('#invoice_save_btn').prop("disabled", false);
                    $('#invoice_and_print_save_btn').prop("disabled", false);
                    Notiflix.Loading.Remove();
                    Notiflix.Notify.Success('Invoice Saved Successful');

                    new_invoice_code.val(response);
                    new_invoice_ref.val(''),
                        new_invoice_billing_to.val(''),
                        new_invoice_billing_address.val(''),
                        new_invoice_remark.val(''),
                        invoiceAddedProductList_table.ajax.reload(null, false);
                    get_invoiceProductTotal();

                }
            });

        },
        function () { });

});

// ONLINE ORDER
var online_order_list = $('#online_order_list').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: false,
    pageLength: 20,
    searching: true,
    paging: true,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default d-none'
    },
    {
        extend: 'csv',
        className: 'btn btn-default d-none'
    }
    ],
    ajax: {
        url: '/admin/online_orders/get/orders',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

var view_order = $('#view_order');

var view_order_deliver_area = $('#view_order_deliver_area');
var view_order_deliver_address = $('#view_order_deliver_address');
var view_order_deliver_contacts = $('#view_order_deliver_contacts');
var view_order_deliver_charges = $('#view_order_deliver_charges');

var view_order_code = $('#view_order_code');
var view_order_date = $('#view_order_date');
var view_order_webuser_name = $('#view_order_webuser_name');
var view_order_email = $('#view_order_email');

var view_order_table = $('#view_order_table');

function view_order_func(id) {

    $.ajax({
        type: "GET",
        url: "/admin/online_orders/view/orders",
        data: {
            id: id,
        },
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            view_order_table.html('');

            if ($.isEmptyObject(response.error)) {

                view_purchase_modal.modal('toggle');

                view_order_deliver_area.html(response[0]['get_web_user_delivery']['get_deliver_area']['city']);
                view_order_deliver_address.html(response[0]['get_web_user_delivery']['street_address']);
                view_order_deliver_contacts.html(response[0]['get_web_user']['mobile_number']);
                view_order_deliver_charges.html(formatter.format(response[0]['get_web_user_delivery']['get_deliver_area']['deliver_amount']));

                view_order_code.html(response[0]['order_code']);
                view_order_date.html('Date: ' + formatDate(response[0]['created_at']));
                view_order_webuser_name.html(response[0]['get_web_user']['fname'] + ' ' + response[0]['get_web_user']['lname']);
                view_order_email.html(response[0]['get_web_user']['email']);

                var tbody = "";
                var order_sub_total = 0;

                $.each(response[0]['get_cart']['get_cart_has_products'], function (key, value) {
                    tbody += '<tr>' +
                        '<td>' + ++key + '</td>' +
                        '<td>' + value['get_product']['code'] + ' - ' + value['get_product']['lang1_name'] + '</td>' +
                        '<td class="text-end">' + value['in_qty'] + ' ' + value['get_product']['get_measurement']['symbol'] + '</td>' +
                        '<td>' + formatter.format(value['unit_price']) + '</td>' +
                        '<td class="text-end">' + formatter.format(value['net_total']) + '</td>' +
                        '<td class="text-end">' + value['discount'] + '%</td>' +
                        '<td class="text-end">' + formatter.format(value['sub_total']) + '</td>' +
                        '</tr>'

                    order_sub_total += value['sub_total'];

                });

                tbody += '<tr>' +
                    '<td colspan="6" class="text-end font-weight-500">Total Net Amount</td>' +
                    '<td class="text-end font-weight-500">' + formatter.format(order_sub_total) + '</td>' +
                    '</tr>';

                tbody += '<tr>' +
                    '<td colspan="6" class="text-end font-weight-500">VAT</td>' +
                    '<td class="text-end font-weight-500">' + response[0]['get_vat']['value'] + '%</td>' +
                    '</tr>';

                tbody += '<tr>' +
                    '<td colspan="6" class="text-end font-weight-500">Total Net Amount</td>' +
                    '<td class="text-end font-weight-500">' + formatter.format(response[0]['net_total']) + '</td>' +
                    '</tr>';

                view_order_table.html(tbody);

            } else {
                $.each(response.error, function (key, value) {
                    Notiflix.Notify.Failure(value);
                });
            }

            view_order.modal('toggle');

        }
    });

}

function order_changed_status_func(id, status) {

    $.ajax({
        type: "GET",
        url: "/admin/online_orders/edit/orders",
        data: {
            id: id,
            status: status
        },
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            if ($.isEmptyObject(response.error)) {
                if (response['type'] == 'error') {
                    Notiflix.Notify.Failure(response['des']);
                } else if (response['type'] == 'success') {
                    Notiflix.Notify.Success(response['des']);
                    online_order_list.ajax.reload(null, false);
                }
            } else {
                $.each(response.error, function (key, value) {
                    Notiflix.Notify.Failure(value);
                });
            }
        }
    });

}

var administration_wise_invoices = $('#administration_wise_invoices').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: false,
    pageLength: 20,
    searching: true,
    paging: true,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default d-none'
    },
    {
        extend: 'csv',
        className: 'btn btn-default d-none'
    }
    ],
    ajax: {
        url: '/admin/invoice/db/get/getInvoiceList',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

function view_invoice_func(id) {

    $.ajax({
        type: "GET",
        url: "/admin/invoice/view/invoice",
        data: {
            id: id,
        },
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            console.log(response);

        }
    });

}

new_customer_form = $("#new_customer");
new_customer_modal = $("#new_customer_modal");
update_customer_modal = $("#update_customer_modal");

var update_customer_name = $("#update_customer_name");
var update_customer_nic = $("#update_customer_nic");
var update_customer_company_name = $("#update_customer_company_name");
var update_customer_registration_number = $("#update_customer_registration_number");
var update_customer_street_address = $("#update_customer_street_address");
var update_customer_city = $("#update_customer_city");
var update_customer_tel1 = $("#update_customer_tel1");
var update_customer_tel2 = $("#update_customer_tel2");
var update_customer_email = $("#update_customer_email");
var update_customer_bank_details = $("#update_customer_bank_details");
var new_customer_password_send = $("#new_customer_password_send");
var update_customer_form = $("#update_customer_form");

var customer_table = $('#customer_list').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: true,
    pageLength: 20,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default'
    },
    {
        extend: 'csv',
        className: 'btn btn-default'
    }
    ],
    ajax: {
        url: '/admin/customer/get/customerList',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

new_customer_form.on('submit', function (e) {
    e.preventDefault();

    Notiflix.Confirm.Show('Customer Save Confirmation', 'Please confirm to save this supplier?', 'Confirm', 'Ignore', function () {

        var formData = new FormData(new_customer_form[0]);

        $.ajax({
            method: "POST",
            url: "/admin/customer/db/save",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                Notiflix.Loading.Pulse();
            },
            success: function (response) {
                Notiflix.Loading.Remove();

                console.log(response);

                if ($.isEmptyObject(response.error)) {
                    if (response['type'] == 'error') {
                        Notiflix.Notify.Failure(response['des']);
                    } else if (response['type'] == 'success') {
                        Notiflix.Notify.Success(response['des']);

                        new_customer_modal.modal('hide');
                        new_customer_form.trigger("reset");
                        customer_table.ajax.reload(null, false);
                    }
                } else {
                    $.each(response.error, function (key, value) {
                        Notiflix.Notify.Failure(value);
                    });
                }
            }
        });

    }, function () { });
});

function createCustomerModalView(data) {
    update_customer_modal.modal('toggle');

    update_customer_name.val(data['name']);
    update_customer_nic.val(data['nic_or_passport']);
    update_customer_company_name.val(data['company_name']);
    update_customer_registration_number.val(data['company_regis']);
    update_customer_street_address.val(data['street_address']);
    update_customer_city.val(data['city']);
    update_customer_tel1.val(data['tel1']);
    update_customer_tel2.val(data['tel2']);
    update_customer_email.val(data['email']);
    update_customer_bank_details.val(data['bank_details']);

}

function update_customer_func_view(id) {

    $.ajax({
        type: "GET",
        url: "/admin/supplier/get/customer_view_for_update",
        data: { id: id },
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();
            createCustomerModalView(response);
        }
    });

}

update_customer_form.on('submit', function (e) {
    e.preventDefault();

    Notiflix.Confirm.Show('Customer Update Confirmation', 'Please confirm to update this customer?', 'Confirm', 'Ignore', function () {

        var formData = new FormData(update_customer_form[0]);

        $.ajax({
            method: "POST",
            url: "/admin/customer/db/updateCustomer",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                Notiflix.Loading.Pulse();
            },
            success: function (response) {
                Notiflix.Loading.Remove();

                if ($.isEmptyObject(response.error)) {
                    if (response['type'] == 'error') {
                        Notiflix.Notify.Failure(response['des']);
                    } else if (response['type'] == 'success') {
                        Notiflix.Notify.Success(response['des']);
                        update_customer_form.trigger("reset");
                        update_customer_modal.modal('hide');
                        customer_table.ajax.reload(null, false);
                    }
                } else {
                    $.each(response.error, function (key, value) {
                        Notiflix.Notify.Failure(value);
                    });
                }
            }
        });

    }, function () { });

});

function change_customer_status_func(id, status) {

    Notiflix.Confirm.Show('Customer Edit Confirmation', 'Please confirm to change status this customer?', 'Confirm', 'Ignore', function () {

        $.ajax({
            type: "GET",
            url: "/admin/customer/db/changeStatus",
            data: {
                id: id,
                status: status,
            },
            success: function (response) {

                if (response['type'] == 'error') {
                    Notiflix.Notify.Failure(response['des']);
                } else if (response['type'] == 'success') {
                    customer_table.ajax.reload(null, false);
                }

            }
        });

    }, function () { });
}

var model_list = $('#model_list').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: true,
    pageLength: 20,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default'
    },
    {
        extend: 'csv',
        className: 'btn btn-default'
    }
    ],
    ajax: {
        url: '/admin/product/models/get/all',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

var product_model_save_btn = $('#product_model_save_btn');
var new_product_model_name = $('#new_product_model_name');
var new_product_select_product_type = $('#new_product_select_product_type');
var new_product_select_brand = $('#new_product_select_brand');

product_model_save_btn.click(function (e) {
    e.preventDefault();

    Notiflix.Confirm.Show('Confirmation Required', 'Please Confirm to Save Product Model?', 'Yes', 'No',
        function () {

            let model_name = new_product_model_name.val();
            let product_type_id = new_product_select_product_type.val();
            let brand_id = new_product_select_brand.val();

            $.ajax({
                type: "GET",
                url: "/admin/product/models/db/save",
                data: {
                    model_name: model_name,
                    product_type_id: product_type_id,
                    brand_id: brand_id
                },
                beforeSend: function () {
                    Notiflix.Loading.Pulse();
                },
                success: function (response) {
                    Notiflix.Loading.Remove();

                    if ($.isEmptyObject(response.error)) {
                        if (response['type'] == 'error') {
                            Notiflix.Notify.Failure(response['des']);
                        } else if (response['type'] == 'success') {
                            Notiflix.Notify.Success(response['des']);

                            model_list.ajax.reload(null, false);

                        }
                    } else {
                        $.each(response.error, function (key, value) {
                            Notiflix.Notify.Failure(value);
                        });
                    }
                }
            });

        },
        function () { });

});

var new_product_select_model = $('#new_product_select_model');

new_product_select_product_type.change(function (e) {
    e.preventDefault();

    new_product_select_model.html('')
    let product_type_id = new_product_select_product_type.val();

    $.ajax({
        type: "GET",
        url: "/admin/product/models/get/getModelByProductId",
        data: {
            product_type_id: product_type_id
        },
        success: function (response) {
            $.each(response, function (index, element) {
                if (index == 0) {
                    new_product_select_model.append('<option value="0">Select a Model</option>');
                    new_product_select_model.append('<option value="' + element['id'] + '">' + element['model_name'] + '</option>');
                } else {
                    new_product_select_model.append('<option value="' + element['id'] + '">' + element['model_name'] + '</option>');
                }
            });
        }
    });

});

// START PRODUCT INSTALLATION

var new_installation_customer_name = $('#new_installation_customer_name');
var new_installation_customer_name_id = $('#new_installation_customer_name_id');
var new_installation_customer_contact = $('#new_installation_customer_contact');
var new_installation_customer_nic = $('#new_installation_customer_nic');
var new_installation_customer_location = $('#new_installation_customer_location');
var new_installation_customer_address = $('#new_installation_customer_address');

var new_install_vehicle_image1_upload = $('#new_install_vehicle_image1_upload');
var new_install_vehicle_image1_upload_preview = $('#new_install_vehicle_image1_upload_preview');
var new_install_vehicle_image2_upload = $('#new_install_vehicle_image2_upload');
var new_install_vehicle_image2_upload_preview = $('#new_install_vehicle_image2_upload_preview');
var new_install_nic_image_front_upload = $('#new_install_nic_image_front_upload');
var new_install_nic_image_front_upload_preview = $('#new_install_nic_image_front_upload_preview');
var new_install_nic_image_back_upload = $('#new_install_nic_image_back_upload');
var new_install_nic_image_back_upload_preview = $('#new_install_nic_image_back_upload_preview');

var new_installation_sim_card_number = $('#new_installation_sim_card_number');
var new_installation_sim_card_number_id = $('#new_installation_sim_card_number_id');
var new_installation_device_imei = $('#new_installation_device_imei');
var new_installation_device_imei_id = $('#new_installation_device_imei_id');

// INSTALLATION OTHER DETAILS

var new_installation_vehicle_plate_number = $('#new_installation_vehicle_plate_number');
var new_installation_vehicle_milage = $('#new_installation_vehicle_milage');
var new_installation_vehicle_model = $('#new_installation_vehicle_model');
var new_installation_vehicle_engine_hours = $('#new_installation_vehicle_engine_hours');
var new_installation_vehicle_engine_minutes = $('#new_installation_vehicle_engine_minutes');
var new_install_model_select = $('#new_install_model_select');
var new_installation_annual_fee = $('#new_installation_annual_fee');
var new_installation_travelling_fee = $('#new_installation_travelling_fee');
var new_installation_warranty_period = $('#new_installation_warranty_period');
var new_installation_payment_type = $('#new_installation_payment_type');
var new_installation_emp = $('#new_installation_emp');
var new_installation_hand_bill_number = $('#new_installation_hand_bill_number');
var new_installation_invoice_admin_use = $('#new_installation_invoice_admin_use');
var new_installation_remark = $('#new_installation_remark');
var installationUpload_btn = $('#installationUpload_btn');
var vehicle_img_form = $('#vehicle_img_form');
var new_installation_type_device_only = $('#new_installation_type_device_only');
var new_installation_type_vehicle = $('#new_installation_type_vehicle');
var new_installation_total_view = $('#new_installation_total_view');

var new_installation_type = 1
var admin_number_in_use = null
var job_referance = null

// INSTALLATION CUSTOMER MANAGEMENT

var new_installation_customerTempMap = new_installation_customer_name.typeahead({
    source: function (query, process) {
        return $.get('/admin/customer/get/suggetions', {
            query: query,
        }, function (data) {
            data.forEach(element => {
                new_installation_customerTempMap[element['name']] = element['id'];
            });
            return process(data);
        });
    }
});

new_installation_customerTempMap.change(function (e) {
    var tempId = new_installation_customerTempMap[new_installation_customer_name.val()];
    if (tempId != undefined) {
        new_installation_customer_name_id.val(tempId);

        $.ajax({
            type: "GET",
            url: "/admin/customer/get/primaryDetails",
            data: {
                id: new_installation_customer_name_id.val()
            },
            success: function (response) {
                console.log(response);
                new_installation_customer_contact.val(response['tel1']);
                new_installation_customer_nic.val(response['nic_or_passport']);
                new_installation_customer_location.val(response['city']);
                new_installation_customer_address.val(response['street_address']);
            }
        });
    }
});

new_installation_customer_name.keyup(function (e) {
    if ($(this).val().length == 0) {
        new_installation_customer_name.val("");
        new_installation_customer_name_id.val("");
        Notiflix.Notify.Warning("Invalid Customer")
    }
});

function customerDetail_reset_fun(confirm_val) {

    if (confirm_val == 1) {
        new_installation_customer_name.val('');
        new_installation_customer_name_id.val('');
        new_installation_customer_contact.val('');
        new_installation_customer_nic.val('');
        new_installation_customer_location.val('');
        new_installation_customer_address.val('');
        new_installation_customer_name.val('');
    } if (confirm_val == 2) {

        Notiflix.Confirm.Show('Please Confirm to Reset Form', 'Please confirm to reset this customer form?', 'Confirm', 'Ignore', function () {
            new_installation_customer_name.val('');
            new_installation_customer_name_id.val('');
            new_installation_customer_contact.val('');
            new_installation_customer_nic.val('');
            new_installation_customer_location.val('');
            new_installation_customer_address.val('');
            new_installation_customer_name.val('');
        }, function () { });

    }
}

// INSTALLATION VEHICLE IMAGE UPLOADING

new_install_vehicle_image1_upload.change(function (e) {
    e.preventDefault();
    var x = URL.createObjectURL(e.target.files[0]);
    new_install_vehicle_image1_upload_preview.attr("src", x);
});

new_install_vehicle_image2_upload.change(function (e) {
    e.preventDefault();
    var x = URL.createObjectURL(e.target.files[0]);
    new_install_vehicle_image2_upload_preview.attr("src", x);
});

new_install_nic_image_front_upload.change(function (e) {
    e.preventDefault();
    var x = URL.createObjectURL(e.target.files[0]);
    new_install_nic_image_front_upload_preview.attr("src", x);
});

new_install_nic_image_back_upload.change(function (e) {
    e.preventDefault();
    var x = URL.createObjectURL(e.target.files[0]);
    new_install_nic_image_back_upload_preview.attr("src", x);
});

// INSTALLATION TYPE MANAGEMENT

new_installation_type_device_only.change(function (e) {
    e.preventDefault();
    var getSelectedInstallationType = document.querySelector('input[name="new_installation_type"]:checked');
    render_Installation_type_view(getSelectedInstallationType.value);
});

new_installation_type_vehicle.change(function (e) {
    e.preventDefault();
    var getSelectedInstallationType = document.querySelector('input[name="new_installation_type"]:checked');
    render_Installation_type_view(getSelectedInstallationType.value);
});

$(document).ready(function () {
    new_installation_type_vehicle.attr('checked', true);
    new_installation_type_vehicle.attr('checked', true);
});

function render_Installation_type_view(selectedInstallationTypeValue) {

    if (selectedInstallationTypeValue == 1) {

        new_installation_type = 1;

        new_installation_vehicle_plate_number.attr('disabled', false);
        new_installation_vehicle_milage.attr('disabled', false);
        new_installation_vehicle_model.attr('disabled', false);
        new_installation_vehicle_engine_hours.attr('disabled', false);
        new_installation_vehicle_engine_minutes.attr('disabled', false);
        new_install_vehicle_image1_upload.attr('disabled', false);
        vehicle_img_form.removeClass('d-none');

    } else if (selectedInstallationTypeValue == 2) {

        new_installation_type = 2;

        new_installation_vehicle_plate_number.attr('disabled', true);
        new_installation_vehicle_milage.attr('disabled', true);
        new_installation_vehicle_model.attr('disabled', true);
        new_installation_vehicle_engine_hours.attr('disabled', true);
        new_installation_vehicle_engine_minutes.attr('disabled', true);
        new_install_vehicle_image1_upload.attr('disabled', true);
        vehicle_img_form.addClass('d-none');

    }

}

// INSTALLATION SIM AND PRODUCT INSERT

var installation_SIMsTempMap = new_installation_sim_card_number.typeahead({
    source: function (query, process) {
        return $.get('/admin/product/sim/get/suggetions', {
            query: query,
        }, function (data) {
            data.forEach(element => {
                installation_SIMsTempMap[element['name']] = element['id'];
            });
            return process(data);
        });
    }
});

new_installation_sim_card_number.change(function (e) {
    var tempId = installation_SIMsTempMap[new_installation_sim_card_number.val()];
    if (tempId != undefined) {
        new_installation_sim_card_number_id.val(tempId);
        viewInvoiceTotal();
    }
});

var installation_productTempMap = new_installation_device_imei.typeahead({
    source: function (query, process) {
        return $.get('/admin/product/product/get/suggetions', {
            query: query,
        }, function (data) {
            data.forEach(element => {
                installation_productTempMap[element['name']] = element['id'];
            });
            return process(data);
        });
    }
});

new_installation_device_imei.change(function (e) {
    var tempId = installation_productTempMap[new_installation_device_imei.val()];
    if (tempId != undefined) {
        new_installation_device_imei_id.val(tempId);
        viewInvoiceTotal();
    }
});

new_installation_travelling_fee.keyup(function (e) {
    viewInvoiceTotal();
});

new_installation_warranty_period.change(function (e) {
    viewInvoiceTotal();
});

// INSTALLATION SAVE

installationUpload_btn.click(function (e) {
    e.preventDefault();

    Notiflix.Confirm.Show('Please Confirm to Reset Form', 'Please confirm to reset this customer form?', 'Confirm', 'Ignore', function () {

        var getSelectedAdminUseNumber = document.querySelector('input[name="admin_number_in_use"]:checked');
        if (getSelectedAdminUseNumber != null) {
            admin_number_in_use = getSelectedAdminUseNumber.value;
        }

        var getSelectedJobReferance = document.querySelector('input[name="job_referance"]:checked');
        if (getSelectedJobReferance != null) {
            job_referance = getSelectedJobReferance.value;
        }

        var selected_functions = $('input[name="funtion_checkbox"]:checked').map(function (_, el) {
            return $(el).val();
        }).get();

        $.when(nicImageUpload(), vehicleImageUpload()).done(function (a1, a2,) {

            if ($.isEmptyObject(a2[0].error)) {
                if (a2[0]['type'] == 'success') {

                    $.ajax({
                        type: "GET",
                        url: "/admin/installation/save",
                        data: {
                            customer_id: new_installation_customer_name_id.val(),
                            installation_type: new_installation_type,
                            vehicle_plate_number: new_installation_vehicle_plate_number.val(),
                            vehicle_milage: new_installation_vehicle_milage.val(),
                            vehicle_model: new_installation_vehicle_model.val(),
                            vehicle_engine_h: new_installation_vehicle_engine_hours.val(),
                            vehicle_engine_m: new_installation_vehicle_engine_minutes.val(),
                            sim_card_id: new_installation_sim_card_number_id.val(),
                            device_id: new_installation_device_imei_id.val(),
                            annual_fee: new_installation_annual_fee.val(),
                            travelling_fee: new_installation_travelling_fee.val(),
                            warranty_id: new_installation_warranty_period.val(),
                            payment_type_id: new_installation_payment_type.val(),
                            emp_id: new_installation_emp.val(),
                            hand_bill_number: new_installation_hand_bill_number.val(),
                            admin_use_numbers: admin_number_in_use,
                            admin_number: new_installation_invoice_admin_use.val(),
                            job_referance: job_referance,
                            selected_functions: selected_functions,
                            remark: new_installation_remark.val(),
                        },
                        beforeSend: function () {
                            Notiflix.Loading.Pulse();
                        },
                        success: function (response) {
                            Notiflix.Loading.Remove();

                            if ($.isEmptyObject(response.error)) {

                                if (response['type'] == 'error') {
                                    Notiflix.Notify.Failure(response['des']);
                                } else if (response['type'] == 'success') {
                                    Notiflix.Notify.Success(response['des']);
                                    print_invoice(response['data']);
                                    location.reload();

                                }

                            } else {
                                $.each(response.error, function (key, value) {
                                    Notiflix.Notify.Failure(value);
                                });
                            }
                        }
                    });
                }
            }
        });

    }, function () { });

});


// START PRINT INVOICE

function print_invoice(id) {

    $.ajax({
        type: "GET",
        url: "/admin/invoice/PRINT",
        data: { id: id },
        success: function (response) {

            Notiflix.Loading.Remove();

            if (response == 2) {
                Notiflix.Notify.Warning('Something Wrong.');
            } else {
                printReport(response);
            }

        }
    });
}

// END PRINT INVOICE


function vehicleImageUpload() {

    var form_vehicle_data = new FormData();

    form_vehicle_data.append("vehicle_img1", document.getElementById('new_install_vehicle_image1_upload').files[0]);
    form_vehicle_data.append("vehicle_img2", document.getElementById('new_install_vehicle_image2_upload').files[0]);
    form_vehicle_data.append("installation_type", new_installation_type);

    return $.ajax({
        url: "/admin/installation/vehicle_images",
        method: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: form_vehicle_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            if ($.isEmptyObject(response.error)) {

                if (response['type'] == 'error') {
                    Notiflix.Notify.Failure(response['des']);
                } else if (response['type'] == 'success') {
                    if (response['code'] != '2') {
                        Notiflix.Notify.Success(response['des']);
                    }
                }

            } else {
                $.each(response.error, function (key, value) {
                    Notiflix.Notify.Failure(value);
                });
            }
        }
    });
}

function nicImageUpload() {

    // NIC IMAGES UPLOADE
    var form_nic_data = new FormData();

    form_nic_data.append("nic_img1", document.getElementById('new_install_nic_image_front_upload').files[0]);
    form_nic_data.append("nic_img2", document.getElementById('new_install_nic_image_back_upload').files[0]);

    return $.ajax({
        url: "/admin/installation/nic_images",
        method: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: form_nic_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            Notiflix.Loading.Pulse();
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            if ($.isEmptyObject(response.error)) {
                if (response['type'] == 'error') {
                    Notiflix.Notify.Failure(response['des']);

                } else if (response['type'] == 'success') {
                    Notiflix.Notify.Success(response['des']);
                }
            } else {
                $.each(response.error, function (key, value) {
                    Notiflix.Notify.Failure(value);
                });
            }
        }
    });

}

function viewInvoiceTotal() {

    let selected_features = $('input[name="funtion_checkbox"]:checked').map(function (_, el) {
        return $(el).val();
    }).get();

    $.ajax({
        type: "GET",
        url: "/admin/installation/viewInstallationTotal",
        data: {
            sim_id: isNaN(new_installation_sim_card_number_id.val()) ? 0 : new_installation_sim_card_number_id.val(),
            device_id: isNaN(new_installation_device_imei_id.val()) ? 0 : new_installation_device_imei_id.val(),
            travelling_fee: isNaN(new_installation_travelling_fee.val()) ? 0 : new_installation_travelling_fee.val(),
            warranty_period_id: isNaN(new_installation_warranty_period.val()) ? 0 : new_installation_warranty_period.val(),
            selected_functions: selected_features,
        },
        success: function (response) {
            Notiflix.Loading.Remove();

            new_installation_total_view.html('');
            new_installation_total_view.html('LKR. ' + response);

        }
    });

}

var installation_datatable_list = $('#installation_datatable_list').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: true,
    pageLength: 20,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default d-none '
    },
    {
        extend: 'csv',
        className: 'btn btn-default d-none'
    }
    ],
    ajax: {
        url: '/admin/installation/list',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        $(cells).addClass('py-1 align-middle');
    }
});

var sim_change_modal = $('#sim_change_modal');

function sim_change(id) {
    // alert('Installation Id ' + id);
    sim_change_modal.modal('toggle');
}

// Start Product Image Edit

function product_image_edit(id) {
    window.location.href = '/admin/product/get/advanceEditView?product_id=' + id + '';
}

var edit_product_form = $('#edit_product_form');
var edit_product_des = $('#edit_product_des');

edit_product_form.on('submit', function (e) {
    e.preventDefault();

    Notiflix.Confirm.Show('Product Save Confirmation', 'Please confirm to edit this product?', 'Confirm', 'Ignore', function () {

        var formData = new FormData(edit_product_form[0]);

        $.ajax({
            url: "/admin/product/save/advanceEditSave",
            method: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                Notiflix.Loading.Pulse();
            },
            success: function (response) {
                Notiflix.Loading.Remove();

                if ($.isEmptyObject(response.error)) {
                    if (response['type'] == 'error') {
                        Notiflix.Notify.Failure(response['des']);
                    } else if (response['type'] == 'success') {
                        Notiflix.Notify.Success(response['des']);
                        window.location.href = '/admin/product_list';
                    }
                } else {
                    $.each(response.error, function (key, value) {
                        Notiflix.Notify.Failure(value);
                    });
                }
            }
        });

    }, function () { });
});

// End Product Image Edit

// Start Installation List

var installation_list = $('#installation_list').DataTable({
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    lengthMenu: [10, 20, 30, 40, 50],
    responsive: false,
    pageLength: 20,
    searching: true,
    paging: true,
    buttons: [{
        extend: 'print',
        className: 'btn btn-default d-none'
    },
    {
        extend: 'csv',
        className: 'btn btn-default d-none'
    }
    ],
    ajax: {
        url: '/admin/installation/list',
        dataSrc: ''
    },
    createdRow: function (row, data, dataIndex, cells) {
        console.log(data);
        $(cells).addClass('py-1 align-middle');
    }
});


// End Installation List

// START INSTALLATION SIM CHANGE

function installation_sim_change() {
    alert();
}

// END INSTALLATION SIM CHANGE

