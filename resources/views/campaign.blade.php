@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{ csrf_field() }}
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
                            <div class="row">
                                <div class="col-md-6 col-sm-12">

                                    @if(!is_null($campaign->image))
                                        <img style="display:none;" src="{{ URL::asset('img/'.$campaign->image) }}">
                                    @endif
                                    <br>
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
                            </div>
                            <div class="row">
                            @if($campaign->status != 'complete')
                                @if($campaign->set_charge == false)
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span><input value="0.00" id="charge" name="charge" type="number" min="1" step='0.01' class="form-control" placeholder="0.00">
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-2 col-sm-2 col-xs-6">
                                    <button class = "btn btn-success" id="purchaseButton">Pay</button>
                                </div>
                            @else
                                <p>This campaign is closed!</p>
                            @endif
                            </div>
                        </div>
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

            var tokenLaravel = $('input[name="_token"]').val();

            var charge = '{{ ($campaign->set_charge == true) ? $campaign->charge : 0}}';

            if ($('#charge').length) {

                $('#charge').change(function() {

                    charge = $('#charge').val();
                });
            }

            if ($('.ct-chart-os').length) {

                    var data = {
                        series: [ '{{ ($progress < $campaign->goal) ? $progress : 100 }}', '{{ (($campaign->goal - $progress) > 0) ? ($campaign->goal - $progress) : 0 }}']
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


                        var jqxhr =  $.post('{{ route('pay',['id' => $currentUser->id, 'cid' => $campaign->id]) }}',
                                {
                                    amount: charge*100,
                                    token: token.id,
                                    _token: tokenLaravel
                                })
                                .done(function(data){
                                    console.log(data.message);
                                })
                                .fail(function(data){
                                    console.log(data.message);
                                });
                    }
                });

                document.getElementById('purchaseButton').addEventListener('click', function (e) {
                    // Open Checkout with further options:
                    handler.open({
                        email: '{{$currentUser->email}}',
                        name: '{{ $campaign->name }}',
                        description: 'contribute',
                        zipCode: true,
                        currency: 'cad',
                        amount: charge*100
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
                $('.container').addClass('padding-top-2');
                $('img').width($(window).width()*0.8);
            }
            else{
                $('.container').removeClass('padding-top-2');
                $('img').width($(window).width()/4);
            }

            $('img').show();

            $(window).resize(function () {
                if($(window).width() < 770) {
                    $('.container').addClass('padding-top-2');
                    $('img').width($(window).width()*0.8);
                }
                else{
                    $('.container').removeClass('padding-top-2');
                    $('img').width($(window).width()/4);
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