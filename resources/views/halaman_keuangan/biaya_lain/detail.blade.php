@extends('template.admin')

@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Detail Pengeluaran Lain <a href="{{ route('pembayaran_lain') }}"
                                        class="btn btn-info">Kembali</a></h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">Nomor</th>
                                    <th>Waktu Pembayaran</th>
                                    <th>Nomonal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail as $i)
                                    <tr>
                                        <td class="table-plus">{{ $loop->iteration }}</td>
                                        <td>{{ date('d/F/Y', strtotime($i->tanggal)) }}/ {{ $i->waktu }}</td>
                                        <td>Rp.{{ number_format($i->nominal) }}</td>
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
