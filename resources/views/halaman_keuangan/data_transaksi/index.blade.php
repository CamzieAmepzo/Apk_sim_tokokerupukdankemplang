@extends('template.admin')

@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Data Pembayaran DataTransaksi</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <div class="pd-20">
                        <form action="{{ route('datatransaksi_cari') }}" method="POST">
                            @csrf
                            <select class="form-control" name="cari" aria-label="Default select example">
                                <option value="0">Pilih JenisBarang</option>

                                @foreach ($pilih_jenisbarang as $jb)
                                    <option value="{{ $jb->id_jenisbarang }}">{{ $jb->nama_jenisbarang }}</option>
                                @endforeach
                            </select>
                            <button style="submit" class="btn btn-primary mt-2">Cari</button>
                        </form>
                    </div>
                    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                        <div class="pb-20">
                            <table class="data-table table stripe hover nowrap">
                                <thead>
                                    <tr>
                                        <th class="table-plus datatable-nosort">Nomor</th>
                                        <th>Nama Barang</th>
                                        <th>status</th>
                                        <th class="datatable-nosort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($barang) --}}
                                    @foreach ($barang as $b)
                                        <tr class="text center">
                                            <td class="table-plus">{{ $loop->iteration }}</td>
                                            <td>{{ $i->nama_barang }}</td>
                                            <td>{{ $i->nis }}</td>
                                            <td>{{ $i->nama_kategori }}</td>
                                            <td>{{ $i->jk }}</td>
                                            <td>{{ $i->status_datatransaksi }}</td>
                                            <td>

                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    @if ($i->status_uang != 'lunas')
                                                        <a href="" class="btn btn-success" class="btn btn-primary"
                                                            id="pilih" onchange="kategori()" data-toggle="modal"
                                                            data-target="#datatransaksi{{ $b->id_barang }}"><span
                                                                class="text-capitalize">bayar</span></a>
                                                    @endif
                                                    <a href="{{ route('dsp_detail', $b->id_barang) }}"
                                                        class="btn btn-info mx-2">
                                                        Detail</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
    @foreach ($barang as $b)
        <!-- Modal -->
        <div class="modal fade" id="datatransaksi{{ $b->id_barang }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><span class="text-capitalize"> Form Pembayaran
                                DataTransaksi</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('datatransaksi') }}" method="POST">
                            @csrf
                            <select class="form-control" name="nominal" aria-label="Default select example" required>
                                <option selected>Pilih pembayaran</option>
                                @if ($b->nominal == null)
                                    <option value="{{ $pembayaran->nominal }}">Bayar Lunas</option>
                                    <option value="cicilan.250000">Cicilan 1 -- {{ number_format(250000) }}</option>
                                    <option value="cicilan.250000">Cicilan 2 -- {{ number_format(250000) }}</option>
                                    <option value="cicilan.250000">Cicilan 3 -- {{ number_format(250000) }}</option>
                                    <option value="cicilan.250000">Cicilan 4 -- {{ number_format(250000) }}</option>

                                @elseif($b->nominal == 250000)
                                    <option value="cicilan.250000">Cicilan 2 -- {{ number_format(250000) }}</option>
                                    <option value="cicilan.250000">Cicilan 3 -- {{ number_format(250000) }}</option>
                                    <option value="cicilan.250000">Cicilan 4 -- {{ number_format(250000) }}</option>

                                @elseif($b->nominal == 500000)
                                    <option value="cicilan.250000">Cicilan 3 -- {{ number_format(250000) }}</option>
                                    <option value="cicilan.250000">Cicilan 4 -- {{ number_format(250000) }}</option>

                                @elseif($b->nominal == 750000)
                                    <option value="cicilan.250000">Cicilan 4 -- {{ number_format(250000) }}</option>
                                @endif
                            </select>
                            <input type="hidden" name="id_barang" value="{{ $b->id_barang }}">
                            <div class="form-group">
                                <label class="control-label"> Nominal</label>
                                <div><input type="text" readonly="" value="{{ $pembayaran->nominal - $b->nominal }}"
                                        class="form-control"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><span
                                        class="text-capitalize">tutup</span></button>
                                <button type="submit" class="btn btn-primary"><span
                                        class="text-capitalize">simpan</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function kategori() {
            var tes = document.getElementById("pilih").value;
            console.log(tes);
            $('#JenisBarang' + tes).modal('show');

        }
    </script>
@endsection
