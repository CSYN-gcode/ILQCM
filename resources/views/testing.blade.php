@extends('layouts.branch_layout')

@section('title', 'Testing')

@section('content_page')
<style type="text/css">
  .border-danger{
    border: 1px solid red;
  }

  /*span.select2-selection--single {
      border-color: red !important;   
  }*/

  .select2-danger{
    border-color: red !important;    
  }

  .custom-xl-modal{
     min-width: 90%;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fas fa-deliveries"></i> Testing</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Testing</li>
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
                  
                  <label>CSO Return To Supplier Module</label> <br>
                  <label>CSO Available Stock Tab</label>
                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>Reference No</th>
                            <th>Batch No</th>
                            <th>Stock No</th>
                            <th>Item Description</th>
                            <th>DR #</th>
                            <th>Branch</th>
                            <th>Quality</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th>Sold Reference</th>
                            <th>Date Sold</th>
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
</script>

@endsection

@section('js_content')
@endsection