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
                        @php
                          $family = "";

                          if($monitoring_info['family'] == 1){
                            $family = "BGA/LGA";
                          }
                          else if($monitoring_info['family'] == 2){
                            $family = "BGA-FP";
                          }
                          else if($monitoring_info['family'] == 3){
                            $family = "Probe Pin";
                          }
                          else if($monitoring_info['family'] == 4){
                            $family = "QF/TSOP/SMPO";
                          }
                        @endphp
                        <div class="col-sm-3" style="display: none;">
                          <div class="form-group row" style="padding: 0px 5px;">
                            <div class="input-group input-group mb-3">
                              <div class="input-group-prepend w-20">
                                <span class="input-group-text w-100"><b>FAMILY: </b></span>
                              </div>
                              <input type="text" class="form-control" name="line_id" placeholder="" value="{{ $family }}" readonly="true">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-3" style="display: none;">
                          <div class="form-group row" style="padding: 0px 5px;">
                            <div class="input-group input-group mb-3">
                              <div class="input-group-prepend w-20">
                                <span class="input-group-text w-100"><b>PRODUCT LINE: </b></span>
                              </div>
                              <input type="text" class="form-control" name="line_id" placeholder="" value="{{ $monitoring_info['pl_description'] }}" readonly="true">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group row" style="padding: 0px 5px;">
                            <div class="input-group input-group mb-3">
                              <div class="input-group-prepend w-20">
                                <span class="input-group-text w-100"><b>LINE: </b></span>
                              </div>
                              <input type="text" class="form-control" name="line_id" placeholder="" value="{{ $monitoring_info['l_description'] }}" readonly="true">
                              <input type="text" class="form-control txtHeaderMonitoringId" name="monitoring_id" placeholder="" value="{{ $monitoring_info['m_id'] }}" readonly="true" style="display: none;">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group row" style="padding: 0px 5px;">
                            <div class="input-group input-group mb-3">
                              <div class="input-group-prepend w-20">
                                <span class="input-group-text w-100"><b>WORK WEEK: </b></span>
                              </div>
                              <input type="text" class="form-control" name="work_week" placeholder="" value="{{ $monitoring_info['work_week'] }}" readonly="true">
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="row">

                        <div class="col-sm-2">
                          <div class="form-group row" style="padding: 0px 5px;">
                            <div class="input-group input-group mb-3">
                              <div class="input-group-prepend w-20">
                                <span class="input-group-text w-100"><b>DATE FROM: </b></span>
                              </div>
                              <input type="text" class="form-control txtHeaderDateFrom" name="date_from" placeholder="" value="{{ $monitoring_info['m_date_from'] }}" readonly="true">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group row" style="padding: 0px 5px;">
                            <div class="input-group input-group mb-3">
                              <div class="input-group-prepend w-20">
                                <span class="input-group-text w-100"><b>DATE TO: </b></span>
                              </div>
                              <input type="text" class="form-control txtHeaderDateTo" name="date_to" placeholder="" value="{{ $monitoring_info['m_date_to'] }}" readonly="true">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group row" style="padding: 0px 5px;">
                            <div class="input-group input-group mb-3">
                              <div class="input-group-prepend w-20">
                                <span class="input-group-text w-100"><b>SHIFT: </b></span>
                              </div>
                              <input type="text" class="form-control" name="shift" placeholder="" value="{{ $monitoring_info['shift'] }}" readonly="true">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group row" style="padding: 0px 5px;">
                            <div class="input-group input-group mb-3">
                              <div class="input-group-prepend w-20">
                                <span class="input-group-text w-100"><b>QC INSPECTOR: </b></span>
                              </div>
                              <input type="text" class="form-control" name="qc_inspector" placeholder="" value="{{ $monitoring_info['uqi_name'] }}" readonly="true">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group row" style="padding: 0px 5px;">
                            <div class="input-group input-group mb-3">
                              <div class="input-group-prepend w-20">
                                <span class="input-group-text w-100"><b>CHECKED BY: </b></span>
                              </div>
                              <input type="text" class="form-control" name="qc_checked_by" placeholder="Supervisor's name" value="{{ $monitoring_info['qcb_name'] }}" readonly="true">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group row" style="padding: 0px 5px;">
                            <div class="input-group input-group mb-3">
                              <div class="input-group-prepend w-20">
                                <span class="input-group-text w-100"><b>MACHINE: </b></span>
                              </div>
                              <input type="text" class="form-control" name="machine_id" placeholder="" value="{{ $monitoring_info['m_description'] }}" readonly="true">
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
                                <span style="">1.1 Every 2 hours (6X) for a period of 1 week (Frequency: starts 9:30, 11:30, 13:30, 14:30 or 2 hours after the 1st output certification; If OT: 17:30 & 18:30) </span><br>
                                <span style="">1.2 Every 3 hours (4X) for a period of 3 weeks (Frequency: 9:30, 12:30, 14:30; If OT: 18:30)</span><br>
                                <span style="">1.3 Every 4 hours (3X) for a period of 2 to 3 months  (Frequency: 11:30, 14:30; If OT: 18:30)</span><br>
                              </div>
                            <span><b>2. Old Operators:</b> 2X per shift and additional of 1 monitoring if the line is on overtime schedule on the defined stations (Frequency: 9:30, 13:30 & 17:30). For YF: 1X monitoring per shift and 1X monitoring if the line is on overtime schedule  (Frequency: 11:00 & 16:00).</span><br>
                            <span><b>3. Re-certified Operators from disqualification and transferred operators:</b> 2X per shift and additional of 1 monitoring if the line is on overtime schedule on all stations (Frequency: 9:30, 13:30 & 17:30). For YF: 1X monitoring per shift and 1X monitoring if the line is on overtime schedule  (Frequency: 11:00 & 16:00).</span><br>
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

                  @php
                    $display = 'block';
                  @endphp
                  <div class="float-sm-left" style="min-width: 200px; display: {{ $display }}">
                    <div class="form-group row">
                      <div class="col">
                        <div class="input-group input-group-sm ">
                          <div class="input-group-prepend w-20">
                            <span class="input-group-text w-100">Status</span>
                          </div>
                          <select class="form-control form-control-sm selFilSamplingByStat" name="status">
                            <option value="1" selected="true">Active</option>
                            <option value="2">Archived</option>
                          </select>
                        </div>
                      </div>
                    </div> <!-- .form-group row -->
                  </div> <!-- .float-sm-left -->

                  <div class="float-sm-right">
                      <button class="btn btn-primary btn-sm btnAddSampling"><i class="fa fa-plus"></i> Add Sampling</button>
                  </div> <!-- .float-sm-right -->
                  <br><br>

                    {{-- CLARK --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="monitoringPending-tab" data-toggle="tab" href="#monitoringPending" role="tab" aria-controls="monitoringPending" aria-selected="true">PENDING</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="monitoringOk-tab" data-toggle="tab" href="#monitoringOk" role="tab" aria-controls="monitoringOk" aria-selected="false">OK</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="monitoringNg-tab" data-toggle="tab" href="#monitoringNg" role="tab" aria-controls="monitoringNg" aria-selected="false">NG</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="monitoringNoProdNoMonitoring-tab" data-toggle="tab" href="#monitoringNoProdNoMonitoring" role="tab" aria-controls="monitoringNoProdNoMonitoring" aria-selected="false">NO PROD/NO MONITORING</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane show active" id="monitoringPending" role="tabpanel" aria-labelledby="monitoringPending-tab">
                            <span>
                                <h5 class="mt-3 ml-2">(Pending) For QC Supervisor Checking</h5>
                                <br>
                                <div class="divMultipleResult d-none">
                                    <button class="btn btn-primary btn-sm btnAddMultipleSamplingResult"><i class="fa fa-plus"></i> Select Multiple Validation Result</button>
                                </div>
                            </span>
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-hover" id="tblSamplings_Pending" style="width: 100%;">
                                  <thead>
                                    <tr>
                                      <th colspan="16" style="text-align: center; vertical-align: middle; background-color: #9f9f9f; border-bottom: 1.8px solid black;">PRODUCT SAMPLING</th>
                                    </tr>
                                    <tr>
                                      <th style="text-align: center; vertical-align: middle;">Created at</th>
                                      <th style="text-align: center; vertical-align: middle;">Select</th>
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
                        </div>

                        <div class="tab-pane fade" id="monitoringOk" role="tabpanel" aria-labelledby="monitoringOk-tab">
                            {{-- <span>
                                <h5 class="mt-3 ml-2">(OK) Done by QC Supervisor</h5>
                                <br>
                                <div class="divMultipleResultOK d-none">
                                    <button class="btn btn-primary btn-sm btnAddMultipleSamplingResult"><i class="fa fa-plus"></i> Submit Multiple Selection</button>
                                </div>
                            </span>
                            <br><br> --}}
                            <h5 class="mt-3 ml-2">(OK) Done by QC Supervisor</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-hover" id="tblSamplings_Ok" style="width: 100%;">
                                  <thead>
                                    <tr>
                                      <th colspan="16" style="text-align: center; vertical-align: middle; background-color: #9f9f9f; border-bottom: 1.8px solid black;">PRODUCT SAMPLING</th>
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
                        </div>

                        <div class="tab-pane fade" id="monitoringNg" role="tabpanel" aria-labelledby="monitoringNg-tab">
                            <h5 class="mt-3 ml-2">(NG) Done by QC Supervisor</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-hover" id="tblSamplings_Ng" style="width: 100%;">
                                  <thead>
                                    <tr>
                                      <th colspan="16" style="text-align: center; vertical-align: middle; background-color: #9f9f9f; border-bottom: 1.8px solid black;">PRODUCT SAMPLING</th>
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
                        </div>

                        <div class="tab-pane fade" id="monitoringNoProdNoMonitoring" role="tabpanel" aria-labelledby="monitoringNoProdNoMonitoring-tab">
                            <h5 class="mt-3 ml-2">(NG) Done by QC Supervisor</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-hover" id="tblSamplings_NoProdNoMonitoring" style="width: 100%;">
                                  <thead>
                                    <tr>
                                      <th colspan="16" style="text-align: center; vertical-align: middle; background-color: #9f9f9f; border-bottom: 1.8px solid black;">PRODUCT SAMPLING</th>
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
                        </div>
                    </div>
                    {{-- CLARK --}}

                  {{-- <div class="table-responsive">
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
                          <th style="text-align: center; vertical-align: middle;">Validation Result<br>(QC Supervisor)</th>
                          <th style="text-align: center; vertical-align: middle;">Status</th>
                          <th style="text-align: center; vertical-align: middle;">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div> <!-- .table-responsive --> --}}

                </div> <!-- .col-sm-12 -->
              </div> <!-- .row -->

              {{-- end clark edit --}}

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
                  {{-- <br><br> --}}
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

                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" style="width: 100%;">
                      <thead>
                        <td>
                          <span><b>Notes: to Enable "Save Button"</b></span><br>
                          <p>Check all the checkmarks for selected day/s</p>
                          <p>Fill-up corrective action when there is a checked <b>"NO"</b> for selected day/s</p>
                        </td>
                      </thead>
                    </table>
                  </div>
                </div> <!-- .col-sm-12 -->

              <div class="row">
                <div class="col-sm-12">
                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" id="tblDailyLineAudit" style="width: 100%;">
                      <thead>
                        <tr>
                          <th colspan="16" style="text-align: left; vertical-align: middle; background-color: #9f9f9f; border-bottom: 1.8px solid black;">DAILY LINE AUDIT <button class="btn btn-success btn-sm btnSaveDLA" data-alert="0" style="float: right;"><i class="fa fa-check"></i> Save</button></th>
                        </tr>
                        <tr>
                          <th rowspan="2" style="text-align: center; vertical-align: middle; width: 10%">CATEGORY</th>
                          <th rowspan="2" style="text-align: center; vertical-align: middle; width: 34%">CHECK ITEMS</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: <span class="spanDateRange"></span></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: <span class="spanDateRange"></span></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: <span class="spanDateRange"></span></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: <span class="spanDateRange"></span></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: <span class="spanDateRange"></span></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: <span class="spanDateRange"></span></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; width: 8%">Date: <span class="spanDateRange"></span></th>
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
                          <td rowspan="12" style="text-align: left; vertical-align: top; width: 10%"><b>Man</b></td>
                          <td style="text-align: left; vertical-align: middle; width: 34%">1. Are all operators certified on their stations?</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.1.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.1.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.1.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.1.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.1.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.1.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.1.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.1.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.1.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.1.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.1.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.1.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.1.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.1.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            2. Do the operators follow Company & Production SOPs?
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            <ul>
                             <li>Wearing of complete uniform (blue polo, bunnysuit, gloves, facemask,
                                  hairnet, skillcard and company ID)</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            <ul>
                             <li>No bringing of cellphones inside the Production area</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            <ul>
                             <li>No cosmetics (makeup, lipstick) inside Production area</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.3.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.3.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.3.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.3.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.3.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.3.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.3.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.3.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.3.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.3.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.3.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.3.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.3.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.3.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            <ul>
                             <li>No bringing of food or eating inside Production area</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.4.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.4.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.4.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.4.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.4.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.4.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.4.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.4.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.4.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.4.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.4.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.4.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.2.4.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.2.4.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            3. Do the operators follow safety rules?
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Use of PPE</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>No wearing of dangling items (dangling jewelries and wristwatch)?</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="1.3.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="1.3.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">RESULT</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="1.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="1.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="1.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="1.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="1.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="1.6" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="1.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                        </tr>
                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">In-charge person: / CAPA due date :            </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="1.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="1.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="1.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="1.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="1.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="1.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="1.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="1.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="1.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="1.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="1.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="1.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="1.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="1.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                        </tr>
                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">Corrective Action</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="1.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="1.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="1.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="1.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="1.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="1.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="1.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                        </tr>
                        <!-- Material / Product -->
                         <tr>
                          <td rowspan="14" style="text-align: left; vertical-align: top; width: 10%"><b>Material / <br> Product</b></td>
                          <td style="text-align: left; vertical-align: middle; width: 34%">1. Input Materials</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Are material properly labeled?</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Are material properly sealed?</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Does the material rack only contains materials needed for the ongoing</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.3.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.3.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.3.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.3.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.3.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.3.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.3.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.3.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.3.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.3.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.3.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.3.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.1.3.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.1.3.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>

                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">2. Work-in-Process (WIP)</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Are input and output station well-identified with label and being followed?</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Are non-conforming products properly identified?</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Are required trays for non-conforming products being used (red - SCRAP / yellow - for VERIFICATION)?</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.3.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.3.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.3.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.3.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.3.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.3.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.3.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.3.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.3.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.3.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.3.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.3.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.2.3.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.2.3.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>

                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">3. Output Product</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Are the output products for completion properly labeled and with attavhed status slip?</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Are the products not mixed in one layer?</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="2.3.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="2.3.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">RESULT</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="2.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="2.2" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="2.3" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="2.4" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="2.5" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="2.6" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="2.7" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                        </tr>
                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">In-charge person: / CAPA due date :            </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="2.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="2.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="2.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="2.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="2.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="2.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="2.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="2.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="2.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="2.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="2.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="2.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="2.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="2.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                        </tr>
                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">Corrective Action</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="2.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="2.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="2.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="2.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="2.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="2.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="2.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                        </tr>

                        <!-- Machine / Jigs / Tools -->
                        <tr>
                          <td rowspan="15" style="text-align: left; vertical-align: top; width: 10%"><b>Machine / Jigs / Tolls</b></td>
                          <td style="text-align: left; vertical-align: middle; width: 34%">1. Are machine traceability and stickers clearly filled-up and updated?</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            <ul>
                             <li>Machine Tag</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            <ul>
                             <li>Buy-Off Sticker</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            <ul>
                             <li>Preventive Maintenance Sticker</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.3.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.3.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.3.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.3.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.3.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.3.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.3.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.3.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.3.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.3.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.3.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.3.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.3.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.3.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            <ul>
                             <li>Calibration Sticker</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.4.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.4.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.4.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.4.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.4.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.4.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.4.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.4.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.4.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.4.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.4.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.4.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.4.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.4.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            <ul>
                             <li>Pressure Gague Indicator (Min/Max)</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.5.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.5.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.5.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.5.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.5.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.5.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.5.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.5.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.5.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.5.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.5.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.5.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.1.5.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.1.5.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            2. Are Machine Records completely filled-upp and updated?
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            <ul>
                             <li>Pre-production Checksheets (with signatures)</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            <ul>
                             <li>Machine Downtime Report (with signatures)</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.2.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.2.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>

                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            3. Are machine pre-production samples (unit) complete, available and updated?
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.3.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.3.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.3.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.3.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.3.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.3.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.3.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.3.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.3.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.3.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.3.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.3.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.3.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.3.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>

                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            4. Are those loose parts (washers, screws, etc.); machine cover and knuckles?
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.4.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.4.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.4.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.4.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.4.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.4.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.4.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.4.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.4.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.4.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.4.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.4.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.4.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.4.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>

                        {{-- NEW ROW --}}
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">
                            5. Are Buy-off, PM Calibration sticker and EEDMS are both updated?
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.5.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.5.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.5.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.5.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.5.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.5.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.5.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.5.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.5.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.5.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.5.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.5.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="3.5.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="3.5.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        {{-- NEW ROW --}}

                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">RESULT</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="3.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="3.2" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="3.3" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="3.4" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="3.5" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="3.6" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="3.7" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                        </tr>
                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">In-charge person: / CAPA due date :            </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="3.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="3.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="3.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="3.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="3.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="3.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="3.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="3.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="3.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="3.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="3.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="3.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="3.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="3.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                        </tr>

                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">Corrective Action</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="3.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="3.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="3.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="3.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="3.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="3.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="3.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                        </tr>

                        <!-- Method / Process -->
                        <tr>
                            <td rowspan="15" style="text-align: left; vertical-align: top; width: 10%"><b>Method / <br> Process</b></td>
                            <td style="text-align: left; vertical-align: middle; width: 34%">1. Is the ongoing product already PASSED product, qualification and pilot run? (Check the report if already checked by Prod'n, Eng'g & QC.)</td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.1.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.1.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.1.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.1.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.1.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.1.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.1.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.1.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.1.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.1.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.1.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.1.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.1.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.1.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">2. Are posted references being followed and tallies with the actual activity of the operator?</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                        </tr>

                        <tr>
                          <td>
                            <ul>
                             <li>Work Instruction / SEI tally versus Operator activity?</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Point Panel / inspection guide tally versus Operator activity?</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.2.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.2.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">3. Is the required maginification for microscope being used? (marking on the knob shall be observed, if applicable)</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.3.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.3.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.3.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.3.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.3.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.3.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.3.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.3.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.3.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.3.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.3.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.3.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.3.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.3.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">4. Is the Defect Escalation procedure being practiced / used?</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Defect escalation slip with sign of Prodn/Engg/QC?</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.4.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.4.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.4.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.4.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.4.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.4.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.4.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.4.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.4.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.4.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.4.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.4.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.4.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.4.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">5. Is the runcard properly filled-up?</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                                <li>Lot number of required parts updated & readable?</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                            <td>
                                <ul>
                                    <li>Operator name, IN & OUT preperly filled-up and readable?</li>
                                </ul>
                            </td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>

                        {{-- NEW ROW --}}
                        <tr>
                            <td>
                                <ul>
                                    <li>Are posted references DCC stamp not faded?</li>
                                </ul>
                            </td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.3.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.3.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.3.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.3.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.3.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.3.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.3.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.3.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.3.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.3.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.3.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.3.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.3.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.3.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>

                        <tr>
                            <td>
                                <ul>
                                    <li>Are posted SEI updated and with "OK for posting" stamp?</li>
                                </ul>
                            </td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.4.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.4.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.4.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.4.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.4.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.4.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.4.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.4.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.4.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.4.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.4.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.4.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="4.5.4.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                            <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="4.5.4.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        {{-- END NEW ROW --}}

                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">RESULT</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="4.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="4.2" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="4.3" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="4.4" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="4.5" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="4.6" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="4.7" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                        </tr>
                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">In-charge person: / CAPA due date :            </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="4.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="4.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="4.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="4.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="4.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="4.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="4.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="4.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="4.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="4.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="4.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="4.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="4.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="4.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                        </tr>
                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">Corrective Action</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="4.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="4.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="4.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="4.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="4.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="4.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="4.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                        </tr>

                        <!-- Work Place -->
                         <tr>
                          <td rowspan="11" style="text-align: left; vertical-align: top; width: 10%"><b>Work <br> Place</b></td>
                          <td style="text-align: left; vertical-align: middle; width: 34%">1. Are visual mnagement properly implemented and updated?</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Line Identification Tag</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.1.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.1.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.1.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.1.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.1.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.1.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.1.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Line Information Board</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.2.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.2.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.2.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.2.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.2.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.2.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.2.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td>
                            <ul>
                             <li>Output Monitoring Board</li>
                            </ul>
                          </td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.3.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.3.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.3.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.3.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.3.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.3.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.3.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.3.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.3.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.3.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.3.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.3.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.1.3.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.1.3.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">2. Are working areas free from dust and unnecessary items?</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.2.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.2.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.2.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.2.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.2.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.2.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.2.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.2.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.2.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.2.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.2.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.2.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.2.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.2.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">3. Area all line demarcations in-palced, properly used and maintained?</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.3.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.3.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.3.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.3.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.3.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.3.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.3.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.3.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.3.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.3.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.3.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.3.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.3.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.3.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">4. Are production waste well maintained and properly disposed?</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.4.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.4.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.4.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.4.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.4.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.4.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.4.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.4.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.4.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.4.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.4.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.4.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.4.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.4.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>
                        <tr>
                          <td style="text-align: left; vertical-align: middle; width: 34%">5. There no scattered units or materials on the floor?</td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.5.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.5.0.1" date-index="1" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.5.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.5.0.2" date-index="2" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.5.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.5.0.3" date-index="3" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.5.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.5.0.4" date-index="4" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.5.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.5.0.5" date-index="5" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.5.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.5.0.6" date-index="6" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="/"><input value="1" index="5.5.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                          <td style="text-align: center; vertical-align: middle; width: 4%;" val="X"><input value="0" index="5.5.0.7" date-index="7" class="chkDLA" monitoring-id="{{$monitoring_info['m_id']}}" type="checkbox" name="" class=""></td>
                        </tr>

                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">RESULT</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="5.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="5.2" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="5.3" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="5.4" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="5.5" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="5.6" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;"><input index="5.7" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtResult" type="text" name="dla_result" placeholder="Type here..."></th>
                        </tr>
                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">In-charge person: / CAPA due date :            </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="5.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="5.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="5.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="5.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="5.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="5.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="5.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="5.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="5.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="5.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="5.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="5.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                          <th colspan="2" style="text-align: left; vertical-align: middle; font-size: 12px; font-weight: normal; background-color: #9f9f9f;">
                            <select index="5.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control select2 select2bs4 selInCharge" name="in_charge_person" placeholder="In-charge person">
                            </select>
                            <input type="date" name="" index="5.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtDueDate">
                          </th>
                        </tr>
                        <tr>
                          <th style="text-align: right; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">Corrective Action</th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="5.1" date-index="1" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="5.2" date-index="2" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="5.3" date-index="3" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="5.4" date-index="4" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="5.5" date-index="5" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="5.6" date-index="6" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
                          <th colspan="2" style="text-align: center; vertical-align: middle; font-size: 20px; background-color: #9f9f9f;">
                            <textarea name="" index="5.7" date-index="7" monitoring-id="{{$monitoring_info['m_id']}}" class="form-control form-control-sm txtCorrectiveAction" rows="3" placeholder="N/A"></textarea>
                          </th>
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
<div class="modal fade" id="mdlSaveSampling">
  <div class="modal-dialog modal-lg">
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
              <label class="col-sm-4 col-form-label">Sampling Type</label>
              <div class="col-sm-8">
                <select class="form-control" name="sampling_type" placeholder="Sampling Type">
                  <option value="0" selected="true">AUTOMATIC</option>
                  <option value="1">MANUAL</option>
                </select>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Result</label>
              <div class="col-sm-8">
                <select class="form-control" name="remarks" placeholder="Result">
                  <option>NO PRODUCTION</option>
                  <option>NO MONITORING STATION</option>
                  <option selected="true">PASSED</option>
                  <option>FAILED</option>
                </select>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row form-sampling">
              <label class="col-sm-4 col-form-label">Station</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="monitoring_id" placeholder="Monitoring ID" style="display: none;">
                <input type="text" class="form-control" name="sampling_id" placeholder="Sampling ID" style="display: none;">
                <select class="form-control select2 select2bs4" name="station_id" placeholder="Station">
                </select>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row form-sampling">
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

            <div class="form-group row form-sampling">
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

            <div class="form-group row form-sampling">
              <label class="col-sm-4 col-form-label">Series</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="series" placeholder="(Auto Fill-in)" readonly="">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row form-sampling">
              <label class="col-sm-4 col-form-label">Sample Size</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" name="sample_size" placeholder="Sample Size" value="0">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row form-sampling">
              <label class="col-sm-4 col-form-label">ACCEPT</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" name="accept" placeholder="ACCEPT" readonly="true" value="0">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row form-sampling">
              <label class="col-sm-4 col-form-label">REJECT</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" name="reject" placeholder="REJECT" value="0">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row form-sampling">
              <label class="col-sm-4 col-form-label">Remarks</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="result" placeholder="Remarks" autocomplete="off">
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div>

            <div class="form-group row form-sampling">
              <label class="col-sm-4 col-form-label">DPPM</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" name="dppm" placeholder="DPPM" readonly="true" value="0">
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

            <div class="form-group row form-sampling">
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

<!-- MODALS -->
<div class="modal fade" id="mdlSaveMultipleSamplingResult">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><i class="fa fa-info-circle text-info"></i> Multiple Sampling Result</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form class="form-horizontal" id="frmSaveMultipleSamplingResult">
            @csrf
            <div class="modal-body">
                <div class="card-body">

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Validation Result<br>(QC Supervisor)</label>
                    <div class="col-sm-8">
                    <select class="form-control" name="multiple_validation_result" placeholder="Validation Result">
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
                <button type="submit" class="btn btn-primary btnSaveMultipleSamplingResult">Save</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- SEARCH PO MODAL START -->
<div class="modal fade" id="modalSearchPoNo">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fa-solid fa-file-circle-check"></i>&nbsp;&nbsp;Search P.O. No.</h4>
                <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formSearchPoNo">
                @csrf
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <label>Enter P.O. No.</label>
                        <input type="text" placeholder="P.O. No." class="po_no form-control" required />
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="" class="btn btn-primary"><i id=""
                            class="fa fa-check"></i> Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- SEARCH PO MODAL END -->

<script type="text/javascript">
  // Variables
  let dtSamplingsPending, dtSamplingsOk, dtSamplingsNg, dtSamplingsNoProdNoMonitoring, frmSaveSampling, btnSaveSampling, frmSaveMultipleSamplingResult, btnSaveMultipleSamplingResult;
</script>

@endsection

@section('js_content')
<!-- Custom Links -->
<script src="{{ asset('public/scripts/client/Sampling.js?1213321321') }}"></script>
<script src="{{ asset('public/scripts/client/Monitoring.js?1132156') }}"></script>

<!-- CSS -->
<style>
    .chkDLA {
        width: 25px;
        height: 25px;
        padding: 50px;
        border: 1px solid red;
    }
</style>

<!-- JS Codes -->
<script type="text/javascript">
  $(document).ready(function () {
    frmSaveSampling = $("#frmSaveSampling");
    btnSaveSampling = $('.btnSaveSampling');

    frmSaveMultipleSamplingResult = $("#frmSaveMultipleSamplingResult");
    btnSaveMultipleSamplingResult = $('.btnAddMultipleSamplingResult');

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

    $.fn.dataTable.ext.errMode = 'none';

    //start of tblSamplings_Pending
    $(document).on('click','#tblSamplings_Pending tbody tr',function(e){
      $(this).closest('tbody').find('tr').removeClass('table-active');
      $(this).closest('tr').addClass('table-active');
    });

    let multiSelectArray = [];
    $("#tblSamplings_Pending").on('click', '.multiSelect', function(e){
        let samplingId = $(this).attr('sampling-id');

        if(this.checked){
            multiSelectArray.push([samplingId]);
        }else{
            multiSelectArray = jQuery.grep(multiSelectArray, function(val){ return val != samplingId; })
        }
        console.log('multiSelectArray', multiSelectArray);

        if(multiSelectArray.length > 0){
            $('.divMultipleResult').removeClass('d-none');
        }else{
            $('.divMultipleResult').addClass('d-none');
        }
    });

    $(".btnAddMultipleSamplingResult").click(function(e){
      $("#mdlSaveMultipleSamplingResult").modal('show');
      frmSaveMultipleSamplingResult[0].reset();
      $(".input-error", frmSaveMultipleSamplingResult).text('');
      $(".form-control", frmSaveMultipleSamplingResult).removeClass('is-invalid');
    });

    $("#frmSaveMultipleSamplingResult").submit(function(e){
      e.preventDefault();
      SaveMultipleSamplingResult(multiSelectArray);
    });

    dtSamplingsPending = $("#tblSamplings_Pending").DataTable({
        "processing" : false,
        "serverSide" : true,
        "lengthMenu": [ [50, -1], [50, "All"] ],
        "ajax" : {
            url: "{{ route('view_samplings_pending') }}",
            data: function (param){
                param.status = $(".selFilSamplingByStat").val();
                param.monitoring_id = $('.txtHeaderMonitoringId').val();
                param.validation_result = '';
                param.result = ["PASSED","FAILED"];
            }
        },
        "columns":[
            { "data" : "created_at", visible: false, orderable: false },
            { "data" : "multi_select" },
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
            { "data" : "qc_inspector_name", orderable: false },
            { "data" : "raw_validation_result", orderable: false },
            { "data" : "raw_status", orderable: false, searchable: false },
            { "data" : "raw_action", orderable:false, searchable:false }
        ],
        "columnDefs": [
            {
            "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
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


    $("#tblSamplings_Pending").on('click', '.btnActions', function(e){
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

    $("#tblSamplings_Pending").on('click', '.btnEditSampling', function(e){
        let samplingId = $(this).attr('sampling-id');
        GetSamplingById(samplingId);
    });
    //end of tblSamplings_Pending

    //start of tblSamplings_Ok
    $(document).on('click','#tblSamplings_Ok tbody tr',function(e){
        $(this).closest('tbody').find('tr').removeClass('table-active');
        $(this).closest('tr').addClass('table-active');
    });

    dtSamplingsOk = $("#tblSamplings_Ok").DataTable({
        "processing" : false,
        "serverSide" : true,
        "lengthMenu": [ [50, -1], [50, "All"] ],
        "ajax" : {
            url: "{{ route('view_samplings_ok') }}",
            data: function (param){
                param.status = $(".selFilSamplingByStat").val();
                param.monitoring_id = $('.txtHeaderMonitoringId').val();
                param.validation_result = '1';
                param.result = ["PASSED","FAILED"];
            }
        },
        "columns":[
            { "data" : "created_at", visible: false, orderable: false },
            // { "data" : "multi_select", visible: false },
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
            { "data" : "qc_inspector_name", orderable: false },
            { "data" : "raw_validation_result", orderable: false },
            { "data" : "raw_status", orderable: false, searchable: false },
            { "data" : "raw_action", orderable:false, searchable:false }
        ],
        "columnDefs": [
            {
            "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
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

    $("#tblSamplings_Ok").on('click', '.btnActions', function(e){
      let samplingId = $(this).attr('sampling-id');
      let action = $(this).attr('action');
      let status = $(this).attr('status');
      let title = '';

        if(action == 1){
            if(status == 2){
                title = 'Archive Sampling';
            }else if(status == 1){
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

    $("#tblSamplings_Ok").on('click', '.btnEditSampling', function(e){
      let samplingId = $(this).attr('sampling-id');
      GetSamplingById(samplingId);
    });
    //end of tblSamplings_Ok

    //start of tblSamplings_Ng
    $(document).on('click','#tblSamplings_Ng tbody tr',function(e){
      $(this).closest('tbody').find('tr').removeClass('table-active');
      $(this).closest('tr').addClass('table-active');
    });

    dtSamplingsNg = $("#tblSamplings_Ng").DataTable({
      "processing" : false,
      "serverSide" : true,
      "lengthMenu": [ [50, -1], [50, "All"] ],
      "ajax" : {
        url: "{{ route('view_samplings_ng') }}",
        data: function (param){
            param.status = $(".selFilSamplingByStat").val();
            param.monitoring_id = $('.txtHeaderMonitoringId').val();
            param.validation_result = '0';
            param.result = ["PASSED","FAILED"];
        }
      },
      "columns":[
        { "data" : "created_at", visible: false, orderable: false },
        // { "data" : "multi_select", visible: false },
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
        { "data" : "qc_inspector_name", orderable: false },
        { "data" : "raw_validation_result", orderable: false },
        { "data" : "raw_status", orderable: false, searchable: false },
        { "data" : "raw_action", orderable:false, searchable:false }
      ],
      "columnDefs": [
        {
          "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
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


    $("#tblSamplings_Ng").on('click', '.btnActions', function(e){
      let samplingId = $(this).attr('sampling-id');
      let action = $(this).attr('action');
      let status = $(this).attr('status');
      let title = '';

      if(action == 1){
        if(status == 2){
          title = 'Archive Sampling';
        }else if(status == 1){
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

    $("#tblSamplings_Ng").on('click', '.btnEditSampling', function(e){
      let samplingId = $(this).attr('sampling-id');
      GetSamplingById(samplingId);
    });
    //end of tblSamplings_Ng

    //start of tblSamplings_NoProdNoMonitoring
    $(document).on('click','#tblSamplings_NoProdNoMonitoring tbody tr',function(e){
      $(this).closest('tbody').find('tr').removeClass('table-active');
      $(this).closest('tr').addClass('table-active');
    });

    dtSamplingsNoProdNoMonitoring = $("#tblSamplings_NoProdNoMonitoring").DataTable({
      "processing" : false,
      "serverSide" : true,
      "lengthMenu": [ [50, -1], [50, "All"] ],
      "ajax" : {
        url: "{{ route('view_samplings_no_prod_no_monitoring') }}",
        data: function (param){
            param.status = $(".selFilSamplingByStat").val();
            param.monitoring_id = $('.txtHeaderMonitoringId').val();
            param.validation_result = '';
            param.result = ["NO MONITORING STATION","NO PRODUCTION"];
        }
      },
      "columns":[
        { "data" : "created_at", visible: false, orderable: false },
        // { "data" : "multi_select", visible: false },
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
        { "data" : "qc_inspector_name", orderable: false },
        { "data" : "raw_validation_result", orderable: false },
        { "data" : "raw_status", orderable: false, searchable: false },
        { "data" : "raw_action", orderable:false, searchable:false }
      ],
      "columnDefs": [
        {
          "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
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

    $("#tblSamplings_NoProdNoMonitoring").on('click', '.btnActions', function(e){
      let samplingId = $(this).attr('sampling-id');
      let action = $(this).attr('action');
      let status = $(this).attr('status');
      let title = '';

      if(action == 1){
        if(status == 2){
          title = 'Archive Sampling';
        }else if(status == 1){
          title = 'Restore Sampling';
        }
      }
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

    $("#tblSamplings_NoProdNoMonitoring").on('click', '.btnEditSampling', function(e){
      let samplingId = $(this).attr('sampling-id');
      GetSamplingById(samplingId);
    });
    //end of tblSamplings_NoProdNoMonitoring

    let checked_chckbox_arr = [];

    let arrayAll = [
        ['1.1.0', '1.2.1', '1.2.2', '1.2.3', '1.2.4', '1.3.1', '1.3.2'],
        ['2.1.1', '2.1.2', '2.1.3', '2.2.1', '2.2.2', '2.2.3', '2.3.1', '2.3.2'],
        ['3.1.1', '3.1.2', '3.1.3', '3.1.4', '3.1.5', '3.2.1', '3.2.2', '3.3.0', '3.5.0'],
        ['4.1.0', '4.2.1', '4.2.2', '4.3.0', '4.4.1', '4.5.1', '4.5.2', '4.5.3', '4.5.4'],
        ['5.1.1', '5.1.2', '5.1.3', '5.2.0', '5.3.0', '5.4.0', '5.5.0']
    ];

    // Generate arrayAllGroupedPerCategory
    let arrayAllGroupedPerCategory = arrayAll.map(category =>
        Array.from({ length: 7 }, (_, day) => category.map(item => `${item}.${day + 1}`))
    );

    // $('.txtResult').keyup(function(){
    //     fnChkDLA(checked_chckbox_arr, arrayAllGroupedPerCategory);
    // });

    // $('.selInCharge').change(function(){
    //     fnChkDLA(checked_chckbox_arr, arrayAllGroupedPerCategory);
    // });

    $('.txtDueDate').keyup(function(){
        fnChkDLA(checked_chckbox_arr, arrayAllGroupedPerCategory);
    });

    $('.txtCorrectiveAction').keyup(function(){
        fnChkDLA(checked_chckbox_arr, arrayAllGroupedPerCategory);
    });

    $('.chkDLA').click(function(){
        let value = $(this).attr('value');
        let index = $(this).attr('index');
        let dateIndex = $(this).attr('date-index');
        let monitoringId = $(this).attr('monitoring-id');
        let date = $(this).attr('date');
        let isChecked = 0;

        if($(this).prop('checked')){
            isChecked = 1;
        }

        if(value == 1){
            $('.chkDLA[index="' + index + '"][value="0"]').prop('checked', false);
        }
        else{
            $('.chkDLA[index="' + index + '"][value="1"]').prop('checked', false);
        }

        //for checked_array
        let data_value = $(this).attr('value');
        let data_index = $(this).attr('index');

        if(this.checked){
            if(data_value == 1){
                    checked_chckbox_arr.push([data_index]);
            }else{
                checked_chckbox_arr = jQuery.grep(checked_chckbox_arr, function(val){ return val != data_index; })
            }
        }else{
            checked_chckbox_arr = jQuery.grep(checked_chckbox_arr, function(val){ return val != data_index; })
        }

        fnChkDLA(checked_chckbox_arr, arrayAllGroupedPerCategory);
    });

    // CLARK COMMENT 07292024 //UNCOMMENT THIS
    function PushToCheckedChckboxArr(checkitems_to_push, fnChkDLA){
        $.each(checkitems_to_push, function(key, value){
            checked_chckbox_arr.push([value]);
        });
        setTimeout(() => {
            fnChkDLA(checked_chckbox_arr, arrayAllGroupedPerCategory)
        }, 1000);
    }

    function fnChkDLA(checked_chckbox_arr, arrayAllGroupedPerCategory) {
        let categoryCount = arrayAllGroupedPerCategory.length;
        let dayCount = 7; // Assuming 7 days
        let count = Array.from({ length: categoryCount }, () => Array(dayCount).fill(0));

        let totalChecked = 0;
        let totalCompleted = 0;
        let uniqueCompletedCategoryDays = new Set(); // 🔹 Ensure each category-day counts only once

        $('.btnSaveDLA').attr('data-alert', '0'); // Reset alert

        // 🔹 Loop through checked items and count occurrences
        checked_chckbox_arr.forEach(([checkedValue]) => {
            for (let index_per_cat = 0; index_per_cat < categoryCount; index_per_cat++) {
                for (let index_per_day = 0; index_per_day < arrayAllGroupedPerCategory[index_per_cat].length; index_per_day++) {
                    let currentCategoryDayArray = arrayAllGroupedPerCategory[index_per_cat][index_per_day];

                    if (currentCategoryDayArray.includes(checkedValue)) {
                        if (count[index_per_cat][index_per_day] === 0) {
                            totalChecked++; // ✅ Count this category-day only once
                        }

                        count[index_per_cat][index_per_day]++;

                        let totalItemsInCategoryDay = currentCategoryDayArray.length;

                        if (count[index_per_cat][index_per_day] === totalItemsInCategoryDay) {
                            let key = `${index_per_cat}.${index_per_day}`;
                            if (!uniqueCompletedCategoryDays.has(key)) {
                                uniqueCompletedCategoryDays.add(key);
                                totalCompleted++; // ✅ Count only ONCE per category-day
                            }

                            $('input[name="dla_result"][index="' + (index_per_cat + 1) + '.' + (index_per_day + 1) + '"]').val('OK');
                            $('.selInCharge[index="' + (index_per_cat + 1) + '.' + (index_per_day + 1) + '"]').val('').trigger('change');
                            $('.txtDueDate[index="' + (index_per_cat + 1) + '.' + (index_per_day + 1) + '"]').val('');
                            $('.selInCharge[index="' + (index_per_cat + 1) + '.' + (index_per_day + 1) + '"]').prop('required', false);
                            $('.txtDueDate[index="' + (index_per_cat + 1) + '.' + (index_per_day + 1) + '"]').prop('required', false);
                        } else {
                            $('input[name="dla_result"][index="' + (index_per_cat + 1) + '.' + (index_per_day + 1) + '"]').val('NG');
                            $('.selInCharge[index="' + (index_per_cat + 1) + '.' + (index_per_day + 1) + '"]').prop('required', true);
                            $('.txtDueDate[index="' + (index_per_cat + 1) + '.' + (index_per_day + 1) + '"]').prop('required', true);
                        }
                    }
                }
            }
        });

        // 🔹 Ensure In-Charge & Due Date contribute to `totalCompleted`
        arrayAllGroupedPerCategory.forEach((category, index_per_cat) => {
            category.forEach((_, index_per_day) => {
                let index = `${index_per_cat}.${index_per_day}`;
                let inChargeFilled = $('.selInCharge[index="' + (index_per_cat + 1) + '.' + (index_per_day + 1) + '"]').val()?.trim() !== '';
                let dueDateFilled = $('.txtDueDate[index="' + (index_per_cat + 1) + '.' + (index_per_day + 1) + '"]').val()?.trim() !== '';
                let correctiveActionFilled = $('.txtCorrectiveAction[index="' + (index_per_cat + 1) + '.' + (index_per_day + 1) + '"]').val()?.trim() !== '';

                if (inChargeFilled && dueDateFilled && correctiveActionFilled && !uniqueCompletedCategoryDays.has(index)) {
                    uniqueCompletedCategoryDays.add(index);
                    totalCompleted++; // ✅ Count only once when fields are filled
                }
            });
        });

        // 🔹 Final check: Are all checked categories fully completed?
        if (totalChecked === totalCompleted && totalChecked > 0) {
            $('.btnSaveDLA').attr('data-alert', '0'); // ✅ Everything completed
        } else {
            $('.btnSaveDLA').attr('data-alert', '1'); // ❌ Some are incomplete
        }

        console.log("Checked per category per day:", totalChecked);
        console.log("Completed categories per day:", totalCompleted);
        console.log("data-alert:", $('.btnSaveDLA').attr('data-alert'));
    }

    $('input[name="sample_size"]', frmSaveSampling).on("keyup change", function(){
      if($('input[name="reject"]', frmSaveSampling).val() > 0){
        $('select[name="remarks"]', frmSaveSampling).val("FAILED");
      }else{
        $('select[name="remarks"]', frmSaveSampling).val("PASSED");
      }
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
      }else{
        $('input[name="accept"]', frmSaveSampling).val(0);
      }
    });

    // CLARK COMMENT 10/02/2024 WORKING FOR CHECKING(CHECKED ITEMS) RETRIEVED DATA
    LoadDLACheckItems($(".txtHeaderMonitoringId").val(), PushToCheckedChckboxArr, fnChkDLA); //UNCOMMENT THIS Enable additional function for daily monitoring; clark 08/20/2024
    // PushToCheckedChckboxArr(checked_chckbox_arr, arrayAllGroupedPerCategory)
    // PushToCheckedChckboxArr(checkitems_to_push, arrayAllGroupedPerCategory, fnChkDLA);
    // LoadDLACheckItems($(".txtHeaderMonitoringId").val()); //COMMENT THIS Enable additional function for daily monitoring; clark 08/20/2024
    LoadDLAResults($(".txtHeaderMonitoringId").val());

    $(document).on('click', '.btnReload', function(){
      // window.location.reload();
      dtSamplingsPending.draw();
      dtSamplingsOk.draw();
      dtSamplingsNg.draw();
      dtSamplingsNoProdNoMonitoring.draw();
    });

    $(".selFilSamplingByStat").change(function(e){
      dtSamplingsPending.draw();
      dtSamplingsOk.draw();
      dtSamplingsNg.draw();
      dtSamplingsNoProdNoMonitoring.draw();
    });

    $('select[name="remarks"]', frmSaveSampling).change(function(e){
      if($(this).val() == "NO PRODUCTION" || $(this).val() == "NO MONITORING STATION"){
        $('.form-sampling').hide();
      }
      else{
        $('.form-sampling').show();
      }
    });

    $('select[name="sampling_type"]', frmSaveSampling).change(function(e){
      if($(this).val() == "0"){
        $('.btnSearchPoNo').prop('disabled', false);
        $('input[name="po_no"]', frmSaveSampling).prop('readonly', true).prop('placeholder', '(Click the button to fill-in)');
        $('input[name="series"]', frmSaveSampling).prop('readonly', true).prop('placeholder', '(Click the button to fill-in)');
      }else{
        $('.btnSearchPoNo').prop('disabled', true);
        $('input[name="po_no"]', frmSaveSampling).removeAttr('readonly').prop('placeholder', 'Type here...');
        $('input[name="series"]', frmSaveSampling).removeAttr('readonly').prop('placeholder', 'Type here...');
      }
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

    $('.selInCharge').select2({
        placeholder: "N/A",
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

    $(".btnAddSampling").click(function(e){
      $("#mdlSaveSampling").modal('show');
      frmSaveSampling[0].reset();
      $('.form-sampling').show();
      $(".input-error", frmSaveSampling).text('');
      $(".form-control", frmSaveSampling).removeClass('is-invalid');
      $('select[name="station_id"]', frmSaveSampling).val("").trigger("change");
      $('input[name="monitoring_id"]', frmSaveSampling).val($('.txtHeaderMonitoringId').val());
    });

    $('#mdlSaveSampling').on('shown.bs.modal', function (e) {
      $('input[name="description"]', frmSaveSampling).focus();
    });

    $("#frmSaveSampling").submit(function(e){
      e.preventDefault();
      SaveSampling();
    });

    $(".btnSearchPoNo").click(function(){
        console.log('searchBTN clicked');
        $("#modalSearchPoNo").modal('show');
    });

    $('#formSearchPoNo').submit(function(e){
        e.preventDefault();
        console.log('form submitted');

        let po_no = $('.po_no').val();
        if(!po_no){
            toastr.warning('Invalid P.O. No.');
            return false;
        }
            GetPODetails(po_no);
            $("#modalSearchPoNo").modal('hide');
    });

    $(".btnAddNoProduction").click(function(){
      $.confirm({
          title: 'Add NO PRODUCTION',
          content: '' +
          '<form action="" class="formSearchPoNo">' +
          '<div class="form-group">' +
          '<label>Current Date</label>' +
          '<input type="text" class="noProductionDate form-control" value="<?php echo date('Y-m-d'); ?>" required readonly />' +
          '</div>' +
          '</form>',
          buttons: {
              formSubmit: {
                  text: 'Save',
                  btnClass: 'btn-blue',
                  action: function () {
                      var noProductionDate = this.$content.find('.noProductionDate').val();
                      if(!noProductionDate){
                          toastr.warning('Invalid Production Date.');
                          return false;
                      }
                      AddNoProduction(noProductionDate, $(".txtHeaderMonitoringId").val());
                  }
              },
              cancel: function () {
                  //close
              },
          },
          onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
      });
    });

    var cnfrmScanOperator = $.confirm({
        lazyOpen: true,
        title: '',
        content: '' +
        '<form action="" class="formScanOperator">' +
        '<center><h4>Scan Employee ID</h4>' +
        '<input type="text" placeholder="Employee ID" class="scanned_employee_id form-control" required / style="opacity: 0;">' +
        '<i style="font-size: 150px;" class="fa fa-qrcode"></i></center>' +
        '<div class="form-group">' +
        '</div>' +
        '</form>',
        buttons: {
            cancel: function () {
                //close
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

    let cnfrmScanQcInspector = $.confirm({
        lazyOpen: true,
        title: '',
        content: '' +
        '<form class="formScanQcInspector">' +
        '<center><h4>Scan Employee ID</h4>' +
        '<input type="text" placeholder="Employee ID" class="scanned_employee_id form-control" required style="opacity: 0;">' +
        '<i style="font-size: 150px;" class="fa fa-qrcode"></i></center>' +
        '<div class="form-group">' +
        '</div>' +
        '</form>',
        buttons: {
            cancel: function (){

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
                GetOperatorDetails(scanned_employee_id, $('select[name="station_id"]', frmSaveSampling).val(), 'qc_inspector');
                cnfrmScanQcInspector.close();
                return false;
                //jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });

    $(".btnScanQcInspector").click(function(){
      cnfrmScanQcInspector.open();
    });

    $(document).on('keypress',function(e){
      if(cnfrmScanQcInspector.isOpen()){
        $('.scanned_employee_id').focus();
      }
    });

    $(".btnSaveDLA").click(function(){ //nmodify
        // $(".chkDLA_Save").click(function(){ //nmodify
        if($(".btnSaveDLA").attr('data-alert') == 0){
            let dlaCheckItems = [];
            let unchecked_dlaCheckItems = [];

            $(".chkDLA").each(function(){
                if(this.checked){
                    dlaCheckItems.push({
                        value: $(this).val(),
                        index: $(this).attr('index'),
                        date_index: $(this).attr('date-index'),
                        date: $(this).attr('date'),
                        // monitoring_id: $(this).attr('monitoring-id'), //commented by clark **redudant data
                    });
                }else{
                    unchecked_dlaCheckItems.push({
                        index: $(this).attr('index'),
                        // value: $(this).val(),
                        // date_index: $(this).attr('date-index'),
                        // monitoring_id: $(this).attr('monitoring-id'), //commented by clark **redudant data
                    });
                }
            });

            unchecked_dlaCheckItems = unchecked_dlaCheckItems.filter(unchecked => !dlaCheckItems.some(checked => (checked.index === unchecked.index)));
            // console.log('FINAL unchecked_dlaCheckItems', unchecked_dlaCheckItems);
            let firstArrdlaCheckItems = dlaCheckItems.slice(0, 150);
            let secondArrdlaCheckItems = dlaCheckItems.slice(150, 500);
            let dlaResults = [];

            for(let index = 0; index < $('.txtResult').length; index++){
                dlaResults.push({
                    result: $('.txtResult').eq(index).val(),
                    person_in_charge: $('.selInCharge').eq(index).val(),
                    due_date: $('.txtDueDate').eq(index).val(),
                    corrective_action: $('.txtCorrectiveAction').eq(index).val(),
                    index: $('.txtResult').eq(index).attr('index'),
                    date_index: $('.txtResult').eq(index).attr('date-index'),
                    date: $('.txtResult').eq(index).attr('date'),
                    // monitoring_id: $('.txtResult').eq(index).attr('monitoring-id'), //commented by clark **redudant data
                });
            }

            //   SaveDLACheckItems($(".txtHeaderMonitoringId").val(), dlaCheckItems);//nmodify
            SaveDLAUncheckedCheckItems($(".txtHeaderMonitoringId").val(), unchecked_dlaCheckItems);//nmodify
            SaveDLAFirstArrCheckItems($(".txtHeaderMonitoringId").val(), firstArrdlaCheckItems);//nmodify
            SaveDLASecondArrCheckItems($(".txtHeaderMonitoringId").val(), secondArrdlaCheckItems);//nmodify
            SaveDLAResults($(".txtHeaderMonitoringId").val(), dlaResults);//nmodify
        }else if($(".btnSaveDLA").attr('data-alert') == 1){
            toastr.error('Incomplete Monitoring Details, Please fill-up all checkitems or the corrective action fields');
            // toastr.error('Incomplete Corrective Action, Please fill-up all the corrective action fields!');
        }else{
            toastr.error('Incomplete Corrective Action, Please fill-up all the corrective action fields!');
        }
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
        if($('input[name="reject"]', frmSaveSampling).val() > 0){
            $('select[name="remarks"]', frmSaveSampling).val("FAILED");
        }else{
            $('select[name="remarks"]', frmSaveSampling).val("PASSED");
        }

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
        }else{
            $('input[name="accept"]', frmSaveSampling).val(0);
        }
    });

    $('input[name="reject"]', frmSaveSampling).on("keyup change", function(){
        if($('input[name="reject"]', frmSaveSampling).val() > 0){
            $('select[name="remarks"]', frmSaveSampling).val("FAILED");
        }else{
            $('select[name="remarks"]', frmSaveSampling).val("PASSED");
        }
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
        }else{
            $('input[name="accept"]', frmSaveSampling).val(0);
        }
    });

    function GenerateDateRange(){
        var dateFrom = moment($('.txtHeaderDateFrom').val());
        var dateTo = moment($('.txtHeaderDateTo').val());

        var arrDateRange = [];

        for(var dateFrom = dateFrom; dateFrom <= dateTo; dateFrom.add(1, 'day')){
            arrDateRange.push(dateFrom.format("MM/DD/YYYY"));
        }

        for(var index = 0; index < arrDateRange.length; index++){
            $('.spanDateRange').eq(index).html(arrDateRange[index]);
        }

        // Set the checkboxes date attributes
        var chkDateFrom = moment($('.txtHeaderDateFrom').val());
        var chkDateTo = moment($('.txtHeaderDateTo').val());

        var chkArrDateRange = [];

        for(var chkDateFrom = chkDateFrom; chkDateFrom <= chkDateTo; chkDateFrom.add(1, 'day')){
            chkArrDateRange.push(chkDateFrom.format("YYYY-MM-DD"));
        }

        for(var index = 0; index < chkArrDateRange.length; index++){
            $('.chkDLA[date-index=' + (index + 1) + ']').attr('date', chkArrDateRange[index]);
            $('.txtResult[date-index=' + (index + 1) + ']').attr('date', chkArrDateRange[index]);
            $('.selInCharge[date-index=' + (index + 1) + ']').attr('date', chkArrDateRange[index]);
            $('.txtDueDate[date-index=' + (index + 1) + ']').attr('date', chkArrDateRange[index]);
            $('.txtCorrectiveAction[date-index=' + (index + 1) + ']').attr('date', chkArrDateRange[index]);
        }
    }

    GenerateDateRange();

  });
</script>
@endsection
