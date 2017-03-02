@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="top-panel" class="panel panel-default">
                <div class="card card-mini">
                    <div class="card-header">
                        <div class="card-title">My Campaigns</div>
                        <ul class="card-action">
                            <li>
                                <a href="#">
                                    <i class="icon fa fa-bar-chart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body no-padding table-responsive">
                        <table class="table card-table">
                            <thead>
                            <tr>
                                <th class="col-md-4">Name</th>
                                <th class="right col-md-4">Goal</th>
                                <th class="col-md-4">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>MicroSD 64Gb</td>
                                <td class="right">12</td>
                                <td><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Complete</span></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="card card-mini">
                    <div class="card-header">
                        <div class="card-title">All Campaigns</div>
                        <ul class="card-action">
                            <li>
                                <a href="#">
                                    <i class="icon fa fa-bar-chart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body no-padding table-responsive">
                        <table class="table card-table">
                            <thead>
                            <tr>
                                <th class="col-md-4">Name</th>
                                <th class="right col-md-4">Goal</th>
                                <th class="col-md-4">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Mountain Bike</td>
                                <td class="right">1</td>
                                <td><span class="badge badge-info badge-icon"><i class="fa fa-credit-card" aria-hidden="true"></i><span>Confirm Payment</span></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="btn-floating" id="help-actions">
                <div class="btn-bg"></div>
                <button id="add-button" type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions">
                    <i class="icon fa fa-plus"></i>
                    <span class="help-text">Shortcut</span>
                </button>
                <div class="toggle-content">
                    <ul class="actions">
                        <li><a href="#">Create Campaign</a></li>
                        <li><a href="#">Add Payment Method</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $(document).on('click',function() {
                $('.btn-floating').removeClass("active");
            });
            $('#add-button').on('click', function(e){
                e.stopImmediatePropagation();
                $('.btn-floating').addClass("active");
            });

            $(".sidebar-toggle").bind("click", function(e) {
                $("#sidebar").toggleClass("active");
                $(".app-container").toggleClass("__sidebar");
            });

            $(".navbar-toggle").bind("click", function(e) {
                $("#navbar").toggleClass("active");
                $(".app-container").toggleClass("__navbar");
            });

            if($(window).width() < 770) {
                $('#top-panel').addClass('padding-top-2');
            }
            else{
                $('#top-panel').removeClass('padding-top-2');
            }
            $(window).resize(function () {
                if($(window).width() < 770) {
                    $('#top-panel').addClass('padding-top-2');
                }
                else{
                    $('#top-panel').removeClass('padding-top-2');
                }
            });
        });
    </script>
@endsection