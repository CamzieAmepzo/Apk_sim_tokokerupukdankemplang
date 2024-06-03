<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use App\Models\Pegawai;
use App\Models\Laporan;
use App\Models\DataTransaksi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DataTransaksiController extends Controller
{
    public function index()
    {
        $pilih_barang = JenisBarang::all();
        $pembayaran = Pembayaran::where('jenis_pembayaran', 'Data Transaksi')->first();
        $siswa = DataTransaksi::rightJoin('barang', 'datatransaksi.id_barang', '=', 'barang.id_barang')
            ->leftJoin('kategori', 'barang.id_kategori', '=', 'kategori.id_kategori')
            ->leftJoin('jenisbarang', 'barang.id_jenisbarang', '=', 'jenisbarang.id_jenisbarang')
            ->select(
                'datatransaksi.datatransaksi',
                'datatransaksi.id_datatransaksi',
                'jenisbarang.nama_jenisbarang',
                'datatransaksi.status as status_uang',
                'datatransaksi.id_datatransaksi',
                'datatransaksi.nominal',
            )->get();
        return view('halaman_admin.datatransaksi.index', compact('pilih_barang', 'pembayaran', 'iswa'));
    }

    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m-d');
        $waktu = date("h:i:s");
        $uang_dsp = DataTransaksi::where('id_barang', $request->id_barang)->first();
        $laporan = Laporan::where('sumber', '=', 'DataTransaksi-belum-lunas')->first();

        if ($request->nominal == 1000000) {
            $this->createDataTransaksi($request, $tanggal, $waktu);
        } elseif ($uang_dsp == null) {
            $this->createDataTransaksi($request, $tanggal, $waktu);
        } elseif ($request->id_barang == $uang_dsp->id_barang && $uang_dsp->nominal == "750000") {
            $this->updateDataTransaksi($request, $tanggal, $waktu, $uang_dsp);
        } elseif ($request->id_barang == $uang_dsp->id_barang) {
            $this->updateDataTransaksi($request, $tanggal, $waktu, $uang_dsp);
        } else {
            Alert::error('Data Gagal', 'Data Gagal Ditambah');
            return redirect()->route('DataTransaksi');
        }

        Alert::success('Data Berhasil', 'Data Berhasil Ditambah');
        return redirect()->route('DataTransaksi');
    }

    private function createDataTransaksi($request, $tanggal, $waktu)
    {
        $tambah = new DataTransaksi;
        $tambah->id_siswa = $request->id_barang;
        $tambah->nominal = $request->nominal;
        $tambah->keterangan = 'lunas';
        $tambah->status = 'lunas';
        $tambah->tanggal = $tanggal;
        $tambah->waktu = $waktu;
        $tambah->save();

        Laporan::create([
            'tanggal_pendapatan' => $tanggal,
            'tanggal_pengeluaran' => $tanggal,
            'jumlah_pendapatan' => $request->nominal,
            'umber' => 'uang Data Transaksi',
            'tatus' => 'pendapatan',
        ]);
    }

    private function updateDataTransaksi($request, $tanggal, $waktu, $uang_dsp)
    {
        $edit = DataTransaksi::where('id_barang', $request->id_barang)->update([
            'tanggal_pendapatan' => $tanggal,
            'tanggal_pengeluaran' => $tanggal,
            'nominal' => $request->nominal + $uang_dsp->nominal,
            'keterangan' => 'lunas',
            'tatus' => 'lunas',
        ]);

        Laporan::where('sumber', $laporan->sumber)->update([
            'tanggal_pendapatan' => $tanggal,
            'tanggal_pengeluaran' => $tanggal,
            'jumlah_pendapatan' => $laporan->jumlah_pendapatan + $request->nominal,
            'umber' => 'Data Transaksi',
            'tatus' => 'pendapatan',
        ]);
    }

    public function detail($id)
    {
        $detail = DataTransaksi::leftjoin('barang', 'Data_Transaksi.id_barang', '=', 'barang.id_barang')->select('Data_Transaksi.*')->where('Data_Transaksi.id_barang', $id)->get();
        $nama = DataTransaksi::leftjoin('barang', 'Data_Transaksi.id_barang', '=', 'barang.id_barang')->where('Data_Transaksi.id_barang', $id)->first();
        return view('halaman_pegawai.Data_Transaksi.detail', compact('detail', 'nama'));
    }

    public function cari(Request $request)
    {
        $pilih_barang = JenisBarang::all();
        $pembayaran = Pembayaran::where('jenis_pembayaran', 'Uang DSP')->first();
        $data = DataTransaksi::rightjoin('barang', 'Data_Transaksi.id_barang', '=', 'barang.id_barang')
            ->leftjoin('jenisbarang', 'barang.id_jenisbarang', '=', 'jenisbarang.id_jenisbarang')
            ->leftjoin('kategori', 'barang.id_kategori', '=', 'kategori.id_kategori')
            ->select(
                'jenisbarang.barang',
                'jenisbarang.id_jenisbarang',
                'kategori.nama_kategori',
                'barang.nama_barang',
                'Data_Transaksi.status as status_uang',
                'Data_Transaksi.id_Data_Transaksi',
                'Data_Transaksi.nominal',
                'barang.id_barang'
            );
        if ($request->cari) {
            $hasil = $data->where('jenisbarang.id_jenisbarang', $request->cari);
        } else {
            $hasil = $data;
        }
        $barang = $hasil->get();
        return view('halaman_pegawai.Data_Transaksi.index', compact('barang', 'pilih_barang', 'pembayaran'));
    }
}
