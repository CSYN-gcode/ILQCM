@extends('layouts.admin_layout')

@section('title', 'Strategic PO')

@section('content_page')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fas fa-serieses"></i> Strategic PO</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Strategic PO</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <!-- Start Page Content -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  @php
                    $display = 'block';
                  @endphp
                  <div class="float-sm-left" style="min-width: 200px; display: {{ $display }}">
                    <div class="form-group row">
                      <div class="col">
                        <div class="input-group input-group-sm mb-3">
                          <div class="input-group-prepend w-20">
                            <span class="input-group-text w-100">Status</span>
                          </div>
                          <select class="form-control form-control-sm selFilByStat" name="status">
                            <option value="1" selected="true">Active</option>
                            <option value="2">Archived</option>
                          </select>
                        </div>
                      </div>
                    </div> <!-- .form-group row -->
                  </div> <!-- .float-sm-left -->

                  <div class="float-sm-right">
                    <button class="btn btn-primary btn-sm btnAddStrategicPo"><i class="fa fa-plus"></i> Add New Strategic PO</button>
                  </div> <!-- .float-sm-right -->
                  <br><br>

                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="tblStrategicPo" style="width: 100%;">
                      <thead>
                        <tr>
                          <th style="width: 25%;">PO Number</th>
                          <th style="width: 25%;">Series Name</th>
                          <th style="width: 20%;">Created By</th>
                          <th style="width: 20%;">Last Updated By</th>
                          <th style="width: 5%;">Status</th>
                          <th style="width: 5%;">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div> <!-- .table-responsive -->
                </div> <!-- .col-sm-12 -->
              </div> <!-- .row -->
            </div>
            <!-- !-- End Page Content -->

          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- MODALS -->
<div class="modal fade" id="mdlSaveStrategicPo">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-info-circle text-info"></i> Strategic PO Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="frmSaveStrategicPo">
        @csrf
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Strategic PO</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="id" placeholder="Strategic PO ID" style="display: none;">
                <input type="text" class="form-control" name="po_number" placeholder="Strategic PO">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Series Name</label>
                <div class="col-sm-10">
                    <select class="form-control select2 select2bs4" name="series_name" placeholder="Series Name">
                    </select>
                    <span class="text-danger float-sm-right input-error"></span>
                </div>
            </div>

            {{-- <div class="form-group row">
                <label class="col-sm-2 col-form-label">Series Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="series_id" placeholder="Series ID" style="display: none;">
                  <input type="text" class="form-control" name="series_name" placeholder="Series Name">
                  <span class="text-danger float-sm-right input-error"></span>
                </div>
              </div>
          </div> --}}
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSaveStrategicPo">Save</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
  // Variables
  let dtStrategicPo, frmSaveStrategicPo, btnSaveStrategicPo;
</script>

@endsection

@section('js_content')
<!-- Custom Links -->
<script src="{{ asset('public/scripts/client/StrategicPo.js') }}"></script>

<!-- JS Codes -->
<script type="text/javascript">
  $(document).ready(function () {
    frmSaveStrategicPo = $("#frmSaveStrategicPo");
    btnSaveStrategicPo = $('.btnSaveStrategicPo');

    bsCustomFileInput.init();
    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "3000",
      "timeOut": "3000",
      "extendedTimeOut": "3000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    };

    $(document).on('click','#tblStrategicPo tbody tr',function(e){
      $(this).closest('tbody').find('tr').removeClass('table-active');
      $(this).closest('tr').addClass('table-active');
    });

    $.fn.dataTable.ext.errMode = 'none';

    dtStrategicPo = $("#tblStrategicPo").DataTable({
      "processing" : false,
      "serverSide" : true,
      "ajax" : {
        url: "{{ route('view_strategic_po') }}",
        data: function (param){
            param.status = $(".selFilByStat").val();
        }
      },

      "columns":[
        { "data" : "po_number" },
        { "data" : "series_description" },
        { "data" : "first_created_by" },
        { "data" : "latest_updated_by" },
        { "data" : "raw_status" },
        { "data" : "raw_action", orderable:false, searchable:false }
      ],

      "columnDefs": [
        {
          "targets": [0, 1, 2],
          "data": null,
          "defaultContent": "--"
        },
        // { "visible": false, "targets": 1 }
      ],
      "order": [[ 1, "asc" ]],
      "initComplete": function(settings, json) {

      },
      "drawCallback": function( settings ) {

      }
    }).on( 'error', function () {
      toastr.warning('DataTable not loaded properly. Please reload the page. <br> <button class="pull-right btn btn-danger btn-xs btnReload float-sm-right">Reload</button>');
    });//end of dtStrategicPo

    $(document).on('click', '.btnReload', function(){
      // window.location.reload();
      dtStrategicPo.draw();
    });

    $(".selFilByStat").change(function(e){
      dtStrategicPo.draw();
    });

    $(".btnAddStrategicPo").click(function(e){
      $("#mdlSaveStrategicPo").modal('show');
      frmSaveStrategicPo[0].reset();
      $(".input-error", frmSaveStrategicPo).text('');
      $(".form-control", frmSaveStrategicPo).removeClass('is-invalid');
      $("select[name='series_name']", frmSaveStrategicPo).html("");
      $("select[name='series_name']", frmSaveStrategicPo).val("").trigger("change");
    });

    $('#mdlSaveStrategicPo').on('shown.bs.modal', function (e) {
      $('input[name="description"]', frmSaveStrategicPo).focus();
    })

    $("#tblStrategicPo").on('click', '.btnActions', function(e){
      let strat_po_id = $(this).attr('id');
      let action = $(this).attr('action');
      let status = $(this).attr('status');
      let title = '';

      if(action == 1){
        if(status == 2){
          title = 'Archive Series';
        }
        else if(status == 1){
          title = 'Restore Series';
        }
      }
      // else if(action == 2){
      //   title = 'Reset Password';
      // }

      $.confirm({
        title: title,
        content: 'Please confirm to continue.',
        backgroundDismiss: true,
        type: 'blue',
        buttons: {
          confirm: {
            text: 'Confirm',
            btnClass: 'btn-blue',
            keys: ['enter'],
            action: function(){
              StrategicAction(strat_po_id, action, status);
              cnfrmLoading.open();
            }
          },
          cancel: function () {

          },
        }
      });
    });

    $("#frmSaveStrategicPo").submit(function(e){
      e.preventDefault();
      SaveStrategicPo();
    });

    $("#tblStrategicPo").on('click', '.btnEditStrategicPo', function(e){
      let strat_po_id = $(this).attr('id');
      GetStrategicPoById(strat_po_id);
    });

    // $('select[name="series_ids[]"]', frmSaveStation).
    $('select[name="series_name"]', frmSaveStrategicPo).select2({
        // dropdownParent: $('#mdlSaveItemRegistration'),
        placeholder: "Search Series Name",
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
           url: "{{ route('get_cbo_series_by_stat') }}",
           type: "get",
           dataType: 'json',
           delay: 250,
           // quietMillis: 100,
           data: function (params) {
            return {
              search: params.term, // search term
            };
           },
           processResults: function (response) {
             return {
                results: response
             };
           },
           cache: true
        },
    });

    // $('select[name="series_name"]', frmSaveStrategicPo).select2({
    //     // console.log('pindot');
    //     // let emp_id = $(this).attr('user-id');
    //     ajax({
    //         type: "get",
    //         url: "get_system_one_emp_info",
    //         data: {
    //             emp_id: emp_id
    //         },
    //         dataType: "json",
    //         success: function (response) {
    //             let pkid = response['result'][0].pkid;
    //             console.log('id', pkid);
    //             window.open("http://systemone/etr/emp_record_viewer.php?empID="+pkid)
    //         }
    //     });
    // });

  });
</script>
@endsection
