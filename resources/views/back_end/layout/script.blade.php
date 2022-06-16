<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets_back_end/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets_back_end/js/app.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="{{ asset('assets_back_end/js/jquery.maskedinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets_back_end/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
</script>
<script src="{{ asset('assets_back_end/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets_back_end/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets_back_end/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets_back_end/plugins/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets_back_end/plugins/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets_back_end/plugins/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets_back_end/plugins/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets_back_end/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}">
</script>
<script src="{{ asset('assets_back_end/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
</script>
<script src="{{ asset('assets_back_end/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
</script>
<script src="{{ asset('assets_back_end/plugins/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets_back_end/js/demo/dashboard.demo.js') }}"></script>
<script src="{{ asset('assets_back_end/plugins/summernote/dist/summernote-lite.min.js') }}"></script>
<script src="{{ asset('assets_back_end/plugins/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('assets_back_end/plugins/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets_back_end/plugins/tag-it/js/tag-it.min.js') }}"></script>

<script src="{{ asset('assets_back_end/js/notiflix.js') }}"></script>
<script src="{{ asset('assets_back_end/js/process/print.js') }}"></script>
<script src="{{ asset('assets_back_end/js/process/back_end_js.js') }}"></script>

<script src="{{ asset('assets_back_end/js/rocket-loader.min.js') }}" data-cf-settings="0485eeef8cf3263d1a7b2548-|49"
defer=""></script>

<script>
    $('#datatableDefault').DataTable({
        dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
        lengthMenu: [10, 20, 30, 40, 50],
        responsive: true,
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

    $('#product_function_list').DataTable({
        lengthMenu: [10, 20, 30, 40, 50],
        responsive: true,
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

    $('#product_model_list').DataTable({
        lengthMenu: [10, 20, 30, 40, 50],
        responsive: true,
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

    $(document).ready(function() {
        $('#jquery-tagit').tagit({
            fieldName: 'tags',
            availableTags: ['c++', 'java', 'php', 'javascript', 'ruby', 'python', 'c'],
            autocomplete: {
                delay: 0,
                minLength: 2
            }
        });
    });
</script>
