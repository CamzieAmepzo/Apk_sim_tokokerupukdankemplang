<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class pegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = Pegawai::all();
        return view('halaman_admin.kelola_pegawai.index', compact('index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman_admin.kelola_pegawai.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tambah = new Pegawai;
        $tambah->nama_pegawai = $request->nama_pegawai;
        $tambah->alamat = $request->alamat;
        $tambah->status = $request->status;
        $tambah->save();
        Alert::success('Data Berhasil', 'Data Berhasil ditambahkan');
        return redirect()->route('pegawai');
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
        $edit = Pegawai::where('id_pegawai', $id)->first();
        return view('halaman_admin.kelola_pegawai.edit', compact('edit'));
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
        $update = Pegawai::where('id_pegawai', $id)->first();
        $update->nama_pegawai = $request->nama_pegawai;
        $update->alamat = $request->alamat;
        $update->status = $request->status;
        $update->save();
        Alert::success('Data Berhasil', 'Data Berhasil diupdate');
        return redirect()->route('pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Pegawai::where('id_pegawai', $id)->first();
        $delete->delete();
        Alert::error('Data Berhasil', 'Data Berhasil dihapus');
        return redirect()->route('pegawai');
    }
}
