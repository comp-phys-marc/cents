@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(session('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ session('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div>
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
                                <th class="col-md-4 col-sm-4 col-xs-4">Name</th>
                                <th class="right col-md-4 col-sm-4 col-xs-4">Goal</th>
                                <th class="col-md-4 col-sm-4 col-xs-4">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($myCampaigns) != 0)
                                @foreach($myCampaigns as $campaign)
                                    <tr>
                                        <td>{{ $campaign->name }}</td>
                                        <td class="right">{{ $campaign->goal }}</td>
                                        @if($campaign->status == 'complete')
                                            <td><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Complete</span></span></td>
                                        @else
                                            <td><span class="badge badge-warning badge-icon"><i class="fa fa-clock-o" aria-hidden="true"></i><span>In Progress</span></span></td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>No Campaigns Yet!</td>
                                    <td class="right">--</td>
                                    <td><span class="badge badge-danger badge-icon"><i class="fa fa-clock-o" aria-hidden="true"></i><span>No Campaigns</span></span></td>
                                </tr>
                            @endif
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
                                <th class="col-md-4 col-sm-4 col-xs-4">Name</th>
                                <th class="right col-md-4 col-sm-4 col-xs-4">Goal</th>
                                <th class="col-md-4 col-sm-4 col-xs-4">Status</th>
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
                        <li><a href="#" id="create-trigger" data-target="#campaignModal" data-toggle="modal">Create Campaign</a></li>
                        <li><a href="#" id="add-payment-trigger">Add Payment Method</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Create Campaign Modal -->
<div id="campaignModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create a Campaign</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="group-form" role="form" method="POST" action="{{ route('campaign_create') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <h4><b>Name</b></h4>
                                <input required id="name" name="name" type="text" class="form-control " placeholder="My Campaign">
                            </div>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <h4><b>Your Goal</b></h4>
                                <input required id="goal" name="goal" type="number" min="1" step="any" class="form-control" placeholder="100.00">
                            </div>
                            <div class="row">
                                <div class="checkbox">
                                    <input class="set-charge check-input" type="checkbox" name="set-charge">
                                    <label>Set charge per person?</label>
                                </div>
                            </div>
                            <div class="row" id="charge-div">
                                <h4><b>Per Person Charge</b></h4>
                                <input id="charge" name="charge" type="number" min="1" step="any" class="form-control" placeholder="50.00">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <a href="" id="modal-link-button"><button type="submit" class="btn btn-success">Create</button></a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
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

            $('#charge-div').hide();

            $('.checkbox').on('click', function() {
                if ($(this).find('.check-input').attr('checked') == "checked") {
                    $(this).find('.check-input').attr('checked', false);
                }
                else {
                    $(this).find('.check-input').attr('checked', 'checked');
                }
                $('#charge-div').toggle();
            });
        });
    </script>
@endsection