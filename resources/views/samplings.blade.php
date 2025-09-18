@extends('layouts.admin_layout')

@section('title', 'Samplings')

@section('content_page')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fas fa-samplings"></i> Samplings</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Samplings</li>
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
                    <button class="btn btn-primary btn-sm btnAddSampling"><i class="fa fa-plus"></i> Add New</button>
                  </div> <!-- .float-sm-right -->
                  <br><br>

                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="tblSamplings" style="width: 100%;">
                      <thead>
                        <tr>
                          <th colspan="15" style="text-align: center; vertical-align: middle; background-color: #9f9f9f; border-bottom: 1.8px solid black;">PRODUCT SAMPLING</th>
                        </tr>
                        <tr>
                          <th style="text-align: center; vertical-align: middle;">Created at</th>
                          <th style="text-align: center; vertical-align: middle;">Date</th>
                          <th style="text-align: center; vertical-align: middle;">Time</th>
                          <th style="text-align: center; vertical-align: middle;">OPTR. Name</th>
                          <th style="text-align: center; vertical-align: middle;">STATION</th>
                          <th style="text-align: center; vertical-align: middle;">P.O NO. / Series</th>
                          <th style="text-align: center; vertical-align: middle;">Sample Size </th>
                          <th style="text-align: center; vertical-align: middle;">ACCEPT</th>
                          <th style="text-align: center; vertical-align: middle;">REJECT</th>
                          <th style="text-align: center; vertical-align: middle;">RESULT</th>
                          <th style="text-align: center; vertical-align: middle;">DPPM</th>
                          <th style="text-align: center; vertical-align: middle;">Remarks </th>
                          <th style="text-align: center; vertical-align: middle;">QC Inspector</th>
                          <th style="text-align: center; vertical-align: middle;">Validation Result<br>(QC Supervisor)</th>
                          <th style="text-align: center; vertical-align: middle;">Status</th>
                          <th style="text-align: center; vertical-align: middle;">Action</th>
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
<div class="modal fade" id="mdlSaveSampling">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-info-circle text-info"></i> Sampling Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="frmSaveSampling">
        @csrf
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Station</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="monitoring_id" placeholder="Monitoring ID" style="display: none;">
                <input type="text" class="form-control" name="sampling_id" placeholder="Sampling ID" style="display: none;">
                <input type="text" class="form-control" name="monitoring_id" placeholder="Monitoring ID" style="display: none;">
                <select class="form-control select2 select2bs4" name="station_id" placeholder="Station">
                </select>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Operator Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="operator" placeholder="User ID" readonly="true" style="display: none;">
                    <div class="input-group">
                        <input type="text" class="form-control" name="operator_name" placeholder="(Click the button to fill-in)" readonly="true">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary btnScanOperator" title="Click to scan operator."><i class="fa fa-qrcode"></i></button>
                        </div>
                    </div>

                    <span class="text-danger float-sm-right input-error"></span>
                </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label">P.O. No.</label>
              <div class="col-sm-8">
                <div class="input-group">
                  <input type="text" class="form-control" name="po_no" readonly="" placeholder="(Click the button to fill-in)">
                  <div class="input-group-append">
                    <button type="button" class="btn btn-primary btnSearchPoNo" title="Click to type P.O. No."><i class="fa fa-search"></i></button>
                  </div>
                </div>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Series</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="series" placeholder="(Auto Fill-in)" readonly="">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Sample Size</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" name="sample_size" placeholder="Sample Size" value="0">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label">ACCEPT</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" name="accept" placeholder="ACCEPT" readonly="true" value="0">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label">REJECT</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" name="reject" placeholder="REJECT" value="0">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label">RESULT</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="result" placeholder="RESULT">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label">DPPM</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" name="dppm" placeholder="DPPM" readonly="true" value="0">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Remarks</label>
                <div class="col-sm-8">
                    <textarea class="form-control" name="remarks" placeholder="Remarks" rows="4"></textarea>
                    <span class="text-danger float-sm-right input-error"></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Inspector Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="qc_inspector" placeholder="User ID" readonly="true" style="display: none;">
                    <div class="input-group">
                        <input type="text" class="form-control" name="qc_inspector_name" placeholder="(Click the button to fill-in)" readonly="true">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary btnScanQcInspector" title="Click to scan operator."><i class="fa fa-qrcode"></i></button>
                        </div>
                    </div>
                    <span class="text-danger float-sm-right input-error"></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Validation Result<br>(QC Supervisor)</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="validation_result" placeholder="Validation Result">
                        <option value="" selected="true">--</option>
                        <option value="1">OK</option>
                        <option value="0">NG</option>
                        </select>
                        <span class="text-danger float-sm-right input-error"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSaveSampling">Save</button>
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
  let dtSamplings, frmSaveSampling, btnSaveSampling;
</script>

@endsection

@section('js_content')
<!-- Custom Links -->
<script src="{{ asset('public/scripts/client/Sampling.js') }}"></script>

<!-- JS Codes -->
<script type="text/javascript">
  $(document).ready(function () {
    frmSaveSampling = $("#frmSaveSampling");
    btnSaveSampling = $('.btnSaveSampling');

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

    $(document).on('click','#tblSamplings tbody tr',function(e){
      $(this).closest('tbody').find('tr').removeClass('table-active');
      $(this).closest('tr').addClass('table-active');
    });

    $.fn.dataTable.ext.errMode = 'none';

    dtSamplings = $("#tblSamplings").DataTable({
      "processing" : false,
      "serverSide" : true,
      "ajax" : {
        url: "{{ route('view_samplings') }}",
        data: function (param){
            param.status = $(".selFilByStat").val();
        }
      },

      "columns":[
        { "data" : "created_at", visible: false, orderable: false },
        { "data" : "raw_date", orderable: false },
        { "data" : "raw_time", orderable: false },
        { "data" : "operator_name", orderable: false },
        { "data" : "s_description", orderable: false },
        { "data" : "raw_po_no_series", orderable: false },
        { "data" : "sample_size", orderable: false },
        { "data" : "accept", orderable: false },
        { "data" : "reject", orderable: false },
        { "data" : "result", orderable: false },
        { "data" : "dppm", orderable: false },
        { "data" : "remarks", orderable: false },
        { "data" : "raw_validation_result", orderable: false },
        { "data" : "raw_status", orderable: false, searchable: false },
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
    });//end of dtSamplings

    $(document).on('click', '.btnReload', function(){
      // window.location.reload();
      dtSamplings.draw();
    });

    $(".selFilByStat").change(function(e){
      dtSamplings.draw();
    });

    $('select[name="station_id"]', frmSaveSampling).select2({
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

    $(".btnAddSampling").click(function(e){
        $("#mdlSaveSampling").modal('show');
        frmSaveSampling[0].reset();
        $(".input-error", frmSaveSampling).text('');
        $(".form-control", frmSaveSampling).removeClass('is-invalid');
        $('select[name="station_id"]', frmSaveSampling).val("").trigger("change");
    });

    $('#mdlSaveSampling').on('shown.bs.modal', function (e) {
      $('input[name="description"]', frmSaveSampling).focus();
    })

    $("#tblSamplings").on('click', '.btnActions', function(e){
      let samplingId = $(this).attr('sampling-id');
      let action = $(this).attr('action');
      let status = $(this).attr('status');
      let title = '';

      if(action == 1){
        if(status == 2){
          title = 'Archive Sampling';
        }
        else if(status == 1){
          title = 'Restore Sampling';
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
              SamplingAction(samplingId, action, status);
              cnfrmLoading.open();
            }
          },
          cancel: function () {

          },
        }
      });
    });

    $("#frmSaveSampling").submit(function(e){
      e.preventDefault();
      SaveSampling();
    });

    $("#tblSamplings").on('click', '.btnEditSampling', function(e){
      let samplingId = $(this).attr('sampling-id');
      GetSamplingById(samplingId);
    });

    $(".btnSearchPoNo").click(function(){
        $.confirm({
            title: 'Search P.O. No.',
            content: '' +
            '<form class="formSearchPoNo">' +
                '<div class="form-group">' +
                    '<label>Enter P.O. No.</label>' +
                    '<input type="text" placeholder="P.O. No." class="po_no form-control" onclick="this.focus()" required>' +
                '</div>' +
            '</form>',
            buttons: {
                formSubmit: {
                    text: 'Search',
                    btnClass: 'btn-blue',
                    action: function () {
                        var po_no = this.content.find('.po_no').val();
                        if(!po_no){
                            toastr.warning('Invalid P.O. No.');
                            return false;
                        }
                        GetPODetails(po_no);
                    }
                },
                cancel: function () {
                    //close
                },
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    });

    var cnfrmScanOperator = $.confirm({
        lazyOpen: true,
        title: '',
        content: '' +
        '<form class="formScanOperator">' +
        '<center><h4>Scan Employee ID</h4>' +
        '<input type="text" placeholder="Employee ID" class="scanned_employee_id form-control" required style="opacity: 0;">' +
        '<i style="font-size: 150px;" class="fa fa-qrcode"></i></center>' +
        '<div class="form-group">' +
        '</div>' +
        '</form>',
        buttons: {
            cancel: function () {
            },
        },
        onContentReady: function () {
          // bind to events
          var jc = this;
          this.$content.find('form').on('submit', function (e) {
              // if the user submits the form by pressing enter in the field.
              e.preventDefault();
              var scanned_employee_id = $('.scanned_employee_id').val();
              if(!scanned_employee_id){
                  toastr.warning('Employee ID is required.');
                  return false;
              }
              GetOperatorDetails(scanned_employee_id, $('select[name="station_id"]', frmSaveSampling).val(), 'operator');
              cnfrmScanOperator.close();
              return false;
              //jc.$$formSubmit.trigger('click'); // reference the button and click it
          });
      }
    });

    $(".btnScanOperator").click(function(){
      cnfrmScanOperator.open();
    });

    $(document).on('keypress',function(e){
      if(cnfrmScanOperator.isOpen()){
        $('.scanned_employee_id').focus();
      }
    });

    $('select[name="station_id"]', frmSaveSampling).on("change", function(){
      $('input[name="operator"]', frmSaveSampling).val("");
      $('input[name="operator_name"]', frmSaveSampling).val("");
    });

    $('input[name="sample_size"]', frmSaveSampling).on("keyup change", function(){
      var accept = parseFloat($(this).val()) - parseFloat($('input[name="reject"]', frmSaveSampling).val());
      if(!isNaN(accept)){
        $('input[name="accept"]', frmSaveSampling).val(accept);

        var dppm = (parseFloat($('input[name="reject"]', frmSaveSampling).val()) / parseFloat($('input[name="accept"]', frmSaveSampling).val())) * 1000000;
        if(!isNaN(dppm) && isFinite(dppm)){
          $('input[name="dppm"]', frmSaveSampling).val(dppm.toFixed(2));
        }
        else{
          $('input[name="dppm"]', frmSaveSampling).val(0);
        }
      }
      else{
        $('input[name="accept"]', frmSaveSampling).val(0);
      }

    });

    $('input[name="reject"]', frmSaveSampling).on("keyup change", function(){
      var accept = parseFloat($('input[name="sample_size"]', frmSaveSampling).val()) - parseFloat($(this).val());
      if(!isNaN(accept)){
        $('input[name="accept"]', frmSaveSampling).val(accept);

        var dppm = (parseFloat($('input[name="reject"]', frmSaveSampling).val()) / parseFloat($('input[name="accept"]', frmSaveSampling).val())) * 1000000;
        if(!isNaN(dppm) && isFinite(dppm)){
          $('input[name="dppm"]', frmSaveSampling).val(dppm.toFixed(2));
        }
        else{
          $('input[name="dppm"]', frmSaveSampling).val(0);
        }
      }
      else{
        $('input[name="accept"]', frmSaveSampling).val(0);
      }

    });

  });
</script>
@endsection
