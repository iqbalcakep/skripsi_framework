@extends('layouts.admin.master')
@section('title','Preprocessing')
@section('content-header')
<div class="row align-items-center">
        <div class="col-md-12">
            <div class="page-header-title">
                <h3 class="m-b-10">All Article</h3>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="feather icon-layers"></i></a></li>
                <li class="breadcrumb-item"><a href="#!">Article List</a></li>
            </ul>
        </div>
    </div>
@endsection


@section('content')
<div class="col-md-12" id="filterForm">
    <div class="card card-default">
            <div class="card-block table-responsive">
                <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="k" class="form-label">&nbsp;Find&nbsp;&nbsp;</label>
                                <input type="text" id="search-name" class="form-control form-control-sm" placeholder="Title" name="title" value="">
                            </div>            
        
                            <div class="form-group col-md-12 mt-3">
                                    <button type="button" id="reload" title="" data-placement="right" data-toggle="tooltip" data-original-title="Show All" class="btn text-dark btn-light "><i class="fa fa-list-alt"></i> Show All</button>
                                    <span style="float:right;">
                                        <button type="button" id="find" title="" data-placement="left" data-toggle="tooltip" data-original-title="Search" class="btn text-dark btn-primary btn-loader mr-1"><i class="fa fa-search"></i> Search</button>
                                    </span>
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
                  <th style="cursor:pointer" onclick="sorting('id','i_id')" class="text-center"  style="width: 10px">Id <i id="i_id" class="sortstatus fa fa-sort-down"></i></th>
                  <th style="cursor:pointer" onclick="sorting('title','i_title')" class="text-center">Title <i id='i_title' class=""></i></th>
                  <th class="text-center">Real Content</th>
                  <th class="text-center">Filter</th>
                  <th class="text-center" >Tokenize</th>
                  <th class="text-center" >Stem</th>
                  
                </tr>
               </thead>
               {{-- <p id="tableLoading" style="display:none" class="loading_run"></p> --}}
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
    <script type='text/javascript' src='{{config('app.url')}}js/preprocessing.js'></script>
@endpush