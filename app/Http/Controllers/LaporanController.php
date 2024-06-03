<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Models\LaporanPendapatan;
use App\Models\LaporanPengeluaran;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('halaman_admin.laporan.laporan');
    }

    public function laporan_keungan_bulanan()
    {
        // $laporan = Laporan::all();
        $user_pegawai1 = User::where('status', 'pegawai1')->first();
        $user_pegawai2 = User::where('status', 'ketua_pegawai2')->first();
        $laporan_pendapatan = Laporan::where('status', 'pendapatan')->get();
        $laporan_pengeluaran = Laporan::where('status', 'pengeluaran')->get();
        $jumlah = DB::table('laporan')
            ->select(
                DB::raw('SUM(jumlah_pendapatan) as pendapatan'),
                DB::raw('SUM(jumlah_pengeluaran) as pengeluaran')
            )->first();
        // return view('halaman_admin.laporan.laporan_keungan_bulanan', compact('laporan', 'jumlah'));
        return view('halaman_admin.laporan.laporan_keungan_bulanan', compact('laporan_pendapatan', 'laporan_pengeluaran', 'jumlah', 'user_pegawai1', 'user_pegawai2'));
    }

    public function cari_bulan(Request $request)
    {
        $periode = $request->periode;
        $user_kepsek = User::where('status', 'kepsek')->first();
        $user_yayasan = User::where('status', 'ketua_yayasan')->first();

        // $cari = DB::table('laporan');
        $cari = Laporan::where('status', 'pendapatan');
        $cari2 = Laporan::where('status', 'pengeluaran');
        $cari_bulan = DB::table('laporan')
            ->select(DB::raw('SUM(jumlah_pendapatan) as pendapatan'), DB::raw('SUM(jumlah_pengeluaran) as pengeluaran'));

        if ($request->periode) {
            $hasil = $cari->whereMonth('tanggal_pendapatan', [$request->periode])->orwhereMonth('tanggal_pengeluaran', [$request->periode]);
            $hasil2 = $cari->whereMonth('tanggal_pendapatan', [$request->periode])->orwhereMonth('tanggal_pengeluaran', [$request->periode]);
            $hasil3 = $cari_bulan->whereMonth('tanggal_pendapatan', [$request->periode])->orwhereMonth('tanggal_pengeluaran', [$request->periode]);
        } else {
            $hasil = $cari;
            $hasil2 = $cari2;
            $hasil3 = $cari_bulan;
        }

        $laporan_pendapatan = $hasil->get();
        $laporan_pengeluaran = $hasil2->get();
        $jumlah = $hasil3->first();
        return view('halaman_admin.laporan.laporan_keungan_bulanan', compact('laporan_pendapatan', 'laporan_pengeluaran', 'jumlah', 'user_pegawai1', 'user_pegawai2'));
    }

    public function print($periode)
    {
        $laporan = DB::table('laporan')->whereMonth('tanggal_pendapatan', [$periode])->orwhereMonth('tanggal_pengeluaran', [$periode])->get();
        $jumlah = DB::table('laporan')
            ->select(DB::raw('SUM(jumlah_pendapatan) as pendapatan'), DB::raw('SUM(jumlah_pengeluaran) as pengeluaran'))
            ->whereMonth('tanggal_pendapatan', [$periode])->orwhereMonth('tanggal_pengeluaran', [$periode])->first();
        return view('halaman_admin.print.print', compact('laporan', 'jumlah'));
    }

    public function print1()
    {
        // $laporan = Laporan::all();
        $user_pegawai1 = User::where('status', 'pegawai1')->first();
        $user_pegawai2= User::where('status', 'pegawai2')->first();
        $laporan_pendapatan = Laporan::where('status', 'pendapatan')->get();
        $laporan_pengeluaran = Laporan::where('status', 'pengeluaran')->get();
        $jumlah = DB::table('laporan')
            ->select(
                DB::raw('SUM(jumlah_pendapatan) as pendapatan'),
                DB::raw('SUM(jumlah_pengeluaran) as pengeluaran')
            )->first();
        return view('halaman_admin.print.print', compact('laporan_pendapatan', 'laporan_pengeluaran', 'jumlah', 'user_pegawai1', 'user_pegawai2'));
    }

    public function laporan_keungan_tahunan()
    {
        $tahunan = DB::table('laporan')
            ->select(
                DB::raw('YEAR(tanggal_pendapatan) AS pendapatan_tahunan'),
                DB::raw('YEAR(tanggal_pengeluaran) AS pengeluaran_tahunan'),
                DB::raw('MONTH(tanggal_pendapatan) AS pendapatan_bulan'),
                DB::raw('MONTH(tanggal_pengeluaran) AS pengeluaran_bulan'),
                DB::raw('SUM(jumlah_pendapatan) AS TotalPendapatan'),
                DB::raw('SUM(jumlah_pengeluaran) AS TotalPengeluaran')
            )
            ->get();
        return view('halaman_admin.laporan.laporan_keuangan_tahunan', compact('tahunan'));
    }

    public function cari_tahunan(Request $request)
    {
        $periode_tahunan = $request->periode_tahunan;

        $cari_tahunan = DB::table('laporan')
            ->select(
                DB::raw('YEAR(tanggal_pendapatan) AS pendapatan_tahunan'),
                DB::raw('YEAR(tanggal_pengeluaran) AS pengeluaran_tahunan'),
                DB::raw('MONTH(tanggal_pendapatan) AS pendapatan_bulan'),
                DB::raw('MONTH(tanggal_pengeluaran) AS pengeluaran_bulan'),
                DB::raw('SUM(jumlah_pendapatan) AS TotalPendapatan'),
                DB::raw('SUM(jumlah_pengeluaran) AS TotalPengeluaran')
            );
        if ($request->periode_tahunan) {
            $result = $cari_tahunan->whereYear('tanggal_pendapatan', [$request->periode_tahunan])->orwhereYear('tanggal_pengeluaran', [$request->periode_tahunan]);
        } else {
            $result = $cari_tahunan;
        }
        $tahunan = $result->get();
        return view('halaman_bendahara.laporan.laporan_keuangan_tahunan', compact('tahunan', 'periode_tahunan'));
    }

    public function print_tahun($periode_tahunan)
    {
        $tahunan = DB::table('laporan')
            ->select(
                DB::raw('YEAR(tanggal_pendapatan) AS pendapatan_tahunan'),
                DB::raw('YEAR(tanggal_pengeluaran) AS pengeluaran_tahunan'),
                DB::raw('MONTH(tanggal_pendapatan) AS pendapatan_bulan'),
                DB::raw('MONTH(tanggal_pengeluaran) AS pengeluaran_bulan'),
                DB::raw('SUM(jumlah_pendapatan) AS TotalPendapatan'),
                DB::raw('SUM(jumlah_pengeluaran) AS TotalPengeluaran')
            )->whereYear('tanggal_pendapatan', [$periode_tahunan])->orwhereYear('tanggal_pengeluaran', [$periode_tahunan])->get();
        // dd($tahunan);
        return view('halaman_admin.print.print_tahunan', compact('tahunan'));
    }

    public function print_tahun1()
    {
        $tahunan = DB::table('laporan')
            ->select(
                DB::raw('YEAR(tanggal_pendapatan) AS pendapatan_tahunan'),
                DB::raw('YEAR(tanggal_pengeluaran) AS pengeluaran_tahunan'),
                DB::raw('MONTH(tanggal_pendapatan) AS pendapatan_bulan'),
                DB::raw('MONTH(tanggal_pengeluaran) AS pengeluaran_bulan'),
                DB::raw('SUM(jumlah_pendapatan) AS TotalPendapatan'),
                DB::raw('SUM(jumlah_pengeluaran) AS TotalPengeluaran')
            )
            ->get();
        return view('halaman_admin.print.print_tahunan', compact('tahunan'));
    }
}

