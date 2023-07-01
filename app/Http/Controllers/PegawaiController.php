<?php

namespace App\Http\Controllers;

use App\Models\PegawaiModel;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function store(){
        $fields = [
            'nama_lengkap','jenis_kelamin', 'jabatan', 'alamat', 'lokasi'
        ];
        $data = new PegawaiModel();
        foreach($fields as $f){
            $data->$f = \request($f);
        }
        $data->pengguna_id = request()->user()->id;

        return response()->json([
            'data' => $data,
        ], $data->saveOrFail() ? 200 : 406);
    }

    public function update(PegawaiModel $p){
        $p->nip = request('nip');
        $p->nama_lengkap = request('nama_lengkap');
        $p->jenis_kelamin = request('jenis_kelamin');
        $p->jabatan = request('jabatan');
        $p->alamat = request('alamat');
        $p->no_hp = request('no_hp');
        $p->lokasi = request('lokasi');
        $r = $p->save();

        return response()->json([
            'data' => $p
        ], $r == true ? 200 : 406);
    }

    public function delete(PegawaiModel $p){
        return response()->json([
            'data' => $p->delete()
        ]);
    }

    public function show(PegawaiModel $p){
        return response()->json([
            'data' => $p
        ]);
    }
}
