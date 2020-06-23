@extends('layouts.admin.master')
@section('title','History')
@section('content-header')
<div class="row align-items-center">
        <div class="col-md-12">
            <div class="page-header-title">
                <h3 class="m-b-10">History</h3>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="feather icon-layers"></i></a></li>
                <li class="breadcrumb-item"><a href="#!">Engagemnet List</a></li>
            </ul>
        </div>
    </div>
@endsection


@section('content')
<div class="col-md-12" id="filterForm">
<b>MAX History</b>
                <select name="max" id="max">
                    <option value="10" selected>10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                </select>
    <div class="card card-default">
            <div class="card-block table-responsive">
                <div class="form-row">
                  <div id="chart-container" style="height:200px;" class="col-md-12">
                      <canvas id="myChart" width="100%" style="height:50px;"></canvas>
                  </div>        
                </div>
            </div>
        </div>
                
</div>

<div class="row" >
    <div id="tabledata" class="col-md-12">
      <div class="card card-danger">
        <div class="card-block table-responsive">
            <table id="alexa_data" class="table table-hover">
               <thead> 
                <tr>
                  <th style="cursor:pointer" class="text-center"  style="width: 50px">Id <i id="i_id" class="sortstatus"></i></th>
                  <th style="cursor:pointer" class="text-center">Title <i id='i_title' class=""></i></th>
                  <th class="text-center" >Engage</th>
                </tr>
               </thead>
               <!-- <p id="tableLoading" style="display:none" class="loading_run"></p> -->
               <tbody id="tableBody">
                
               </tbody>
              </table>
              <div id="pager mt-1">
                    <ul id="pagination" class="pagination-sm" style="margin-left:15px !important;"></ul>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </div>
    <!-- /.col (left) -->
  </div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js" integrity="sha256-8zyeSXm+yTvzUN1VgAOinFgaVFEFTyYzWShOy9w7WoQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha256-TQq84xX6vkwR0Qs1qH5ADkP+MvH0W+9E7TdHJsoIQiM=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha256-nZaxPHA2uAaquixjSDX19TmIlbRNCOrf5HO1oHl5p70=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
    <script type='text/javascript' src='{{config('app.url')}}js/history.js'></script>
@endpush