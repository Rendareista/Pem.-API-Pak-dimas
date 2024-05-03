@extends('dashboard.layouts.master')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Catatan Pemasukkan</h1>
</div>
<div class="col-lg-6">
    <form method="POST" action="/dashboard/pemasukkan/{{ $pemasukkan->id }}" class="mb-5">
        @method('PUT')
        @csrf
        <div class="mb-3">
          <label for="sumber_pemasukkan" class="form-label">sumber_pemasukkan</label>
          <input type="text" class="form-control @error('sumber_pemasukkan') is-invalid @enderror" id="sumber_pemasukkan" name="sumber_pemasukkan" required autofocus value="{{ old('sumber_pemasukkan', $pemasukkan->sumber_pemasukkan) }}">
            @error('sumber_pemasukkan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control"  rows="2">{{ $pemasukkan->deskripsi }}</textarea>
              @error('deskripsi')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>
        <div class="mb-3">
          <label for="jumlah" class="form-label">Jumlah</label>
          <input type="text" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" required value="{{ old('jumlah', $pemasukkan->jumlah) }}">
            @error('jumlah')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="tanggal_pemasukkan" class="form-label">Tanggal pemasukkan</label>
          <input type="date" class="form-control @error('tanggal_pemasukkan') is-invalid @enderror" id="tanggal_pemasukkan" name="tanggal_pemasukkan" required value="{{ old('tanggal_pemasukkan', $pemasukkan->tanggal_pemasukkan) }}">
            @error('tanggal_pemasukkan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Note</button>
      </form>
</div>
@endsection
