@extends('dashboard.layouts.master')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Catatan Pemasukkan</h1>
    </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show col-lg-10" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('LoginError'))
            <div class="alert alert-denger alert-dismissible fade show col-lg-10" role="alert">
                {{ session('LoginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="table-responsive-medium col-lg-10">
            <a href="/dashboard/pemasukkan/create" class="btn btn-primary mb-3">Add New Note</a>
            <form method="GET" action="/dashboard/pemasukkan/filter">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-text">Mulai Tanggal</div>
                            <input type="date" class="form-control" name="mulai_tanggal" value="{{ old('mulai_tanggal') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <div class="input-group-text">Sampai Tanggal</div>
                            <input type="date" class="form-control" name="sampai_tanggal" value="{{ old('sampai_tanggal') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped table-responsive-sm mt-3">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Sumber Pemasukkan</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemasukkans as $collect)
                    <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($collect->tanggal_pemasukkan)) }}</td>
                    <td>{{ $collect->sumber_pemasukkan }}</td>
                    <td>{{ $collect->deskripsi }}</td>
                    <td>Rp. {{ number_format($collect->jumlah) }} ,-</td>
                    <td>
                        <a href="/dashboard/pemasukkan/{{ $collect->id }}" class="badge bg-info"><i class="bi bi-eye"></i></a>
                        <a href="/dashboard/pemasukkan/{{ $collect->id }}/edit" class="badge bg-warning"><i class="bi bi-pencil-square"></i></a>
                        <form action="/dashboard/pemasukkan/{{ $collect->id }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure? ')"><i class="bi bi-trash3"></i></button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-info">
                        <td colspan="4" class="text-right"><b>TOTAL </b></td>
                        <td class="text-center">Rp. {{ number_format($totalIncome) }},-</td>
                        <td class="text-center"></td>
                    </tr>
                </tfoot>
            </table>
      </div>
@endsection
