@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-12">
            <!-- Button trigger modal -->
            <a href="{{ url('siswa/add') }}" class="btn btn-danger float-right mt-3 mb-2" title="+ Tambah data">
                + Tambah data
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col col-12">
            <table class="table table-sm table-bordered table-striped table-hover mt-1 mb-2">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th></th>
                </tr>
                <?php
                        $no = 1;
                        foreach($siswa as $resultSiswa){
                    ?>
                <tr>
                    <td class="text-center"><?php echo $no; ?>.</td>
                    <td>{{ $resultSiswa->nama }}</td>
                    <td>{{ $resultSiswa->alamat }}</td>
                    <td>{{ $resultSiswa->telepon }}</td>
                    <td class="text-center">
                        <form action="{{ url('/siswa/delete/' . $resultSiswa->id) }}" method="POST">

                            <a href="{{ url('/siswa/add/' . $resultSiswa->id) }}" class="btn btn-primary"
                                data-toggle="tooltip" data-placement="right" title="Edit">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                title="Delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php $no++; } ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col col-12">
            <!-- <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul> -->

            {{ $siswa->links() }}
        </div>
    </div>
</div>
@endsection