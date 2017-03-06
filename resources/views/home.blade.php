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
                                    <th class="right col-md-2 col-sm-2 col-xs-2">Goal</th>
                                    <th class="right col-md-2 col-sm-2 col-xs-2">Charge</th>
                                    <th class="col-md-4 col-sm-4 col-xs-4">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($myCampaigns) != 0)
                                    @foreach($myCampaigns as $campaign)
                                        <tr class='clickable-row' data-target="#campaignEditModal-{{ $campaign->id }}" data-toggle="modal">
                                            <td>{{ $campaign->name }}</td>
                                            <td class="right">{{ $campaign->goal }}</td>
                                            <td class="right">{{ (!is_null($campaign->charge) && ($campaign->set_charge == true)) ? $campaign->charge : '--' }}</td>
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
                                        <td class="right">--</td>
                                        <td><span class="badge badge-danger badge-icon"><i class="fa fa-ban" aria-hidden="true"></i><span>No Campaigns</span></span></td>
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
                            <div class="card-title">Other Campaigns</div>
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
                                    <th class="right col-md-2 col-sm-2 col-xs-2">Goal</th>
                                    <th class="right col-md-2 col-sm-2 col-xs-2">Charge</th>
                                    <th class="col-md-4 col-sm-4 col-xs-4">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($otherCampaigns) != 0)
                                    @foreach($otherCampaigns as $campaign)
                                        <tr class='clickable-row' data-target="#campaignPayModal-{{ $campaign->id }}" data-toggle="modal">
                                            <td>{{ $campaign->name }}</td>
                                            <td class="right">{{ $campaign->goal }}</td>
                                            <td class="right">{{ (!is_null($campaign->charge) && ($campaign->set_charge == true)) ? $campaign->charge : '--' }}</td>
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
                                        <td class="right">--</td>
                                        <td><span class="badge badge-danger badge-icon"><i class="fa fa-ban" aria-hidden="true"></i><span>No Campaigns</span></span></td>
                                    </tr>
                                @endif
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
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span><input required id="goal" name="goal" type="number" min="1" step='0.01' class="form-control" placeholder="100.00">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="checkbox" id="0">
                                        <input class="set-charge check-input" type="checkbox" name="set-charge">
                                        <label>Set charge per person?</label>
                                    </div>
                                </div>
                                <div class="row" id="charge-div-0">
                                    <h4><b>Per Person Charge</b></h4>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span><input id="charge" name="charge" type="number" min="1" step='0.01' class="form-control" placeholder="50.00">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <a href="" id="modal-link-button"><button type="submit" class="btn btn-success">Create</button></a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @foreach($myCampaigns as $campaign)
        @if($campaign->status != 'complete')
        <!-- Edit Campaign Modal -->
        <div id="campaignEditModal-{{ $campaign->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit {{ $campaign->name }}</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="delete-form-{{ $campaign->id }}" name="group-delete-form" role="form" method="POST" action="{{ route('campaign_delete') }}">
                            {{ csrf_field() }}
                            <input id="delete-{{ $campaign->id }}" name="id" value="none" type="hidden">
                        </form>
                        <form class="form-horizontal" id="close-form-{{ $campaign->id }}" name="group-close-form" role="form" method="POST" action="{{ route('campaign_close') }}">
                            {{ csrf_field() }}
                            <input id="close-{{ $campaign->id }}" name="id" value="none" type="hidden">
                        </form>
                        <form class="form-horizontal" name="group-edit-form" role="form" method="POST" action="{{ route('campaign_edit', ['id' => $campaign->id]) }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <small class="text-left">Every participating member of this campaign will be notified of the changes.</small>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <h4><b>Name</b></h4>
                                        <input value="{{ $campaign->name }}" required id="name" name="name" type="text" class="form-control " placeholder="My Campaign">
                                    </div>
                                    <div class="row">
                                        <h4><b>Invite Link</b></h4>
                                        <div class = "input-group">
                                            <input id="clipboard-target" type = "text" value = "{{ '/join/'.$campaign->id.'/'.$campaign->link }}">{{ 'www.centsapp.ca/join/'.$campaign->id.'/'.$campaign->link }}">
                                            <span class = "input-group-btn">
                                                <button class = "btn" type = "button" data-clipboard-target = "#clipboard-target">
                                                    <img class = "clippy" src = "img/clippy.svg" width = "15">
                                                </button>
                                            </span>
                                        </div>
                                        <code class="wrap-around"><a href="{{ '/join/'.$campaign->id.'/'.$campaign->link }}">{{ 'www.centsapp.ca/join/'.$campaign->id.'/'.$campaign->link }}</a></code>
                                    </div>
                                    <div class="row">
                                        <h4><b>Your Goal</b></h4>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span><input value="{{ $campaign->goal }}" required id="goal" name="goal" type="number" min="1" step='0.01' class="form-control" placeholder="0.00" readonly>
                                        </div>
                                    </div>
                                    @if(!is_null($campaign->charge))
                                    <div class="row">
                                        <div class="checkbox" id="{{ $campaign->id }}">
                                            <input class="set-charge check-input" type="checkbox" name="set-charge" {{ ($campaign->set_charge == true) ? 'checked="checked"' : 'readonly' }}>
                                            <label>Set charge per person?</label>
                                        </div>
                                    </div>
                                    <div class="row" style="{{ ($campaign->set_charge == false) ? 'display:none' : '' }}" id="charge-div-{{ $campaign->id }}">
                                        <h4><b>Per Person Charge</b></h4>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span><input value="{{ $campaign->charge }}" id="charge" name="charge" type="number" min="1" step='0.01' class="form-control" placeholder="0.00" readonly>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <button id="{{ $campaign->id }}" type="button" class="btn btn-info close-campaign-button">Wrap it up!</button>
                                    <a href="" id="modal-link-button"><button type="submit" class="btn btn-success">Submit</button></a>
                                    <button id="{{ $campaign->id }}" type="button" class="btn btn-danger delete-campaign-button">Delete</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
@endsection

@section('footer')
    <script>
        $(document).ready(function() {

            //add button js
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

            //navbar component responsivity js
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

            //checkbox functionality js
            $('#charge-div-0').hide();

            $('.checkbox').on('click', function() {
                if ($(this).find('.check-input').attr('checked') == "checked") {
                    $(this).find('.check-input').attr('checked', false);
                }
                else {
                    $(this).find('.check-input').attr('checked', 'checked');
                }
                $('#charge-div-' + $(this).attr('id')).toggle();
            });

            //delete campaign js
            $('.delete-campaign-button').on('click', function(){

                $('#delete-' + $(this).attr('id')).val($(this).attr('id'));
                $('#delete-form-' + $(this).attr('id')).submit();
            });

            //close campaign js
            $('.close-campaign-button').on('click', function(){

                $('#close-' + $(this).attr('id')).val($(this).attr('id'));
                $('#close-form-' + $(this).attr('id')).submit();
            });
        });
    </script>
@endsection