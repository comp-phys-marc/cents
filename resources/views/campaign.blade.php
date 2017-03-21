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
                            <div class="card-title">{{ $campaign->name }}</div>
                            <ul class="card-action">
                                <li>
                                    <a href="#">
                                        <i class="icon fa fa-money"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="col-md-6 col-sm-12">
                                <p>
                                    {{ $campaign->description }}
                                </p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="col-sm-8">
                                    <div class="chart ct-chart-os ct-perfect-fourth"></div>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="chart-label">
                                        <li class="ct-label ct-series-a">Progress</li>
                                        <li class="ct-label ct-series-b">Remaining</li>
                                    </ul>
                                </div>
                            </div>
                            @if($campaign->status != 'complete')
                                <button class = "btn btn-success" id="purchaseButton">Pay</button>
                            @endif
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
@endsection

@section('footer')
    <script type="text/javascript" src="{{ URL::asset('js/vendor.js') }}"></script>
    <script>
        $(document).ready(function() {

            if ($('.ct-chart-os').length) {

                    var data = {
                        series: [ '{{ $progress }}', '{{ $campaign->goal - $progress }}']
                    };

                    var sum = function sum(a, b) {
                        return a + b;
                    };

                    new Chartist.Pie('.ct-chart-os', data, {
                        labelInterpolationFnc: function labelInterpolationFnc(value) {
                            return Math.round(value / data.series.reduce(sum) * 100) + '%';
                        },
                        startAngle: 270,
                        donut: true,
                        donutWidth: 20,
                        labelPosition: 'outside',
                        labelOffset: -30
                    });
            }

            if($('#purchaseButton').length > 0) {

                var handler = StripeCheckout.configure({
                    key: 'pk_test_wfR5LNQXkcnvYxnQHjtDd5ox',
                    locale: 'auto',
                    token: function (token) {
                        // You can access the token ID with `token.id`.
                        // Get the token ID to your server-side code for use.
                    }
                });

                document.getElementById('purchaseButton').addEventListener('click', function (e) {
                    // Open Checkout with further options:
                    handler.open({
                        email: '{{$currentUser->email}}',
                        name: '{{ $campaign->name }}',
                        description: '{{ $campaign->description }}',
                        zipCode: true,
                        currency: 'cad',
                        amount: '{{ ($campaign->set_charge == true) ? $campaign->charge : 20 }}'
                    });
                    e.preventDefault();
                });
            }


            window.addEventListener('popstate', function() {
                handler.close();
            });

            new Clipboard('.clip-button');

            $('[data-toggle="tooltip"]').on('mouseleave', function(){
                $(this).tooltip('hide');
            });

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
            });

            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip({
                    trigger: 'click'
                });
            });
        });
    </script>
@endsection