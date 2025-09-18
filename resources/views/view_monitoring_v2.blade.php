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
                          <th colspan="16" style="text-align: left; vertical-align: middle; background-color: #9f9f9f; border-bottom: 1.8px solid black;">DAILY LINE AUDIT <button class="btn btn-success btn-sm btnSaveDLA" style="float: right;"><i class="fa fa-check"></i> Save</button></th>
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
                          <td rowspan="14" style="text-align: left; vertical-align: top; width: 10%"><b>Machine / Jigs / Tolls</b></td>
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
                          <td rowspan="13" style="text-align: left; vertical-align: top; width: 10%"><b>Method / <br> Process</b></td>
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
              <label class="col-sm-4 col-form-label">Remarks</label>
              <div class="col-sm-8">
                <select class="form-control" name="remarks" placeholder="Remarks">
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
                    {{-- <button type="button" class="btn btn-primary btnSearchPoNo" title="Click to type P.O. No."><i class="fa fa-search"></i></button> --}}
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
              <label class="col-sm-4 col-form-label">RESULT</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="result" placeholder="RESULT" autocomplete="off">
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

            <!-- <div class="form-group row form-sampling">
              <label class="col-sm-4 col-form-label">Remarks</label>
              <div class="col-sm-8">
                <textarea class="form-control" name="remarks" placeholder="Remarks" rows="4"></textarea>
                <span class="text-danger float-sm-right input-error"></span>
              </div>
            </div> -->

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


<script type="text/javascript">
  // Variables
  let dtSamplings, frmSaveSampling, btnSaveSampling;
</script>

@endsection

@section('js_content')
<!-- Custom Links -->
<script src="{{ asset('public/scripts/client/Sampling.js') }}"></script>
<script src="{{ asset('public/scripts/client/Monitoring.js') }}"></script>

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
            param.status = $(".selFilSamplingByStat").val();
            param.monitoring_id = $('.txtHeaderMonitoringId').val();
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

    LoadDLA($(".txtHeaderMonitoringId").val());

    $(document).on('click', '.btnReload', function(){
      // window.location.reload();
      dtSamplings.draw();
    });

    $(".selFilSamplingByStat").change(function(e){
      dtSamplings.draw();
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
      }
      else{
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
          '<form action="" class="formSearchPoNo">' +
          '<div class="form-group">' +
          '<label>Enter P.O. No.</label>' +
          '<input type="text" placeholder="P.O. No." class="po_no form-control" required />' +
          '</div>' +
          '</form>',
          buttons: {
              formSubmit: {
                  text: 'Search',
                  btnClass: 'btn-blue',
                  action: function () {
                      var po_no = this.$content.find('.po_no').val();
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
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
      });
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
            // formSubmit: {
            //     text: 'Search',
            //     btnClass: 'btn-blue',
            //     visibility: false,
            //     action: function () {
            //         var scanned_employee_id = this.$content.find('.scanned_employee_id').val();
            //         if(!scanned_employee_id){
            //             toastr.warning('Employee ID is required.');
            //             return false;
            //         }
            //         GetOperatorDetails(scanned_employee_id, $('select[name="station_id"]', frmSaveSampling).val());
            //     }
            // },
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

    $(".btnSaveDLA").click(function(){
      let dlaCheckItems = [];

      $(".chkDLA:checked").each(function(){
          dlaCheckItems.push({
            value: $(this).val(),
            index: $(this).attr('index'),
            date_index: $(this).attr('date-index'),
            date: $(this).attr('date'),
            monitoring_id: $(this).attr('monitoring-id'),
          });
      });

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
            monitoring_id: $('.txtResult').eq(index).attr('monitoring-id'),
          });
      }

    //   console.log('clark')
      SaveDLA($(".txtHeaderMonitoringId").val(), dlaCheckItems, dlaResults); //nmodify

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
      }
      else{
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
      }
      else{
        $('input[name="accept"]', frmSaveSampling).val(0);
      }

    });

    $('input[name="reject"]', frmSaveSampling).on("keyup change", function(){
      if($('input[name="reject"]', frmSaveSampling).val() > 0){
        $('select[name="remarks"]', frmSaveSampling).val("FAILED");
      }
      else{
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
      }
      else{
        $('input[name="accept"]', frmSaveSampling).val(0);
      }

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

      console.log(value);
      console.log(index);
      console.log(dateIndex);
      console.log(monitoringId);
      console.log(date);
      console.log(isChecked);

    });

    function GenerateDateRange(){
      // Set the header date labels
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
