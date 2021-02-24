<?php

namespace App\Http\Controllers;

use App\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    
    public function index(){

        $siswa = Siswa::paginate(5);

        $data['siswa'] = $siswa;
        
        return view('siswa.index', $data);

    }

    public function add(){

        return view('siswa.add');

    }
    
    public function edit($id){

        $siswa = Siswa::where('id', $id);

        $data['siswa'] = $siswa->get();

        return view('siswa.add', $data);

    }

    public function store(Request $request){

        $nama       = $request->input('nama');
        $alamat     = $request->input('alamat');
        $telepon    = $request->input('telepon');

        $siswa      = new Siswa();

        $siswa->nama    = $nama;
        $siswa->alamat  = $alamat;
        $siswa->telepon = $telepon;

        $siswa->save();

        return redirect('/siswa');

    }

    public function update(Request $request, $id){

        $nama       = $request->input('nama');
        $alamat     = $request->input('alamat');
        $telepon    = $request->input('telepon');

        $siswa      = Siswa::where('id', $id)->first();

        $siswa->nama    = $nama;
        $siswa->alamat  = $alamat;
        $siswa->telepon = $telepon;

        $siswa->save();

        return redirect('/siswa');

    }
    
    public function delete($id){

        $siswa = Siswa::where('id', $id)->first();
        $siswa->delete();

        return redirect('/siswa');

    }
}
