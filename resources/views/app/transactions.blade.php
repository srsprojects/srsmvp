@extends('layouts.app');

@section('title','My Transactions')

@section('content')
    
<div class="nk-block-head">
    <div class="nk-block-between-md g-4">
        <div class="nk-block-head-content">
            <h2 class="nk-block-title fw-normal">Your Activities History</h2>
            <div class="nk-block-des">
                <p>See full list of your Transactions and Recyclables Collections on your account</p>
            </div>
        </div>
        <div class="nk-block-head-content">
            <ul class="nk-block-tools gx-3">
                <li class="order-md-last"><a href="#" class="btn btn-primary"><span>Deposit</span> <em class="icon ni ni-arrow-long-right"></em></a></li>
                <li><a href="#" class="btn btn-white btn-light"><em class="icon ni ni-download-cloud"></em><span><span class="d-none d-sm-inline-block">Download</span> Statement</span></a></li>
            </ul>
        </div>
    </div>
</div><!-- .nk-block-head -->
<ul class="nk-nav nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('transactions.index') }}">Transactions History</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('recyclables.index') }}">Recyclables History</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Scheduled <span class="badge bg-primary">0</span></a>
    </li>
</ul><!-- .nav-tabs -->
<div class="nk-block nk-block-sm">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h6 class="nk-block-title">All Orders</h6>
            </div>
            <ul class="nk-block-tools gx-3">
                <li>
                    <div class="form-group">
                        <div class="custom-control custom-control-xs custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="checkbox">
                            <label class="custom-control-label" for="checkbox"><span class="d-none d-sm-inline-block">Show</span> Cancelled</label>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#" class="search-toggle toggle-search btn btn-icon btn-trigger" data-target="search"><em class="icon ni ni-search"></em></a>
                </li>
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle btn btn-icon btn-trigger mx-n2" data-bs-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-setting"></em></a>
                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                            <ul class="link-check">
                                <li><span>Show</span></li>
                                <li class="active"><a href="#">10</a></li>
                                <li><a href="#">20</a></li>
                                <li><a href="#">50</a></li>
                            </ul>
                            <ul class="link-check">
                                <li><span>Order</span></li>
                                <li class="active"><a href="#">DESC</a></li>
                                <li><a href="#">ASC</a></li>
                            </ul>
                            <ul class="link-check">
                                <li><span>Density</span></li>
                                <li class="active"><a href="#">Regular</a></li>
                                <li><a href="#">Compact</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul><!-- .nk-block-tools -->
        </div>
        <div class="search-wrap search-wrap-extend" data-search="search">
            <div class="search-content">
                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                <input type="text" class="form-control form-control-sm border-transparent form-focus-none" placeholder="Quick search by user">
                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
            </div>
        </div><!-- .search-wrap -->
    </div><!-- .nk-block-head -->
    <div class="col-xxl-8">
        <div class="card card-bordered card-full">
            <div class="card-inner">
                <div class="card-title-group">
                    <div class="card-title">
                        <h6 class="title"><span class="me-2">Transaction</span> <a href="#" class="link d-none d-sm-inline">See History</a></h6>
                    </div>
                    <div class="card-tools">
                        <ul class="card-tools-nav">
                            <li><a href="#"><span>Paid</span></a></li>
                            <li><a href="#"><span>Pending</span></a></li>
                            <li class="active"><a href="#"><span>All</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-inner p-0 border-top">
                <div class="nk-tb-list nk-tb-orders">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span>Order No.</span></div>
                        <div class="nk-tb-col tb-col-sm"><span>Customer</span></div>
                        <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                        <div class="nk-tb-col tb-col-lg"><span>Ref</span></div>
                        <div class="nk-tb-col"><span>Amount</span></div>
                        <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
                        <div class="nk-tb-col"><span>&nbsp;</span></div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <span class="tb-lead"><a href="#">#95954</a></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-sm bg-purple">
                                    <span>AB</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Abu Bin Ishtiyak</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                            <span class="tb-sub">02/11/2020</span>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub text-primary">SUB-2309232</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">4,596.75 <span>USD</span></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="badge badge-dot badge-dot-xs bg-success">Paid</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <span class="tb-lead"><a href="#">#95850</a></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-sm bg-azure">
                                    <span>DE</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Desiree Edwards</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                            <span class="tb-sub">02/02/2020</span>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub text-primary">SUB-2309154</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">596.75 <span>USD</span></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="badge badge-dot badge-dot-xs bg-danger">Canceled</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <span class="tb-lead"><a href="#">#95812</a></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-sm bg-warning">
                                    <img src="./images/avatar/b-sm.jpg" alt="">
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Blanca Schultz</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                            <span class="tb-sub">02/01/2020</span>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub text-primary">SUB-2309143</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">199.99 <span>USD</span></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="badge badge-dot badge-dot-xs bg-success">Paid</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <span class="tb-lead"><a href="#">#95256</a></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-sm bg-purple">
                                    <span>NL</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Naomi Lawrence</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                            <span class="tb-sub">01/29/2020</span>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub text-primary">SUB-2305684</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1099.99 <span>USD</span></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="badge badge-dot badge-dot-xs bg-success">Paid</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <span class="tb-lead"><a href="#">#95135</a></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-sm bg-success">
                                    <span>CH</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Cassandra Hogan</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-md">
                            <span class="tb-sub">01/29/2020</span>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub text-primary">SUB-2305564</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1099.99 <span>USD</span></span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="badge badge-dot badge-dot-xs bg-warning">Due</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Notify</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-inner-sm border-top text-center d-sm-none">
                <a href="#" class="btn btn-link btn-block">See History</a>
            </div>
        </div><!-- .card -->
    </div><!-- .col -->
    <div class="text-center pt-4">
        <a href="#" class="link link-soft"><em class="icon ni ni-redo"></em><span>Load More</span></a>
    </div>
</div>

@endsection

@push('scripts')
    
@endpush

@push('styles')
    
@endpush