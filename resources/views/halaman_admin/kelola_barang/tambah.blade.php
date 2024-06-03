@extends('template.admin')

@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Kelola Barang / Tambah Data</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <form action="{{ route('Barang_tambah') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Jenis Barang</label>
                            <div class="col-sm-12 col-md-10">
                                <select class="custom-select col-12" name="id_kelas" required>
                                    <option selected="">Pilih Jenis Barang...</option>
                                    @foreach ($jenisbarang as $j)
                                        <option value="{{ $j->id_jenisbarang }}">{{ $j->jenisbarang }} -- {{ $j->nama_jenisbarang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Kategori</label>
                            <div class="col-sm-12 col-md-10">
                                <select class="custom-select col-12" name="id_kategori" required>
                                    <option selected="">Pilih Kategori...</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="nama_barang" placeholder="inputkan nama Barang"
                                    type="text" required>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="tanggal_Produksi" placeholder="Tanggal Produksi" type="date"
                                    required>
                            </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Alamat</label>
                            <div class="col-sm-12 col-md-10">
                                <textarea class="form-control" name="alamat_alamat" placeholder="Inputkan Alamat"
                                    required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Status Barang</label>
                            <div class="col-sm-12 col-md-10">
                                <select class="custom-select col-12" name="status" required>
                                    <option selected="">Status Barang...</option>
                                    <option value="Aktif">Layak</option>
                                    <option value="Tidak Aktif">Tidak Layak</option>
                                </select>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Submit</button>
                        <a href="{{ route('kelas') }}" class="btn btn-danger">Kembali</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
