@extends('layouts.admin_layout')

@section('title', 'Monitorings')

@section('content_page')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fas fa-monitorings"></i> Monitorings</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Monitorings</li>
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
                  <div class="float-sm-left">
                    <h4><i class="fas fa-filter"></i> Filter</h4>
                  </div>

                  <div class="float-sm-right">
                    <button class="btn btn-primary btn-sm btnAddMonitoring"><i class="fa fa-plus"></i> Add New</button>
                  </div> <!-- .float-sm-right -->
                </div>
                <br><br>

                <div class="col-sm-12">

                  <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="float-sm-left" style="min-width: 200px; width: 100%; display: block;">
                                    <div class="input-group input-group mb-3">
                                        <div class="input-group-prepend w-20">
                                            <span class="input-group-text w-100">Status</span>
                                        </div>
                                        <select class="form-control form-control selFilByStat" name="status">
                                            <option value="1" selected="true">Active</option>
                                            <option value="2">Archived</option>
                                        </select>
                                    </div>
                                </div> <!-- .float-sm-left -->
                            </div>

                            <div class="col-sm-3">
                                <div class="float-sm-left" style="min-width: 200px; width: 100%; display: block;">
                                    <div class="input-group input-group mb-3">
                                        <div class="input-group-prepend w-20">
                                            <span class="input-group-text w-100">Fiscal Year</span>
                                        </div>
                                        {{-- echo date('Y'); current year --}}
                                        {{-- <input type="text" class="form-control form-control txtFilByYear" name="year" value="<?php echo date('Y'); ?>"> --}}
                                        <input type="text" class="form-control form-control txtFilByYear" name="year" value="">
                                    </div>
                                </div> <!-- .float-sm-left -->
                            </div>

                            <div class="col-sm-3">
                                <div class="float-sm-left" style="min-width: 200px; width: 100%; display: block;">
                                    <div class="input-group input-group mb-3">
                                        <div class="input-group-prepend w-20">
                                            <span class="input-group-text w-100">Shift</span>
                                        </div>
                                        <select class="form-control form-control selFilByShift" name="shift">
                                            <option value="A" selected="true">A</option>
                                            <option value="B">B</option>
                                        </select>
                                    </div>
                                </div> <!-- .float-sm-left -->
                            </div>

                            <div class="col-sm-3">
                                <div class="float-sm-left" style="min-width: 200px; width: 100%; display: block;">
                                <div class="input-group input-group mb-3">
                                    <div class="input-group-prepend w-20">
                                    <span class="input-group-text w-100">Work Week</span>
                                    </div>
                                    <input type="number" class="form-control form-control txtFilByWorkWeek" name="work_week" min="1" max="53" value="<?php echo (date("W") - date("W", strtotime(date('Y').'-04-01'))); ?>">
                                </div>
                                </div> <!-- .float-sm-left -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="float-sm-left" style="min-width: 200px; width: 100%; display: block;">
                                    <div class="input-group input-group mb-3">
                                        <div class="input-group-prepend w-20">
                                            <span class="input-group-text w-100">Family</span>
                                        </div>
                                        <select class="form-control form-control select2 selFilByFamily" name="family" style="width: 60%;"></select>
                                    </div>
                                </div> <!-- .float-sm-left -->
                            </div>

                            <div class="col-sm-5">
                                <div class="float-sm-left" style="min-width: 200px; width: 100%; display: block;">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend w-20">
                                            <span class="input-group-text w-100">Description</span>
                                        </div>
                                        <select class="form-control form-control-sm selFilByProdLineDesc select2 select2bs4" name="pl_description" style="width: 60%;">
                                        </select>
                                    </div> <!-- .float-sm-left -->
                                </div>
                            </div>

                            {{-- <div class="col-sm-4">
                            <div class="float-sm-left" style="min-width: 200px; width: 100%; display: block;">
                                <div class="input-group input-group mb-3">
                                <div class="input-group-prepend w-20">
                                    <span class="input-group-text w-100">Month</span>
                                </div>
                                <input type="month" class="form-control form-control txtFilByMonth" name="month">
                                </div>
                            </div> <!-- .float-sm-left -->
                            </div> --}}
                        </div>
                    </div>

                  </div>
                  <br>
                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="tblMonitorings" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>Line</th>
                          <th>Work Week</th>
                          <th>Date From</th>
                          <th>Date To</th>
                          <th>Shift</th>
                          <th>Machine</th>
                          <th>QC Inspector</th>
                          <th>Checked By</th>
                          <th>Status</th>
                          <th>Action</th>
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
<div class="modal fade" id="mdlSaveMonitoring">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-info-circle text-info"></i> Monitoring Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="frmSaveMonitoring">
        @csrf
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Line</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="monitoring_id" placeholder="Monitoring ID" style="display: none;">
                <input type="text" class="form-control" name="product_line_id" placeholder="Product Line ID" style="display: none;">
                <select class="form-control select2 select2bs4" name="line_id" placeholder="Line">

                </select>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label"><i class="fa fa-info-circle text-primary" title="Note: You cannot edit this once you saved."></i> Work Week</label>
              <div class="col-sm-10">
                {{--
                    nmodify MIGZ 03-25-2024, remove the maximum input
                    <input type="number" class="form-control" name="work_week" placeholder="Work Week" min="1" max="52">
                --}}
                <input type="number" class="form-control" name="work_week" placeholder="Work Week" min="1" max="53">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Date From</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="date_from" placeholder="(Auto Computed)" readonly="true">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Date To</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="date_to" placeholder="(Auto Computed)" readonly="true">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Shift</label>
              <div class="col-sm-10">
                <select class="form-control" name="shift" placeholder="Line">
                  <option value="A" selected="true">A</option>
                  <option value="B">B</option>
                </select>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Machine</label>
              <div class="col-sm-10">
                <select class="form-control select2 select2bs4" name="machine_id" placeholder="Machine">

                </select>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">QC Inspector</label>
              <div class="col-sm-10">
                <select class="form-control select2 select2bs4" name="qc_inspector" placeholder="QC Inspector">

                </select>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Checked By</label>
              <div class="col-sm-10">
                <select class="form-control select2 select2bs4" name="qc_checked_by" placeholder="Checked By">

                </select>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSaveMonitoring">Save</button>
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
  let dtMonitorings, frmSaveMonitoring, btnSaveMonitoring;
  let monitorningFilter = {
    family: null,
    plDescription: null,
    plId: null,
  };
</script>

@endsection

@section('js_content')
<!-- Custom Links -->
<script src="{{ asset('public/scripts/client/Monitoring.js?n=1132434') }}"></script>
<script src="{{ asset('public/scripts/client/Family.js?n=1') }}"></script>

<!-- JS Codes -->
<script type="text/javascript">
  $(document).ready(function () {
    frmSaveMonitoring = $("#frmSaveMonitoring");
    btnSaveMonitoring = $('.btnSaveMonitoring');

    let currentFY = getCurrentFiscalYear();

    // Only set if empty (important for edit mode)
    if (!$('.txtFilByYear').val()) {
        $('.txtFilByYear').val(currentFY);
    }

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

    $(document).on('click','#tblMonitorings tbody tr',function(e){
      $(this).closest('tbody').find('tr').removeClass('table-active');
      $(this).closest('tr').addClass('table-active');
    });

    $('.selFilByProdLineDesc').change(function(){
      if($(this).val() != "" && $(this).val() != null){
        $('.btnAddMonitoring').prop('disabled', false);
      }
      else{
        // $('.btnAddMonitoring').prop('disabled', true);
      }

      dtMonitorings.draw();
    });

    $('.selFilByShift').change(function(){
      dtMonitorings.draw();
    });

    $('.txtFilByYear').change(function(){
      dtMonitorings.draw();
    });

    // $('.txtFilByMonth').change(function(){
    //   dtMonitorings.draw();
    // });

    $('.txtFilByWorkWeek').keyup(function(){
      dtMonitorings.draw();
    });

    GetFamilyName($(".selFilByFamily"));

    $('.selFilByFamily').change(function(){
      // $('.btnAddMonitoring').prop('disabled', true);
      $('.selFilByProdLineDesc').select2().val("").trigger("change");
      $('.selFilByProdLineDesc').select2({
          // dropdownParent: $('#mdlSaveItemRegistration'),
          placeholder: "",
          minimumInputLength: 2,
          allowClear: true,
          ajax: {
             url: "{{ route('get_cbo_product_line_by_family') }}",
             type: "get",
             dataType: 'json',
             delay: 250,
             // quietMillis: 100,
             data: function (params) {
              return {
                search: params.term, // search term
                family: $('.selFilByFamily').val(),
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

    if(localStorage.getItem("monitorningFilter") == undefined){
      localStorage.setItem("monitorningFilter", JSON.stringify(monitorningFilter));
      monitorningFilter = JSON.parse(localStorage.getItem("monitorningFilter"));
    }
    else{
      monitorningFilter = JSON.parse(localStorage.getItem("monitorningFilter"));
      if($('.selFilByProdLineDesc').val() != "" && $('.selFilByProdLineDesc').val() != null){
        $('.btnAddMonitoring').prop('disabled', false);
      }
      else{
        // $('.btnAddMonitoring').prop('disabled', true);
      }
    }

    $('.selFilByFamily, .selFilByProdLineDesc').change(function(){
      if($('.selFilByProdLineDesc').val() != null){
        let data = $('.selFilByProdLineDesc').select2('data');
        monitorningFilter = {
          family: $('.selFilByFamily').val(),
          plDescription: data[0].text,
          plId: data[0].id,
        };
      }
      else{
        monitorningFilter = {
          family: $('.selFilByFamily').val(),
          plDescription: null,
          plId: null,
        };
      }

      localStorage.setItem("monitorningFilter", JSON.stringify(monitorningFilter));
      monitorningFilter = JSON.parse(localStorage.getItem("monitorningFilter"));
    });

    if(monitorningFilter.family != null){
      $('.selFilByFamily').val(monitorningFilter.family);
    }

    if(monitorningFilter.plId != null){
      $('.selFilByProdLineDesc').html('<option value="' + monitorningFilter.plId + '">' + monitorningFilter.plDescription + '</option>').val(monitorningFilter.plId);
    }

    $('select[name="machine_id"]', frmSaveMonitoring).select2({
        // dropdownParent: $('#mdlSaveItemRegistration'),
        placeholder: "",
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
           url: "{{ route('get_cbo_machine_by_stat') }}",
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

    $('select[name="qc_inspector"]', frmSaveMonitoring).select2({
        // dropdownParent: $('#mdlSaveItemRegistration'),
        placeholder: "",
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
           url: "{{ route('get_cbo_user_by_stat') }}",
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

    $('select[name="qc_checked_by"]', frmSaveMonitoring).select2({
        // dropdownParent: $('#mdlSaveItemRegistration'),
        placeholder: "",
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
           url: "{{ route('get_cbo_user_by_stat') }}",
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

    $.fn.dataTable.ext.errMode = 'none';

    dtMonitorings = $("#tblMonitorings").DataTable({
      "processing" : false,
      "serverSide" : true,
      "searching" : false,
    //   "lengthMenu": [ [25, 50, -1], [25, 50, "All"] ],
      "ajax" : {
        url: "{{ route('view_monitorings') }}",
        data: function (param){
            param.status = $(".selFilByStat").val();
            param.product_line_id = $(".selFilByProdLineDesc").val();
            param.shift = $(".selFilByShift").val();
            param.work_week = $(".txtFilByWorkWeek").val();
            param.year = $(".txtFilByYear").val();
        }
      },

      "columns":[
        { "data" : "l_description" },
        { "data" : "work_week" },
        { "data" : "m_date_from" },
        { "data" : "m_date_to" },
        { "data" : "shift" },
        { "data" : "m_description" },
        { "data" : "uqi_name" },
        { "data" : "qcb_name" },
        { "data" : "raw_status" },
        { "data" : "raw_action", orderable:false, searchable:false }
      ],

      "columnDefs": [
        {
          "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
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
    });//end of dtMonitorings

    $(document).on('click', '.btnReload', function(){
      // window.location.reload();
      dtMonitorings.draw();
    });

    $(".selFilByStat").change(function(e){
      dtMonitorings.draw();
    });

    $(".btnAddMonitoring").click(function(e){
      if($('.selFilByProdLineDesc').val() == ""){
        toastr.warning('Please select a description from the filter!');
        return;
      }
      $("#mdlSaveMonitoring").modal('show');
      frmSaveMonitoring[0].reset();
      $(".input-error", frmSaveMonitoring).text('');
      $(".form-control", frmSaveMonitoring).removeClass('is-invalid');
      $("input[name='work_week']", frmSaveMonitoring).prop('readonly', false);
      $('input[name="product_line_id"]', frmSaveMonitoring).val($('.selFilByProdLineDesc').val());
      $('select[name="line_id"]', frmSaveMonitoring).val("").trigger("change");
      $('select[name="line_id"]', frmSaveMonitoring).select2({
          // dropdownParent: $('#mdlSaveItemRegistration'),
          placeholder: "",
          minimumInputLength: 2,
          allowClear: true,
          ajax: {
             url: "{{ route('get_cbo_line_by_product_line') }}",
             type: "get",
             dataType: 'json',
             delay: 250,
             // quietMillis: 100,
             data: function (params) {
              return {
                search: params.term, // search term
                product_line_id: $('input[name="product_line_id"]', frmSaveMonitoring).val(),
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

      $('input[name="monitoring_id"]', frmSaveMonitoring).val('');
      $('select[name="machine_id"]', frmSaveMonitoring).html('').val('').trigger("change");
      $('select[name="qc_inspector"]', frmSaveMonitoring).html('').val('').trigger("change");
      $('select[name="qc_checked_by"]', frmSaveMonitoring).html('').val('').trigger("change");
    });

    $('#mdlSaveMonitoring').on('shown.bs.modal', function (e) {
      $('input[name="description"]', frmSaveMonitoring).focus();
    })

    $("#tblMonitorings").on('click', '.btnActions', function(e){
      let monitoringId = $(this).attr('monitoring-id');
      let action = $(this).attr('action');
      let status = $(this).attr('status');
      let title = '';

      if(action == 1){
        if(status == 2){
          title = 'Archive Monitoring';
        }
        else if(status == 1){
          title = 'Restore Monitoring';
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
              MonitoringAction(monitoringId, action, status);
              cnfrmLoading.open();
            }
          },
          cancel: function () {

          },
        }
      });
    });

    $("#frmSaveMonitoring").submit(function(e){
      e.preventDefault();
      SaveMonitoring();
    });

    $("#tblMonitorings").on('click', '.btnEditMonitoring', function(e){
      let monitoringId = $(this).attr('monitoring-id');
      GetMonitoringById(monitoringId);
    });

    $('input[name="work_week"]', frmSaveMonitoring).on('keyup change', function(){
        let week = parseInt($(this).val());
        let fiscalYearStart = parseInt($('.txtFilByYear').val());

        if (!week || !fiscalYearStart) return;

        let { start, end } = getWeekN(fiscalYearStart, week);

        function format(date) {
            let y = date.getFullYear();
            let m = String(date.getMonth() + 1).padStart(2, '0');
            let d = String(date.getDate()).padStart(2, '0');
            return `${y}-${m}-${d}`;
        }

        $('input[name="date_from"]').val(format(start));
        $('input[name="date_to"]').val(format(end));

        console.log('work week changed', $(this).val());
    //   var currYear = "2023";
    //   var monthofCurrentYear = moment().format("MM")
    //   console.log('month now', monthofCurrentYear);
    //   if(monthofCurrentYear == 1 || monthofCurrentYear == 2 || monthofCurrentYear == 3){
    //     var currYear = moment().format("YYYY") - 1;
    //     console.log('fiscalyear now', currYear);
    //   }else{
    //     var currYear = moment().format("YYYY");
    //     // var currYear = "2024";
    //     console.log('year now', currYear);
    //   }

    //   //Pass in the first of a given calendar month and the day weekday
    //   var dateRange = getFirstWeekDay(currYear + "-04-01", 0, ($(this).val() - 1));
    //   $('input[name="date_from"]', frmSaveMonitoring).val(dateRange.dateFrom);
    //   $('input[name="date_to"]', frmSaveMonitoring).val(dateRange.dateTo);

        // let week = parseInt($(this).val());
        // console.log('week', week);

        // let fiscalYearStart = parseInt($('.txtFilByYear').val());

        // if (!week || !fiscalYearStart) return;

        // let baseDate = new Date(fiscalYearStart, 3, 1);
        // let endLimit = new Date(fiscalYearStart + 1, 2, 31);

        // // compute start
        // let startDate = new Date(
        //     baseDate.getFullYear(),
        //     baseDate.getMonth(),
        //     baseDate.getDate() + (week - 1) * 7
        // );

        // // compute end
        // let endDate = new Date(
        //     startDate.getFullYear(),
        //     startDate.getMonth(),
        //     startDate.getDate() + 6
        // );

        // // Prevent overlap
        // if (endDate > endLimit) {
        //     endDate = endLimit;
        // }

        // function format(date) {
        //     let y = date.getFullYear();
        //     let m = String(date.getMonth() + 1).padStart(2, '0');
        //     let d = String(date.getDate()).padStart(2, '0');
        //     return `${y}-${m}-${d}`;
        // }

        // console.log('start', format(startDate));
        // console.log('end', format(endDate));

        // $('input[name="date_from"]').val(format(startDate));
        // $('input[name="date_to"]').val(format(endDate));
    });

    // function getFirstWeekDay(dateString, dayOfWeek, workWeek) {
    //   var date = moment(dateString, "YYYY-MM-DD");

    //   var day = date.day();
    //   var diffDays = 0;

    //   var dateFrom = "";
    //   var dateTo = "";

    //   if (day > dayOfWeek) {
    //     diffDays = (7 * workWeek) - (day - dayOfWeek);
    //   } else {
    //     diffDays = dayOfWeek - day;
    //   }

    //   var tempDateFrom = date.add(diffDays, 'day');
    //   var dateFrom = tempDateFrom.format("YYYY-MM-DD");
    //   dateTo = tempDateFrom.add(6, 'day').format("YYYY-MM-DD");

    //   return {
    //     dateFrom: dateFrom,
    //     dateTo: dateTo
    //   };
    // }

    // function format(date) {
    //     let y = date.getFullYear();
    //     let m = String(date.getMonth() + 1).padStart(2, '0');
    //     let d = String(date.getDate()).padStart(2, '0');
    //     return `${y}-${m}-${d}`;
    // }

    function getWeek1(fiscalYearStart) {
        let start = new Date(fiscalYearStart, 3, 1); // April 1
        let dayOfWeek = start.getDay(); // 0=Sunday ... 6=Saturday

        let diffToSaturday = 6 - dayOfWeek; // days to Saturday
        let end = new Date(start);
        end.setDate(start.getDate() + diffToSaturday);

        return { start, end };
    }

    function getWeekN(fiscalYearStart, weekNumber) {
        if (weekNumber < 1) return null;

        // Week 1
        let week1 = getWeek1(fiscalYearStart);
        if (weekNumber === 1) return week1;

        // Start from Sunday after week1.end
        let start = new Date(week1.end);
        start.setDate(start.getDate() + 1); // Sunday

        // Loop to week N
        for (let i = 2; i < weekNumber; i++) {
            start.setDate(start.getDate() + 7);
        }

        let end = new Date(start);
        end.setDate(start.getDate() + 6); // Saturday

        // Clamp to fiscal year end (March 31 next year)
        let endLimit = new Date(fiscalYearStart + 1, 2, 31);
        if (end > endLimit) end = endLimit;

        return { start, end };
    }

    function getCurrentFiscalYear() {
        let today = new Date();
        let year = today.getFullYear();
        let month = today.getMonth(); // 0 = Jan

        return (month < 3) ? year - 1 : year;
    }

  });
</script>
@endsection
