@extends('layouts.admin_layout')

@section('title', 'Dashboard')

@section('content_page')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

          <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-info">
            <div class="inner">
              <!-- <h3 id="h3RegistrationsCount">0</h3> -->
              <br><br>
              <p>Series</p>
            </div>
            <div class="icon">
              <i class="fas fa-list"></i>
            </div>
            <a href="{{ route('serieses') }}" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-purple">
            <div class="inner">
              <!-- <h3 id="h3RegistrationsCount">0</h3> -->
              <br><br>
              <p>Station</p>
            </div>
            <div class="icon">
              <i class="fas fa-cube"></i>
            </div>
            <a href="{{ route('stations') }}" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-danger">
            <div class="inner">
              <!-- <h3 id="h3RegistrationsCount">0</h3> -->
              <br><br>
              <p>Users</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('users') }}" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-primary">
            <div class="inner">
              <!-- <h3 id="h3RegistrationsCount">0</h3> -->
              <br><br>
              <p>Product Lines</p>
            </div>
            <div class="icon">
              <i class="fas fa-list"></i>
            </div>
            <a href="{{ route('product_lines') }}" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-warning">
            <div class="inner">
              <!-- <h3 id="h3RegistrationsCount">0</h3> -->
              <br><br>
              <p>Machines</p>
            </div>
            <div class="icon">
              <i class="fas fa-hdd"></i>
            </div>
            <a href="{{ route('machines') }}" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-success">
            <div class="inner">
              <!-- <h3 id="h3RegistrationsCount">0</h3> -->
              <br><br>
              <p>Monitoring</p>
            </div>
            <div class="icon">
              <i class="fas fa-clipboard-list"></i>
            </div>
            <a href="{{ route('monitoring') }}" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('js_content')
<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();

    // CountUsers();
    // CountRegistrations();
    // CountPBBRegistrations();
    // CountDeliveries();


  });
</script>
@endsection