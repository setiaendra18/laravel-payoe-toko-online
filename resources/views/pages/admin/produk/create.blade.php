@extends('templates.backend.main')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-left">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Penambahan Data Barang</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label><strong>Nama Produk</strong></label>
                            <input type="text" class="form-control" id="nama" aria-describedby="nama"
                                placeholder="Masukan Nama Produk ...">
                        </div>
                        <div class="form-group">
                            <label><strong>Kategori Produk</strong></label>
                            <select class="form-control" id="exampleFormControlSelect1">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                          </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
