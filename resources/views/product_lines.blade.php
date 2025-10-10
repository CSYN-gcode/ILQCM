@extends('layouts.admin_layout')

@section('title', 'Product Lines')

@section('content_page')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fas fa-product_lines"></i> Product Lines</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Product Lines</li>
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
        <div class="col-md-6">
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
                    <button class="btn btn-primary btn-sm btnAddProductLine"><i class="fa fa-plus"></i> Add New</button>
                  </div> <!-- .float-sm-right -->
                  <br><br>

                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="tblProductLines" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>Family</th>
                          <th>Description</th>
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

        <div class="col-md-6">
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

                  <div class="float-sm-left" style="min-width: 200px; display: block; margin-left: 20px;">
                    <div class="form-group row">
                      <div class="col">
                        <div class="input-group input-group-sm mb-3">
                          <div class="input-group-prepend w-20">
                            <span class="input-group-text w-100">Product Line</span>
                          </div>
                          <input type="text" class="form-control txtSelectedProdLineDesc" name="product_line_id" disabled="true" placeholder="No Selected">
                          <input type="text" class="form-control txtSelectedProdLineId" name="product_line_id" disabled="true" placeholder="No Selected" style="display: none;">
                        </div>
                      </div>
                    </div> <!-- .form-group row -->
                  </div> <!-- .float-sm-left -->

                  <div class="float-sm-right">
                    <button class="btn btn-primary btn-sm btnAddLine" disabled="true"><i class="fa fa-plus"></i> Add New</button>
                  </div> <!-- .float-sm-right -->
                  <br><br>

                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="tblLines" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>Description</th>
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
<div class="modal fade" id="mdlSaveProductLine">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-info-circle text-info"></i> Product Line Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="frmSaveProductLine">
        @csrf
        <div class="modal-body">
          <div class="card-body">

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Family</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="product_line_id" placeholder="ProductLine ID" style="display: none;">
                <select class="form-control select2" id="selFamily" name="family"></select>
                  {{-- <option value="1" selected="true">BGA/LGA</option>
                  <option value="2">BGA-FP</option>
                  <option value="3">Probe Pin</option>
                  <option value="4">QF/TSOP/SMPO</option>
                  <option value="5">PPS-CN</option>
                  <option value="6">PPS-TS</option>
                  <option value="7">TC/DC Connectors</option>
                  <option value="8">Card Connectors</option>
                  <option value="9">Flexicon Connectors</option>
                  <option value="10">IC Sockets</option> --}}
                  {{-- 10082025 Added by Nessa, for modification create CRUD module --}}
                {{-- </select> --}}
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="description" placeholder="Description">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSaveProductLine">Save</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- LINE MODALS -->
<div class="modal fade" id="mdlSaveLine">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-info-circle text-info"></i> Line Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="frmSaveLine">
        @csrf
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="line_id" placeholder="Line ID" style="display: none;">
                <input type="text" class="form-control" name="product_line_id" placeholder="Product Line ID" style="display: none;">
                <input type="text" class="form-control" name="description" placeholder="Description">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSaveLine">Save</button>
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
  let dtProductLines, frmSaveProductLine, btnSaveProductLine;
</script>

<script type="text/javascript">
  // Variables
  let dtLines, frmSaveLine, btnSaveLine;
</script>

@endsection

@section('js_content')
<!-- Custom Links -->
<script src="{{ asset('public/scripts/client/ProductLine.js') }}"></script>
<script src="{{ asset('public/scripts/client/Line.js') }}"></script>
<script src="{{ asset('public/scripts/client/Family.js?n=1') }}"></script>


<!-- JS Codes -->
<script type="text/javascript">
  $(document).ready(function () {
    frmSaveProductLine = $("#frmSaveProductLine");
    btnSaveProductLine = $('.btnSaveProductLine');

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

    $(document).on('click','#tblProductLines tbody tr',function(e){
      $(this).closest('tbody').find('tr').removeClass('table-active');
      $(this).closest('tr').addClass('table-active');
    });

    $.fn.dataTable.ext.errMode = 'none';

    dtProductLines = $("#tblProductLines").DataTable({
      "processing" : false,
      "serverSide" : true,
      "ajax" : {
        url: "{{ route('view_product_lines') }}",
        data: function (param){
            param.status = $(".selFilByStat").eq(0).val();
        }
      },

      "columns":[
        { "data" : "raw_family" },
        { "data" : "description" },
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
    });//end of dtProductLines

    $(document).on('click', '.btnReload', function(){
      // window.location.reload();
      dtProductLines.draw();
    });

    $(".selFilByStat").eq(0).change(function(e){
      dtProductLines.draw();
    });

    $(".btnAddProductLine").click(function(e){
      $("#mdlSaveProductLine").modal('show');
      frmSaveProductLine[0].reset();
      $(".input-error", frmSaveProductLine).text('');
      $(".form-control", frmSaveProductLine).removeClass('is-invalid');

      GetFamilyName($("#selFamily"));
    });

    $('#mdlSaveProductLine').on('shown.bs.modal', function (e) {
      $('input[name="description"]', frmSaveProductLine).focus();
    })

    $("#tblProductLines").on('click', '.btnActions', function(e){
      let productLineId = $(this).attr('product-line-id');
      let action = $(this).attr('action');
      let status = $(this).attr('status');
      let title = '';

      if(action == 1){
        if(status == 2){
          title = 'Archive Product Line';
        }
        else if(status == 1){
          title = 'Restore Product Line';
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
              ProductLineAction(productLineId, action, status);
              cnfrmLoading.open();
            }
          },
          cancel: function () {

          },
        }
      });
    });

    $("#frmSaveProductLine").submit(function(e){
        e.preventDefault();
        SaveProductLine();
    });

    $("#tblProductLines").on('click', '.btnEditProductLine', function(e){
      let productLineId = $(this).attr('product-line-id');
      GetProductLineById(productLineId);
    });

    $("#tblProductLines").on('click', '.btnSelectProductLine', function(e){
      let productLineId = $(this).attr('product-line-id');
      let description = $(this).attr('description');
      let family = $(this).attr('family');
      $(".txtSelectedProdLineDesc").val(family + " : " + description);
      $(".txtSelectedProdLineId").val(productLineId);
      $(".btnAddLine").prop("disabled", false);
      dtLines.draw();
    });

  });
</script>

<!-- Lines JS Codes -->
<script type="text/javascript">
  $(document).ready(function () {
    frmSaveLine = $("#frmSaveLine");
    btnSaveLine = $('.btnSaveLine');

    bsCustomFileInput.init();
    //Initialize Select2 Elements
    $('.select2').select2();

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

    $(document).on('click','#tblLines tbody tr',function(e){
      $(this).closest('tbody').find('tr').removeClass('table-active');
      $(this).closest('tr').addClass('table-active');
    });

    $.fn.dataTable.ext.errMode = 'none';

    dtLines = $("#tblLines").DataTable({
      "processing" : false,
      "serverSide" : true,
      "ajax" : {
        url: "{{ route('view_lines') }}",
        data: function (param){
            param.status = $(".selFilByStat").eq(1).val();
            param.product_line_id = $(".txtSelectedProdLineId").val();
        }
      },

      "columns":[
        { "data" : "description" },
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
    });//end of dtLines

    $(document).on('click', '.btnReload', function(){
      // window.location.reload();
      dtLines.draw();
    });

    $(".selFilByStat").eq(1).change(function(e){
      dtLines.draw();
    });

    $(".btnAddLine").click(function(e){
      $("#mdlSaveLine").modal('show');
      frmSaveLine[0].reset();
      $(".input-error", frmSaveLine).text('');
      $(".form-control", frmSaveLine).removeClass('is-invalid');

      $('input[name="product_line_id"]', frmSaveLine).val($(".txtSelectedProdLineId").val());
    });

    $('#mdlSaveLine').on('shown.bs.modal', function (e) {
      $('input[name="description"]', frmSaveLine).focus();
    })

    $("#tblLines").on('click', '.btnActions', function(e){
      let lineId = $(this).attr('line-id');
      let action = $(this).attr('action');
      let status = $(this).attr('status');
      let title = '';

      if(action == 1){
        if(status == 2){
          title = 'Archive Line';
        }
        else if(status == 1){
          title = 'Restore Line';
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
              LineAction(lineId, action, status);
              cnfrmLoading.open();
            }
          },
          cancel: function () {

          },
        }
      });
    });

    $("#frmSaveLine").submit(function(e){
      e.preventDefault();
      SaveLine();
    });

    $("#tblLines").on('click', '.btnEditLine', function(e){
      let lineId = $(this).attr('line-id');
      GetLineById(lineId);
    });

  });
</script>
@endsection
