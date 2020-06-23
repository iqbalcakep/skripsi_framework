@extends('layouts.admin.master')
@section('title','Operation')

<style>
 
    #background {
    
        width: 100%;
        height: 30%;
        background-color: black;
        margin: 0px;
        padding: 0px;
    }
    
    #console {
        margin: 0px;
        padding: 0px;
    }
    
    #consoletext {
        color: rgb(255, 255, 255);
        font-family: Monospace;
        margin: 10px 0px 0px 10px;
    }
    
    #textinput {
        resize: none;
        margin: 0px 0px 10px 10px;
        border: none;
        outline: none;
        background-color: rgb(0, 0, 0);
        color: rgb(255, 255, 255);
        font-family: Monospace;
        width: calc(100% - 20px);
        overflow: hidden;
    }
</style>

@section('content-header')
<div class="row align-items-center">
        <div class="col-md-12">
            <div class="page-header-title">
                <h3 class="m-b-10">OPERATIONS</h3>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="feather icon-layers"></i></a></li>
                <li class="breadcrumb-item"><a href="#!">ALL OPERATION</a></li>
            </ul>
        </div>
    </div>
@endsection


@section('content')
<div class="col-md-12" id="filterForm">
    <div class="card card-default">
        <div class="card-block table-responsive">
            <button type="button"  id="startCrawl" data-placement="left" data-toggle="tooltip"  class="btn text-white btn-primary btn-loader mr-1"><i class="feather icon-settings"></i> Start Crawl</button>
            <button type="button" id="startDice" data-placement="left" data-toggle="tooltip"  class="btn text-white btn-primary btn-loader mr-1"><i class="feather icon-settings"></i> Start Dice</button>
            <button type="button" id="startJaccard" data-placement="left" data-toggle="tooltip"  class="btn text-white btn-primary btn-loader mr-1"><i class="feather icon-settings"></i> Start Jaccard</button>
            
            <div id = "background">
                <div id = "console">
                    <p id = "consoletext">
                       
                    </p>
                    <textarea rows = "1" id = "textinput" onkeydown = "checkInput();"></textarea>
                </div>
            </div>
        </div>      
</div>
@endsection

@push('script')
    <script type='text/javascript' src='{{config('app.url')}}js/operation.js'></script>
@endpush