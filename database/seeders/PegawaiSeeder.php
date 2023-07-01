<?php

namespace Database\Seeders;

use App\Models\PegawaiModel;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PegawaiModel::query()->create([
            'nip'=> '12210752',
            'nama_lengkap' => 'Putri Rahmi Velijha Priwida',
            'jenis_kelamin' => 'P',
            'jabatan' => 'Manager',
            'alamat' => 'Jl. Abdul Rahman Saleh No.18',
            'no_hp' => '088247705726',
            'lokasi' => '-0.05854091845224784, 109.35609233068816',
            'pengguna_id' => 1
        ]);
    }
}
