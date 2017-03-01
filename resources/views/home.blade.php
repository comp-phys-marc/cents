@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="card card-mini">
                    <div class="card-header">
                        <div class="card-title">My Campaigns</div>
                        <ul class="card-action">
                            <li>
                                <a href="/">
                                    <div class="btn btn-default pull-right">+</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body no-padding table-responsive">
                        <table class="table card-table">
                            <thead>
                            <tr>
                                <th>Products</th>
                                <th class="right">Amount</th>
                                <th>Status</th>
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
                    </div>
                    <div class="card-body no-padding table-responsive">
                        <table class="table card-table">
                            <thead>
                            <tr>
                                <th>Products</th>
                                <th class="right">Amount</th>
                                <th>Status</th>
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
        </div>
    </div>
</div>
@endsection
