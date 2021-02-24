<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    
    public function index(){

        $pegawai = Pegawai::paginate(10);

        $data['pegawai'] = $pegawai;
        
        return view('pegawai.index', $data);

    }
    
    public function loadData(){

        $pegawai = Pegawai::paginate(10);

        return response()->json([
            'pegawai' => $pegawai
        ]);

    }
    
    public function detail($id){

        $pegawai = Pegawai::find($id);

        return response()->json([
            'pegawai' => $pegawai
        ]);

    }

    public function store(Request $request){

        $nama       = $request->input('_param_nama');
        $alamat     = $request->input('_param_alamat');
        $telepon    = $request->input('_param_telepon');

        $pegawaiSave            = new Pegawai();
        $pegawaiSave->nama      = $nama;
        $pegawaiSave->alamat    = $alamat;
        $pegawaiSave->telepon   = $telepon;

        $pegawaiSave->save();

        $pegawai = Pegawai::paginate(10);

        return response()->json([
            'pegawai' => $pegawai
        ]);

    }

    public function update(Request $request, $id){

        $nama       = $request->input('_param_nama');
        $alamat     = $request->input('_param_alamat');
        $telepon    = $request->input('_param_telepon');

        $pegawaiSave            = Pegawai::find($id);
        $pegawaiSave->nama      = $nama;
        $pegawaiSave->alamat    = $alamat;
        $pegawaiSave->telepon   = $telepon;

        $pegawaiSave->save();

        $pegawai = Pegawai::paginate(10);

        return response()->json([
            'pegawai' => $pegawai
        ]);

    }
    
    public function delete($id){

        $siswa = Pegawai::where('id', $id)->first();
        $siswa->delete();

        $pegawai = Pegawai::paginate(10);

        return response()->json([
            'pegawai' => $pegawai
        ]);

    }

}
