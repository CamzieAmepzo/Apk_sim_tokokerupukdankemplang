@extends('template.admin')

@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Kelola Barang / Edit Data</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pd-20 card-box mb-30">
                    <form action="{{ route('Barang_edit', $edit->id_) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">JenisBarang</label>
                            <div class="col-sm-12 col-md-10">
                                <select class="custom-select col-12" name="id_jenisbarang" required>
                                    @php
                                        $jenisbarang1 = DB::table('jenisbarang')
                                            ->where('id_jenisbarang', '=', $edit->id_jenisbarang)
                                            ->first();
                                    @endphp
                                    <option value="{{ $jenisbarang1->id_jenisbarang }}">{{ $jenisbarang1->jenisbarang }} --
                                        {{ $jenisbarang1->nama_jenisbarang }}</option>
                                    @foreach ($jenisbarang as $k)
                                        <option value="{{ $k->id_jenisbarang }}">{{ $k->jenisbarang }} -- {{ $k->nama_jenisbarang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Kategori</label>
                            <div class="col-sm-12 col-md-10">
                                <select class="custom-select col-12" name="id_kategori" required>
                                    @php
                                        $ju = DB::table('kategori')
                                            ->where('id_kategori', '=', $edit->id_kategori)
                                            ->first();
                                    @endphp
                                    <option value="{{ $ju->id_kategori }}">{{ $ju->nama_kategori }}</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id_kategori }}">{{ $j->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="nama_barang" value="{{ $edit->nama_barang }}"
                                    placeholder="inputkan nama jenisbarang" type="text" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Tanggal Produksi</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="tanggal_lahir" value="{{ $edit->tanggal_produksi }}"
                                    placeholder="Inputkan Username" type="date" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Alamat</label>
                            <div class="col-sm-12 col-md-10">
                                <textarea class="form-control" name="alamat_siswa" placeholder="Inputkan Alamat"
                                    required>{{ $edit->alamat_siswa }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Status Barang</label>
                            <div class="col-sm-12 col-md-10">
                                <select class="custom-select col-12" name="status" required>
                                    <option value="{{ $edit->status }}">{{ $edit->status }}</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Submit</button>
                        <a href="{{ route('jenisbarang') }}" class="btn btn-danger">Kembali</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
