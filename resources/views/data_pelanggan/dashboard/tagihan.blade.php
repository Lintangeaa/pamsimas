@extends('data_pelanggan.dashboard.layout')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Daftar Tagihan Pelanggan</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>

                                    <th>Periode</th>
                                    <th>Pemakaian</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listTagihan as $tagihan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $tagihan->id_pelanggan }}</td> --}}
                                        <td>{{ $tagihan->periode }}</td>
                                        <td>{{ $tagihan->jml_pemakaian }}</td>
                                        <td>{{ $tagihan->total }}</td>
                                        <td>
                                            <div class="d-flex">
                                                {{-- <a class="btn btn-primary mx-1" href="{{ route('tagihan.edit', $tagihan->id) }}">Bayar</a> --}}

                                                <form action="{{ route('tagihan.checkout', $tagihan->id) }}" method="post">
                                                    @csrf
                                                    @method('post')
                                                    <button class="btn btn-primary">Bayar</button>
                                                </form>
                                                {{-- <form action="{{ route('tagihan.destroy', $tagihan->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Delete</button>
                                            </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
