@extends('layouts.admin_layout')

@section('title', 'Monitoring')

@section('content_page')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-10">
          <center><h1 style="text-decoration: underline;"><i class="fas fa-monitorings"></i>In-Line Quality Control Monitoring </h1></center>
        </div>
        <div class="col-sm-2">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Monitoring</li>
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
          <div class="float-sm-right">
            <!-- <button class="btn btn-success btn-sm btnLoadRecordModal"><i class="fa fa-sync"></i> Load Record</button> -->
          </div> <!-- .float-sm-right -->
          <br><br>
          <!-- general form elements -->
          <div class="card card-primary">
            <!-- Start Page Content -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <form class="form-horizontal" id="frmSaveMonitoring">
                    @csrf
                      <div class="row">

                        <div class="col-sm-2">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="float: right !important;">LINE :</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="monitoring_id" placeholder="Monitoring ID" style="display: none;">
                              <input type="text" class="form-control" name="line_id" placeholder="">
                              <span class="text-danger float-sm-right input-error"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label" style="float: right !important;">WORK WEEK :</label>
                            <div class="col-sm-6">
                              <input type="number" class="form-control" name="line_id" placeholder="">
                              <span class="text-danger float-sm-right input-error"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label" style="float: right !important;">SHIFT :</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="line_id" placeholder="">
                              <span class="text-danger float-sm-right input-error"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label" style="float: right !important;">QC INSPECTOR :</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="line_id" placeholder="">
                              <span class="text-danger float-sm-right input-error"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label" style="float: right !important;">CHECKED BY :</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="line_id" placeholder="">
                              <span class="text-danger float-sm-right input-error"></span>
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="row">
                        <div class="col-sm-2">
                          <div class="form-group row">
                            <label class="col-sm-5 col-form-label" style="float: right !important;">MACHINE :</label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control" name="machine_id" placeholder="N/A">
                              <span class="text-danger float-sm-right input-error"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                  </form>

                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="tblMonitorings" style="width: 100%;">
                      <thead>
                        <tr>
                          <th style="width: 23%; text-align: center; vertical-align: middle;">In-line QC Sampling Activity - Product Conformance</th>
                          <th style="width: 46%; text-align: center; vertical-align: middle;">Monitoring Frequency / Sample Size</th>
                          <th style="width: 31%; text-align: center; vertical-align: middle;">Validation Activity</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="width: 23%; padding-top: 20px; padding-bottom: 20px; vertical-align: middle;">
                            <span>1. Checking of operators activity in conformance to required references such as Work Instruction, Point Panel and others</span>
                            <br>
                            <span>2. Checking of operators output in conformance  to product criteria.</span>
                          </td>
                          <td style="width: 46%; padding-top: 20px; padding-bottom: 20px; vertical-align: middle;">
                            <span><b>1. New Operators (from 1st day to 3 months):</span></b><br>
                              <div style="padding-left: 20px; width: 100%;">
                                <span style="">1.1 Hourly for a period of 1 week (starting 8:30 onwards) </span><br>
                                <span style="">1.2 Every 2 hours for a period of 3 weeks (Frequency: 9:30, 11:30, 13:30, 15:30; If OT: 17:30 & 19:30)</span><br>
                                <span style="">1.3 Every 3 hours for a period of 2 to 3 months  (Frequency: 9:30, 12:30, 15:30; If OT: 18:30)</span><br>
                              </div>
                            <span><b>2. Old Operators:</b> 2X per shift and additional of 1 monitoring if the line is on overtime schedule on the defined stations (Frequency: 9:30, 13:30 & 17:30).</span><br>
                            <span><b>3. Re-certified Operators from disqualification and transferred operators:</b> 2X per shift and additional of 1 monitoring if the line is on overtime schedule on all stations (Frequency: 9:30, 13:30 & 17:30).</span><br>
                            <span><b>4. Sample size:</b> 1 pc (minimum) ; 10 pcs (maximum) - less than 10 samples drawn is due to per station output or capacity</span>         
                          </td>
                          <td style="width: 31%; padding-top: 20px; padding-bottom: 20px; vertical-align: middle;">
                            <span>1. <b>Daily:</b> QC Supervisor to check the monitoring data for its completeness and correctness then indicate ""OK"" on the slot provided to signify that checking is performed, then ""lock"" the sheet. Call the attention of concerned QC once inconsistency is found.</span>
                            <br><br>
                            <span>2. <b>Weekly:</b> QC Supervisor to check the completeness of data for the whole workweek. Affix her/his E-signature on the slot provided to signify the checking performed &  ""lock"" the whole sheet and save the file.</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div> <!-- .table-responsive -->
                 
                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="tblProductSamplings" style="width: 100%;">
                      <thead>
                        <tr>
                          <th colspan="12" style="text-align: center; vertical-align: middle; background-color: #9f9f9f; border-bottom: 1.8px solid black;">PRODUCT SAMPLING</th>
                        </tr>
                        <tr>
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
                          <th style="text-align: center; vertical-align: middle;">Validation Result<br>(QC Supervisor)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td style="text-align: center; vertical-align: middle;">1/3/2022</td>
                          <td style="text-align: center; vertical-align: middle;">9:30  </td>
                          <td style="text-align: center; vertical-align: middle;">ANNA</td>
                          <td style="text-align: center; vertical-align: middle;">FINAL VISUAL</td>
                          <td style="text-align: center; vertical-align: middle;">450229625900010/TCBGA-2565-0.50-5-BASE</td>
                          <td style="text-align: center; vertical-align: middle;">5</td>
                          <td style="text-align: center; vertical-align: middle;">5</td>
                          <td style="text-align: center; vertical-align: middle;">0</td>
                          <td style="text-align: center; vertical-align: middle;">NDF</td>
                          <td style="text-align: center; vertical-align: middle;">0</td>
                          <td style="text-align: center; vertical-align: middle;">PASSED</td>
                          <td style="text-align: center; vertical-align: middle;">OK</td>
                        </tr>
                      </tbody>
                    </table>
                  </div> <!-- .table-responsive -->

                </div> <!-- .col-sm-12 -->
              </div> <!-- .row -->

              <hr style="border: 0.1px solid black;">

              <div class="row">
                <div class="col-sm-10">
                  <center>
                    <div class="table-responsive">
                      <table class="table table-sm table-bordered table-hover" style="width: 90%;">
                        <thead>
                          <tr>
                            <th style="text-align: center; vertical-align: middle; width: 65%">In-line QC Sampling Activity - Worker's Conformance to SOP & Prod'n Requirements</th>
                            <th style="text-align: center; vertical-align: middle; width: 35%">Monitoring Frequency</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="width: 65%; padding-top: 10px; padding-bottom: 10px; vertical-align: middle;">
                              <span>1. Checking of production line conformance to required company and production SOPs.</span><br>
                              <span>2. Checking of material status and condition during production run.</span><br>
                              <span>3. Checking of machine, tools and jigs condition for continua; usage in production.</span><br>
                              <span>4. Checking of availability of required references such as Work Instruction, Point Panel, etc.</span><br>
                              <span>5. Checking of the workplace  in regards to 7S implementation.</span><br>
                            </td>
                            <td style="width: 35%; padding-top: 10px; padding-bottom: 10px; vertical-align: middle;">
                              <span>1. Man - once per shift.</span><br>
                              <span>2. Material - once per shift.</span><br>
                              <span>3. Machine -once per shift.</span><br>
                              <span>4. Method - once per shift.</span><br>
                              <span>5. Workplace - once per shift.</span><br>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </center>
                </div> <!-- .col-sm-12 -->

                <div class="col-sm-2">
                  <br><br>
                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" style="width: 90%;">
                      <thead>
                        <th>
                          <span>LEGEND</span>:<br>
                          <span>/ YES</span><br>
                          <span>X NO</span><br>
                        </th>
                      </thead>
                    </table>
                  </div>
                </div> <!-- .col-sm-12 -->                  
              </div> <!-- .row -->

              <div class="row">
                <div class="col-sm-12">
                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="tblDailyLineAudit" style="width: 100%;">
                      <thead>
                        <tr>
                          <th colspan="16" style="text-align: left; vertical-align: middle; background-color: #9f9f9f; border-bottom: 1.8px solid black;">DAILY LINE AUDIT</th>
                        </tr>
                        <tr>
                          <th rowspan="2" style="text-align: center; vertical-align: middle; width: 10%">Category</th>
                          <th rowspan="2" style="text-align: center; vertical-align: middle; width: 34%">CHECK ITEMS</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: 05/01/2021</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: 05/01/2021</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: 05/01/2021</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: 05/01/2021</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: 05/01/2021</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: 05/01/2021</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: 05/01/2021</th>
                        </tr>
                        <tr>
                          <th style="text-align: center; vertical-align: middle; width: 4%">Yes</th>
                          <th style="text-align: center; vertical-align: middle; width: 4%">No</th>
                          <th style="text-align: center; vertical-align: middle; width: 4%">Yes</th>
                          <th style="text-align: center; vertical-align: middle; width: 4%">No</th>
                          <th style="text-align: center; vertical-align: middle; width: 4%">Yes</th>
                          <th style="text-align: center; vertical-align: middle; width: 4%">No</th>
                          <th style="text-align: center; vertical-align: middle; width: 4%">Yes</th>
                          <th style="text-align: center; vertical-align: middle; width: 4%">No</th>
                          <th style="text-align: center; vertical-align: middle; width: 4%">Yes</th>
                          <th style="text-align: center; vertical-align: middle; width: 4%">No</th>
                          <th style="text-align: center; vertical-align: middle; width: 4%">Yes</th>
                          <th style="text-align: center; vertical-align: middle; width: 4%">No</th>
                          <th style="text-align: center; vertical-align: middle; width: 4%">Yes</th>
                          <th style="text-align: center; vertical-align: middle; width: 4%">No</th>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 10%">Man</td>
                          <td style="text-align: left; vertical-align: middle; width: 34%">1. Are all operators certified on their stations?</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">/</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">X</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">/</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">X</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">/</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">X</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">/</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">X</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">/</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">X</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">/</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">X</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">/</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%">X</td>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div> <!-- .table-responsive -->
                </div>
              </div>

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
<div class="modal fade" id="mdlLoadRecord">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-sync text-success"></i> Load Record</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" id="frmLoadRecord">
        @csrf
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Line</label>
              <div class="col-sm-10">
                <select class="form-control select2bs4 selLine" name="line_id" style="width: 100%;">
                    <!-- Code generated -->
                </select>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Work Week</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="work_week" placeholder="" min="1">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btnLoadRecord">Load</button>
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
  let dtMonitorings, frmSaveMonitoring, btnSaveMonitoring, frmLoadRecord, btnLoadRecord;
</script>

@endsection

@section('js_content')
<!-- Custom Links -->
<script src="{{ asset('public/scripts/client/Monitoring.js') }}"></script>

<!-- JS Codes -->
<script type="text/javascript">
  $(document).ready(function () {
    frmSaveMonitoring = $("#frmSaveMonitoring");
    btnSaveMonitoring = $('.btnSaveMonitoring');

    frmLoadRecord = $("#frmLoadRecord");
    btnLoadRecord = $('.btnLoadRecord');

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

    $('select[name="line_id"]', frmLoadRecord).select2({
        placeholder: "",
        minimumInputLength: 2,
        allowClear: true,
        ajax: {
           url: "{{ route('get_cbo_line_by_stat') }}",
           type: "get",
           dataType: 'json',
           delay: 250,
           // quietMillis: 100,
           data: function (params) {
            return {
              search: params.term // search term
              // status: cboDeviceStat // search status
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


    $(document).on('click','#tblMonitorings tbody tr',function(e){
      $(this).closest('tbody').find('tr').removeClass('table-active');
      $(this).closest('tr').addClass('table-active');
    });

    $.fn.dataTable.ext.errMode = 'none';

    $(document).on('click', '.btnReload', function(){
      // window.location.reload();
      dtMonitorings.draw();
    });

    $(".selFilByStat").change(function(e){
      dtMonitorings.draw();
    });

    $(".btnAddMonitoring").click(function(e){
      $("#mdlSaveMonitoring").modal('show');
      frmSaveMonitoring[0].reset();
      $(".input-error", frmSaveMonitoring).text('');
      $(".form-control", frmSaveMonitoring).removeClass('is-invalid');
    });

    $(".btnLoadRecordModal").click(function(e){
      $("#mdlLoadRecord").modal('show');
      frmLoadRecord[0].reset();
      $(".input-error", frmLoadRecord).text('');
      $(".form-control", frmLoadRecord).removeClass('is-invalid');
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

    $("#frmLoadRecord").submit(function(e){
      e.preventDefault();
      LoadMonitoring();
    });

  });
</script>
@endsection