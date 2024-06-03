<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = JenisBarang::all();
        return view('halaman_admin.kelola_jenisbarang.index', compact('index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman_admin.kelola_jenisbarang.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tambah = new JenisBarang;
        $tambah->nama_jenisbarang = $request->nama_jenisbarang;
        $tambah->save();

        Alert::success('Data Berhasil', 'Data Berhasil ditambahkan');
        return redirect()->route('jenisbarang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = JenisBarang::where('id_jenisbarang', $id)->first();
        return view('halaman_admin.kelola_jenisbarang.edit', compact('edit'));
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
        $update = JenisBarang::where('id_jenisbarang', $id)->first();
        $update->nama_jenisbarang = $request->nama_jenisbarang;

        $update->save();

        Alert::success('Data Berhasil', 'Data Berhasil diupdate');
        return redirect()->route('jenisbarang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = JenisBarang::where('id_jenisbarang', $id)->first();
        $delete->delete();

        Alert::error('Data Berhasil', 'Data Berhasil dihapus');
        return redirect()->route('jenisbarang');
    }
}
