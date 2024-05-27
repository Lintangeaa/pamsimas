<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class tagihanController extends Controller
{
    public function index()
    {
        $tagihans = Tagihan::all();
        return view('tagihan.index', compact('tagihans'));
    }

    public function create()
    {
        $daftarPelanggan = Pelanggan::get();
        return view('tagihan.create', compact('daftarPelanggan'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'no_pelanggan' => 'string|required',
            'periode' => 'string|required',
            'jml_pemakaian' => 'string|required',
            'total' => 'string|required'

        ]);

        $pelanggan = Pelanggan::query()->where('no_pelanggan', $validateData['no_pelanggan'])->first();

        $dataTagihan = [
            'id_pelanggan' => $pelanggan->id,
            'periode' => $validateData['periode'],
            'jml_pemakaian' => $validateData['jml_pemakaian'],
            'total' => $validateData['total'],
        ];

        $tagihan = Tagihan::create($dataTagihan);

        if ($tagihan) {
            return to_route('tagihan.index')->with('success', 'Berhasil Menambah Data');
        } else {
            return to_route('tagihan.index')->with('failed', 'Gagal Menambah Data');
        }
    }

    public function edit(Request $request, string $id)
    {
        $tagihan = Tagihan::find($id);
        $daftarPelanggan = Pelanggan::get();

        return view('tagihan.edit', compact('daftarPelanggan', 'tagihan'));
    }

    public function update(Request $request, string $id)
    {

        $validateData = $request->validate([
            'no_pelanggan' => 'string|required',
            'periode' => 'string|required',
            'jml_pemakaian' => 'string|required',
            'total' => 'string|required'

        ]);

        // dd($validateData);

        $pelanggan = Pelanggan::query()->where('no_pelanggan', $validateData['no_pelanggan'])->first();

        $dataTagihan = [
            'id_pelanggan' => $pelanggan->id,
            'periode' => $validateData['periode'],
            'jml_pemakaian' => $validateData['jml_pemakaian'],
            'total' => $validateData['total'],
        ];

        $tagihan = Tagihan::query()->where('id', $id)->update($dataTagihan);

        if ($tagihan) {
            return to_route('tagihan.index')->with('success', 'Berhasil Mengubah Data');
        } else {
            return to_route('tagihan.index')->with('failed', 'Gagal Mengubah Data');
        }
    }

    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();
        if ($tagihan) {
            return to_route('tagihan.index')->with('success', 'Berhasil Meenghapus Data');
        } else {
            return to_route('tagihan.index')->with('failed', 'Gagal Menghapus Data');
        }
    }

    public function cariTagihan(Request $request)
    {
        $query = Tagihan::query()->doesntHave('pembayaran');

        if ($request->filled('no_pelanggan')) {
            $query->whereHas('pelanggan', function ($q) use ($request) {
                $q->where('no_pelanggan', 'like', '%' . $request->no_pelanggan . '%');
            });
        }

        if ($request->filled('periode')) {
            $query->where('periode', 'like', '%' . $request->periode . '%');
        }

        if ($request->filled('jml_pemakaian')) {
            $query->where('jml_pemakaian', 'like', '%' . $request->jml_pemakaian . '%');
        }

        if ($request->filled('total')) {
            $query->where('total', 'like', '%' . $request->total . '%');
        }

        $listTagihan = $query->get();

        return view('tagihan.cari', [
            'listTagihan' => $listTagihan,
            'noPelanggan' => $request->no_pelanggan,
            'periode' => $request->periode,
            'jmlPemakaian' => $request->jml_pemakaian,
            'total' => $request->total
        ]);
    }

}
