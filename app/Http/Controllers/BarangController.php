<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\JenisBarang;
use App\Models\Barang;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::join('jenisbarang', 'barang.id_jenisbarang', '=', 'jenisbarang.id_jenisbarang')
            ->join('kategori', 'barang.id_kategori', '=', 'kategori.id_kategori')
            ->select('barang.*', 'jenisbarang.nama_jenisbarang', 'kategori.nama_kategori')
            ->get();
        return view('halaman_admin.barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        $jenisbarang = JenisBarang::all();
        return view('halaman_admin.barang.tambah', compact('kategori', 'jenisbarang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tambah = new Barang;
        $tambah->id_kategori = $request->id_kategori;
        $tambah->id_jenisbarang = $request->id_jenisbarang;
        $tambah->nama_barang = $request->nama_barang;
        $tambah->harga_barang = $request->harga_barang;
        $tambah->stok_barang = $request->stok_barang;
        $tambah->save();

        Alert::success('Data Berhasil', 'Data Berhasil ditambahkan');
        return redirect()->route('barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::where('id_barang', $id)->first();
        return view('halaman_admin.barang.detail', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::where('id_barang', $id)->first();
        $kategori = Kategori::all();
        $jenisbarang = JenisBarang::all();
        return view('halaman_admin.barang.edit', compact('barang', 'kategori', 'jenisbarang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::where('id_barang', $id)->first();
        $barang->id_kategori = $request->id_kategori;
        $barang->id_jenisbarang = $request->id_jenisbarang;
        $barang->nama_barang = $request->nama_barang;
        $barang->harga_barang = $request->harga_barang;
        $barang->stok_barang = $request->stok_barang;
        $barang->save();

        Alert::success('Data Berhasil', 'Data Berhasil diupdate');
        return redirect()->route('barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::where('id_barang', $id)->first();
        $barang->delete();
        Alert::error('Data Berhasil', 'Data Berhasil dihapus');
        return redirect()->route('barang');
    }
}
