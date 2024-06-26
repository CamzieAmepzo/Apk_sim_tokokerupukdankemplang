@extends('template.admin')

@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Kelola Barang</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    {{-- <div class="card-box mb-30"> --}}
                    <div class="pd-20">
                        <a href="{{ route('barang_tambah') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Nama Barang</th>
                                    <th>Tanggal Produksi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $i)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $i->nama_barang }}</td>
                                        <td>{{ $i->tanggal_produksi }}</td>
                                        <td>{{ $i->alamat_alamat }}</td>
                                        <td>{{ $i->status }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('siswa_edit', $i->id_siswa) }}"><i
                                                            class="dw dw-edit2"></i>
                                                        Edit</a>
                                                    <form action="{{ route('barang_hapus', $i->id_siswa) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="ml-3"
                                                            style="background-color: white; border:none"><i
                                                                class="dw dw-delete-3 mr-2"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
