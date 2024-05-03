@extends('dashboard.layouts.master')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome, {{ auth()->user()->name }}</h1>
    </div>
    <div class="row mt-2 ">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TOTAL (PEMASUKKAN) </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($totalPemasukkan) }},-</div>
                        </div>
                        <div class="col-auto" style="margin-left: -90px">
                            <i class="bi bi-wallet2" style="font-size: 50px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                TOTAL (PENGELUARAN)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($totalPengeluaran) }},-</div>
                        </div>
                        <div class="col-auto" style="margin-left: -90px">
                            <i class="bi bi-cash-stack" style="font-size: 50px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                TOTAL (SEMUA)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($totalKeseluruhan) }},-</div>
                        </div>
                        <div class="col-auto" style="margin-left: -90px">
                            <i class="bi bi-coin" style="font-size: 50px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
