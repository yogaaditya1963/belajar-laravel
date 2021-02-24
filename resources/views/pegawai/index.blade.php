@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-12 add-section">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger float-right mt-3 mb-2 trigger-add" data-toggle="modal"
                data-target="#exampleModal" data-toggle="tooltip" data-placement="left" title="+ Tambah data">
                + Tambah data
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col col-12" id="load-table">
            <table class="table table-sm table-bordered table-striped table-hover mt-1 mb-2">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th></th>
                </tr>
                <tbody id="load-data-table"></tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col col-12" id="load-pagination"></div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="javascript: void(0)">
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary w-100 btn-simpan" data-id="" data-dismiss="modal">Simpan data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog"
    aria-labelledby="modal-deleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-deleteLabel">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        Apakah anda yakin ingin dihapus ?
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-50" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger w-50 btn-delete" data-id="" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>

<script>


    /**
     * Render HTML to page by data paginate
     */

    function renderHTML(result){

        let resultPegawai = result.pegawai.data;
        let html = '';

        let no = 1;
        resultPegawai.map(pegawai => {
            html += `
                <tr>
                    <td class="text-center">${no}.</td>
                    <td>${pegawai.nama}</td>
                    <td>${pegawai.alamat}</td>
                    <td>${pegawai.telepon}</td>
                    <td class="text-center">

                        <a href="#" class="btn btn-primary trigger-edit" data-id="${pegawai.id}" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="right" title="Edit">Edit</a>

                        <button class="btn btn-danger trigger-delete" data-id="${pegawai.id}" data-toggle="modal" data-target="#modal-delete" data-toggle="tooltip" data-placement="right" title="Delete">Delete</button>
                    
                        </td>
                </tr>
            `;

            no++;
        });

        $('#load-data-table').html('');
        $('#load-data-table').html(html);

        /**
         * Variable pagination for all data
         */

        let startPage = result.pegawai.from; 
        let endPage = result.pegawai.last_page; 
        let toFirstPage = result.pegawai.first_page_url; 
        let prevPage = result.pegawai.prev_page_url; 
        let toLastPage = result.pegawai.last_page_url; 
        let nextPage = result.pegawai.next_page_url; 
        let currentPage = result.pegawai.current_page;

        let htmlPagination = '';

        htmlPagination += '<ul class="pagination justify-content-center">';
        htmlPagination += ' <li class="page-item">';
        htmlPagination += `     <a class="page-link to-link" data-href="${toFirstPage}" href="#">First</a>`;
        htmlPagination += ' </li>';
        
        if(prevPage == null){
            htmlPagination += ' <li class="page-item disabled">';
            htmlPagination += `     <a class="page-link" href="#">Prev</a>`;
            htmlPagination += ' </li>';
        }else{
            htmlPagination += ' <li class="page-item">';
            htmlPagination += `     <a class="page-link to-link" data-href="${prevPage}" href="#">Prev</a>`;
            htmlPagination += ' </li>';
        }


        for(var i = 1; i <= endPage; i++){
            if(i == currentPage){

                htmlPagination += `<li class="page-item disabled"><a class="page-link" href="#">${i}</a></li>`;

            }else{

                htmlPagination += `<li class="page-item"><a class="page-link to-link" data-href="{{ url('/pegawai/loadData') }}?page=${i}" href="#">${i}</a></li>`;

            }
        }

        if(nextPage == null){
            htmlPagination += ' <li class="page-item disabled">';
            htmlPagination += `     <a class="page-link" href="#">Next</a>`;
            htmlPagination += ' </li>';
        }else{
            htmlPagination += ' <li class="page-item">';
            htmlPagination += `     <a class="page-link to-link" data-href="${nextPage}" href="#">Next</a>`;
            htmlPagination += ' </li>';
        }

        htmlPagination += ' <li class="page-item">';
        htmlPagination += `     <a class="page-link to-link" data-href="${toLastPage}" href="#">Last</a>`;
        htmlPagination += ' </li>';
        htmlPagination += '</ul>';

        $('#load-pagination').html(htmlPagination);
        

    }

    $('#load-pagination').on('click', '.to-link', function(){

        let href = $(this).attr('data-href');

        loadDataPegawai(href);

    });
 
    $('.add-section').on('click', '.trigger-add', function(){

        $('[name=nama]').val('');
        $('[name=alamat]').val('');
        $('[name=telepon]').val('');

        $('.btn-simpan').attr('data-id', '');

    });
 
    $('#load-table').on('click', '.trigger-edit', function(){

        let pegawai_id = $(this).attr('data-id');
        $('.btn-simpan').attr('data-id', pegawai_id);

        $.ajax({
            dataType: 'json',
            type: 'get',
            url: `{{ url('/pegawai/${pegawai_id}') }}`,
            success: function(result){

                let id = result.pegawai.id;
                let nama = result.pegawai.nama;
                let alamat = result.pegawai.alamat;
                let telepon = result.pegawai.telepon;

                $('[name=nama]').val(nama);
                $('[name=alamat]').val(alamat);
                $('[name=telepon]').val(telepon);
                
            },
            error: function(err){
                console.log(err);
            },
        });

    });
    
    $('#load-table').on('click', '.trigger-delete', function(){

        let pegawai_id = $(this).attr('data-id');

        $('.btn-delete').attr('data-id', pegawai_id);

    });

    $('#modal-delete').on('click', '.btn-delete', function(){

        let pegawai_id = $(this).attr('data-id');

        $.ajax({
            dataType: 'json',
            type: 'post',
            url: `{{ url('/pegawai/delete/${pegawai_id}') }}`,
            data: {
                _token: "{{ csrf_token() }}",
                _method: "DELETE",
            },
            success: function(result){
                
                renderHTML(result);
                
            },
            error: function(data){
                console.log(data);
            },
        });

    });


    function loadDataPegawai(link){

        $.ajax({
            dataType: 'json',
            type: 'get',
            url: link,
            success: function(result){

                renderHTML(result);
                
            },
            error: function(err){
                console.log(err);
            },
        });
        
    }

    loadDataPegawai("{{ url('/pegawai/loadData') }}");

    /**
     * Btn Simpan for form
     */

    $('#exampleModal').on('click', '.btn-simpan', function(){
        
        let nama = $('[name=nama]').val();
        let alamat = $('[name=alamat]').val();
        let telepon = $('[name=telepon]').val();

        let pegawai_id = $(this).attr('data-id');

        let actionSubmit = (pegawai_id == '') ? `{{ url('/pegawai/store') }}` : `{{ url('/pegawai/update/${pegawai_id}') }}`;

        $.ajax({
            dataType: 'json',
            type: 'post',
            url: actionSubmit,
            data: {
                _token: "{{ csrf_token() }}",
                _param_nama: nama,
                _param_alamat: alamat,
                _param_telepon: telepon
            },
            success: function(result){
                
                renderHTML(result);

                $('[name=nama]').val('');
                $('[name=alamat]').val('');
                $('[name=telepon]').val('');

            },
            error: function(data){
                console.log(data);
            },
        });

    })

</script>

@endsection