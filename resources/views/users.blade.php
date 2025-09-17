@extends('layouts.admin_layout')

@section('title', 'Users')

@section('content_page')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fas fa-users"></i> Users</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
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
                    <div class="float-sm-left" style="min-width: 500px; display: {{ $display }}">
                        <div class="form-group row">
                            <div class="col-sm-6">
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

                            <div class="col-sm-6">
                                <div class="input-group input-group-sm input-group mb-3">
                                    <div class="input-group-prepend w-20">
                                        <span class="input-group-text w-100">Position</span>
                                    </div>
                                    <select class="form-control selFilByPosition" name="position" placeholder="Position">
                                        <option value="" selected="true" >All</option>
                                        <option value="1">QC</option>
                                        <option value="2">QC Supervisor</option>
                                        <option value="3">Operator</option>
                                        <option value="4">PPC</option>
                                        <option value="5">ADMIN</option>
                                    </select>
                                </div>
                            </div>
                        </div> <!-- .form-group row -->
                    </div> <!-- .float-sm-left -->

                  <div class="float-sm-right">
                    <button class="btn btn-primary btn-sm btnAddUser"><i class="fa fa-plus"></i> Add New</button>
                  </div> <!-- .float-sm-right -->
                  <br><br>

                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="tblUsers" style="width: 100%;">
                      <thead>
                        <tr>
                          <th style="width: 15%;">Name</th>
                          <th style="width: 10%;">Email</th>
                          <th style="width: 10%;">Employee ID</th>
                          <th style="width: 5%;">Position</th>
                          <th style="width: 30%;">Station(s)</th>
                          <th style="width: 15%;">Series(es)</th>
                          <th style="width: 5%;">Status</th>
                          <th style="width: 10%;">Action</th>
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
<div class="modal fade" id="mdlSaveUser">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-info-circle text-info"></i> User Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="frmSaveUser">
        @csrf
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="user_id" placeholder="User ID" style="display: none;">
                <input type="text" class="form-control" name="name" placeholder="Name">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" placeholder="Email">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Employee ID</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="employee_id" placeholder="Employee ID">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Position</label>
              <div class="col-sm-10">
                <select class="form-control" name="position" placeholder="Position">
                    <option value="" selected="true" disabled>Please Select Position</option>
                    <option value="1">QC</option>
                    <option value="2">QC Supervisor</option>
                    <option value="3">Operator</option>
                    <option value="4">PPC</option>
                    <option value="5">ADMIN</option>
                </select>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Station(s)</label>
              <div class="col-sm-10">
                <select class="form-control select2 select2bs4" name="station_ids[]" placeholder="Station(s)" multiple="true">
                </select>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Series(es)</label>
              <div class="col-sm-10">
                <select class="form-control select2 select2bs4" name="series_ids[]" placeholder="Series(es)" multiple="true">
                </select>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <!-- CLARK Modify -->
            {{-- <div class="form-group row">
                <label class="col-sm-2 col-form-label">Trainings</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="trainings_ids" placeholder="Training(s)">
                    <span class="text-danger float-sm-right input-error"></span>
                </div>
            </div> --}}
            <!-- CLARK Modify -->

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSaveUser">Save</button>
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
  let dtUsers, frmSaveUser, btnSaveUser;
</script>

@endsection

@section('js_content')
<!-- Custom Links -->
<script src="{{ asset('public/scripts/client/User.js') }}"></script>

<!-- JS Codes -->
<script type="text/javascript">
  $(document).ready(function () {

    // CLARK CHANGES
    // $("select[name='position']").change(function(e){
    //     console.log($(this).val());
    //     if($(this).val() > 3){
    //         // $('select[name="station_ids[]"]').prop('required', false);
    //         // $('select[name="series_ids[]"]').prop('required', false);

    //         $('select[name="station_ids[]"]').val("0");
    //         $('select[name="series_ids[]"]').val("0");
    //     }else{
    //         $('select[name="station_ids[]"]').val("");
    //         $('select[name="series_ids[]"]').val("");
    //     }
    // //   dtUsers.draw();
    // });
    // CLARK CHANGES

    $("#tblUsers").on('click', '.btnGotoEtr', function(e){
        console.log('pindot');
        let emp_id = $(this).attr('user-id');
        $.ajax({
            type: "get",
            url: "get_system_one_emp_info",
            data: {
                emp_id: emp_id
            },
            dataType: "json",
            success: function (response) {
                let pkid = response['result'].pkid;
                // console.log('id', pkid);
                if(response['emp_cat'] == 'pmi'){
                    window.open("http://systemone/etr/emp_record_viewer.php?empID="+pkid)
                }else if(response['emp_cat'] == 'subcon'){
                    window.open("http://systemone/etr/subcon_employee_records_viewer.php?empID="+pkid)
                }
            }
        });
    });

    frmSaveUser = $("#frmSaveUser");
    btnSaveUser = $('.btnSaveUser');

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

    $(document).on('click','#tblUsers tbody tr',function(e){
      $(this).closest('tbody').find('tr').removeClass('table-active');
      $(this).closest('tr').addClass('table-active');
    });

    $.fn.dataTable.ext.errMode = 'none';

    dtUsers = $("#tblUsers").DataTable({
      "processing" : false,
      "serverSide" : true,
      "ajax" : {
        url: "{{ route('view_users') }}",
        data: function (param){
            param.status = $(".selFilByStat").val();
            param.position = $(".selFilByPosition").val();
        }
      },
      "columns":[
        { "data" : "name" },
        { "data" : "email" },
        { "data" : "employee_id" },
        { "data" : "raw_position" },
        { "data" : "stations" },
        { "data" : "serieses" },
        { "data" : "raw_status" },
        { "data" : "raw_action", orderable:false, searchable:false }
      ],
      "columnDefs": [
        {
          "targets": [0, 1, 2, 3, 4, 5],
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
    });//end of dtUsers

    $(document).on('click', '.btnReload', function(){
      // window.location.reload();
      dtUsers.draw();
    });

    $(".selFilByStat").change(function(e){
      dtUsers.draw();
    });

    $(".selFilByPosition").change(function(e){
      dtUsers.draw();
    });

    $(".btnAddUser").click(function(e){
      $("#mdlSaveUser").modal('show');
      frmSaveUser[0].reset();
      $(".input-error", frmSaveUser).text('');
      $(".form-control", frmSaveUser).removeClass('is-invalid');
      $("select[name='station_ids[]']", frmSaveUser).html("");
      $("select[name='station_ids[]']", frmSaveUser).val("").trigger("change");
      $("select[name='series_ids[]']", frmSaveUser).html("");
      $("select[name='series_ids[]']", frmSaveUser).val("").trigger("change");
    });

    $('#mdlSaveUser').on('shown.bs.modal', function (e) {
      $('input[name="description"]', frmSaveUser).focus();
    })

    $("#tblUsers").on('click', '.btnActions', function(e){
      let userId = $(this).attr('user-id');
      let action = $(this).attr('action');
      let status = $(this).attr('status');
      let title = '';

      if(action == 1){
        if(status == 2){
          title = 'Archive User';
        }
        else if(status == 1){
          title = 'Restore User';
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
              UserAction(userId, action, status);
              cnfrmLoading.open();
            }
          },
          cancel: function () {

          },
        }
      });
    });

    $("#frmSaveUser").submit(function(e){
      e.preventDefault();
      SaveUser();
    });

    $("#tblUsers").on('click', '.btnEditUser', function(e){
      let userId = $(this).attr('user-id');
      GetUserById(userId);
    });

    $("#tblUsers").on('click', '.btnGenerateQRCode', function(e){
      let userId = $(this).attr('user-id');
      GetUserQRCode(userId);
    });

    $('select[name="station_ids[]"]', frmSaveUser).select2({
        // dropdownParent: $('#mdlSaveItemRegistration'),
        placeholder: "",
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
           url: "{{ route('get_cbo_station_by_stat') }}",
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

    $('select[name="series_ids[]"]', frmSaveUser).select2({
        // dropdownParent: $('#mdlSaveItemRegistration'),
        placeholder: "",
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

  });
</script>
@endsection
