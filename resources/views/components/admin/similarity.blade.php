@extends('layouts.admin.master')
@section('title','Operation')

@section('content-header')
<div class="row align-items-center">
        <div class="col-md-12">
            <div class="page-header-title">
                <h3 class="m-b-10">Similarity</h3>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="feather icon-layers"></i></a></li>
                <li class="breadcrumb-item"><a href="#!">ALL Similarity</a></li>
            </ul>
        </div>
    </div>
@endsection


@section('content')
<div class="col-md-12" id="filterForm">
    <div class="card card-default">
        <div class="card-block table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <h3>Dice Coeff</h3>
                    <hr>
                    <table id="dice_data" class="table table-hover">
                        <thead> 
                         <tr>
                           <th style="cursor:pointer" onclick="sorting('id','i_id')" class="text-center"  style="width: 10px">Id <i id="i_id" class="sortstatus fa fa-sort-down"></i></th>
                           <th style="cursor:pointer" class="text-center">Title <i id='i_title' class=""></i></th>
                           <th class="text-center">Artikel Recomendation</th>
                           <th class="text-center">Percentage</th>
                         </tr>
                        </thead>
                        {{-- <p id="tableLoading" style="display:none" class="loading_run"></p> --}}
                        <tbody id="tableBody_dice">
                         
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3>Jaccard Similarity</h3>
                    <hr>
                    <table id="jaccard_data" class="table table-hover">
                        <thead> 
                         <tr>
                           <th style="cursor:pointer" onclick="sorting('id','i_id')" class="text-center"  style="width: 10px">Id <i id="i_id" class="sortstatus fa fa-sort-down"></i></th>
                           <th style="cursor:pointer" class="text-center">Title <i id='i_title' class=""></i></th>
                           <th class="text-center">Artikel Recomendation</th>
                           <th class="text-center">Percentage</th>
                         </tr>
                        </thead>
                        {{-- <p id="tableLoading" style="display:none" class="loading_run"></p> --}}
                        <tbody id="tableBody_jaccard">
                         
                        </tbody>
                    </table>
                </div>
                <div id="pager mt-1">
                    <ul id="pagination" class="pagination-sm" style="!important;"></ul>
                </div>
            </div>
        </div>      
</div>
@endsection

@push('script')
    <script type='text/javascript' src='{{config('app.url')}}js/similarity.js'></script>
@endpush