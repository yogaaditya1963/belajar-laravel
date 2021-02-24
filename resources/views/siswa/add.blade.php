@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-4 mx-auto">

            <form method="post" action="/siswa/{{ (@$siswa[0]->id != '') ? 'update' : 'store' }}/{{ @$siswa[0]->id }}">
                <div class="row">
                    <div class="col-12">
                        @csrf
                        <div class="form-group">
                            <label for="txtnama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="txtnama" placeholder="Plase fill the name ..." value="{{ @$siswa[0]->nama ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="txtalamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="txtalamat"
                                placeholder="Plase fill the address ..." value="{{ @$siswa[0]->alamat ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="txttelepon">Telepon</label>
                            <input type="text" name="telepon" class="form-control" id="txttelepon"
                                placeholder="Plase fill the phone ..." value="{{ @$siswa[0]->telepon ?? '' }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary w-100">Simpan data</button>
                    </div>
                    <div class="col-6">
                        <a href="{{ url('/siswa') }}" class="btn btn-warning w-100">Batal</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection