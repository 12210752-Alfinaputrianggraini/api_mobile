<?php

namespace App\Http\Controllers;

use App\Models\PenggunaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use Stringable;

class PenggunaController extends Controller
{
    public function login(){
        $nip = request()->header('nip');
        $sandi = request()->header('sandi');

        $hasil = PenggunaModel::query()
                ->where('nip', $nip)->first();

        if($hasil == null){
            return response()->json([
                'pesan' => "nip $nip pengguna tidak terdaftar"
            ], 404);
        }else if (Hash:: check($sandi, $hasil->sandi)){
            $hasil->token = Str::class(16);
            $hasil->save();

            return response()->json([
                'data' => $hasil
            ]);
        }else{

            return response()->json([
                'data' => $hasil
            ]);
        }
    }

    public function logout(){
        $id = request()->user()->id;
        $p = PenggunaModel::query()->where('id', $id)->first();

        if($p != null){
            $p->token = null;
            $p->save();

            return response()->json(['data' =>1]);
        }else{
            return response()->json([
                'pesan' => 'Logout tidak berhasil, pengguna tidak tersedia'
            ], 404);
        }
    }

    public function update(){
        $id= request()->user()->id;
        $p = PenggunaModel::query()->where('id', $id)->first();

        if($p == null){
            return response()->json([
                'pesan' => 'Pengguna tidak ditemukan'
            ], 404);
        }

        $p->nip = request('nip');
        $p->email = request('email');
        $r = $p->save();

        return response()->json([
            'data' => $p
        ], $r == true ? 200 : 400);
    }

    public function simpan_photo(){
        $id = request()->user()->id;
        $p = PenggunaModel::query()->where('id', $id)->first();

        if($p == null){
            return response()->json(['pesan'=>'Pengguna tidak terdaftar'],404);
        }

        $b64foto = request('file_foto');

        if(strlen($b64foto) <1023){
            return response()->json(['pesan'=>'file foto kurang ukurannya'], 406);
        }

        $foto = base64_decode($b64foto);
        $r = Storage::put("foto/$id.jpg", $foto);

        return response()->json([
            'data' => $r
        ], $r == true ? 200 : 406);
    }

    public function photo(){
        $id = request()->user()->id;
        $file = "foto/$id.jpg";

        if(Storage::exists($file) == false){
            return response()->json([
                'pesan'=>'not found'
            ], 404);
        }
        $foto = Storage::get("foto/$id.jpg");

        return response()->withHeaders([
            'Content=type' => 'image/jpg'
        ])->setContent($foto)->send();
    }

}
