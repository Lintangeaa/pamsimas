@extends('kerangka.master')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Tambah Tagihan Pelanggan</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" method="POST" action="{{ route('tagihan.store') }}">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>No Pelanggan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input list="datalistOptions" id="no_pelanggan" name="no_pelanggan"
                                        class="form-control
                                        @error('no_pelanggan') is invalid
                                        @enderror"
                                        value="{{ old('no_pelanggan') }}" placeholder="Ketik untuk mencari...">
                                    @error('no_pelanggan')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <datalist id="datalistOptions">
                                        @foreach ($daftarPelanggan as $item)
                                            <option value="{{ $item->no_pelanggan }}">
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="col-md-4">
                                    <label>Periode</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="month" id="periode" name="periode"
                                        class="form-control @error('periode') is invalid
                                @enderror"
                                        value="{{ old('periode') }}" placeholder="Periode">
                                    @error('periode')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Pemakaian</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="jml_pemakaian" name="jml_pemakaian"
                                        class="form-control @error('jml_pemakaian') is invalid
                                @enderror"
                                        value="{{ old('jml_pemakaian') }}" placeholder="Jumlah Pemakaian">
                                    @error('jml_pemakaian')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Total</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="total" name="total"
                                        class="form-control @error('total') is invalid
                                @enderror"
                                        value="{{ old('total') }}" placeholder="Total">
                                    @error('total')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
