<?php

namespace App\Http\Controllers;

use App\Models\Draf;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Laporan;
use App\Models\LaporanPendapatan;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = Draf::leftjoin('jurusan', 'draf_pendaftaran.id_JenisBarang', '=', 'jurusan.id_JenisBarang')->select('draf_pendaftaran.*', 'jurusan.nama_JenisBarang')->get();
        $pembayaran = Pembayaran::where('jenis_Transaksi', '=', 'Data Transaksi')->first();
        return view('halaman_admin.pendaftaran.index', compact('index', 'Transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halaman_admin.pendaftaran.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m-d');

        $tambah = new Draf;
        $tambah->nama_barang = $request->nama_barang;
        $tambah->id_barang = $request->id_barang;
        $tambah->tanggal = $tanggal;
        $tambah->save();
        Alert::success('Data Berhasil', 'Data Berhasil Ditambah');
        return redirect()->route('pendaftaran');
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
        $edit = Draf::where('id_draf', $id)->first();
        $jurusan = DB::table('Jenis Barang')->get();
        return view('halaman_admin.pendaftaran.edit', compact('edit', 'Jenis Barang'));
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
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m-d');

        $update = Draf::where('id_draf', $id)->first();
        $update->nama_barang = $request->nama_barang;
        $update->id_jenisbarang = $request->id_jenisbarang;
        $update->tanggal = $tanggal;
        $update->save();

        Alert::success('Data Berhasil', 'Data Berhasil Diupdate');
        return redirect()->route('pendaftaran');
    }

    public function bayar(Request $request, $id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m-d');
        $bayar = Draf::where('id_draf', $id)->first();
        $bayar->bayar = $request->bayar;
        $bayar->save();

        // INSERT DATA KE LAPORAN
        Laporan::create([
            'tanggal_pendapatan' => $tanggal,
            'tanggal_pengeluaran' => $tanggal,
            'jumlah_pendapatan' => $request->bayar,
            'sumber' => 'uang pendaftaran',
            'status' => 'pendapatan',
        ]);
        // $laporan = DB::table('laporan_pendapatan')->where('tanggal', '=', $tanggal)->first();

        // // jika data pada laporan kosong atau tanggal nya kosong
        // if ($laporan == Null || $laporan->tanggal == Null) {

        //     LaporanPendapatan::create([
        //         'tanggal' => $tanggal,
        //         'jumlah' => $request->bayar,
        //         'sumber' => 'uang pendaftaran',
        //     ]);
        // }
        // // jika data laporan nya ada dan tanggal sama dengan tanggal dari inputanan
        // elseif ($laporan != Null && $tanggal == $laporan->tanggal) {
        //     LaporanPendapatan::where('tanggal', $tanggal)->update([
        //         'jumlah' => $laporan->jumlah + $request->bayar,
        //     ]);
        // }
        // // jika tidak ada logika diatas
        // else {
        //     LaporanPendapatan::create([
        //         'tanggal' => $tanggal,
        //         'jumlah' => $request->bayar,
        //         'sumber' => 'uang pendaftaran',
        //     ]);
        // }
        Alert::success('Data Berhasil', 'Data Berhasil Diupdate');
        return redirect()->route('pendaftaran');
    }

    public function barang(Request $request, $id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m-d');
        $waktu = date("h:i:s");

        $kategori = new barang;
        $kategori->id_barang = $request->id_barang;
        $kategori->id_jenisbarang = $request->id_jenisbarang;
        $kategori->nama_barang = $request->nama_barang;
        $kelas->status = 'Aktif';

        $kategori->save();
        Pendaftaran::create([
            'nominal' => $request->bayar,
            'nama_siswa' => $request->nama_,
            'waktu' => $waktu,
            'tanggal' => $tanggal,
        ]);
        Draf::where('id_draf', $id)->delete();
        Alert::success('Data Berhasil', 'Barang Baru Berhasil ditambahkan');
        return redirect()->route('pendaftaran');
    }
    public function destroy($id)
    {
        $hapus = Draf::where('id_pendaftaran', $id)->first();
        $hapus->delete();

        Alert::error('Data Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('pendaftaran');
    }
}
