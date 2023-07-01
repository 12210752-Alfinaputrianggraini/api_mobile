<?php

namespace Database\Seeders;

use App\Models\PenggunaModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PenggunaModel::query()->create([
            'nip' => '12210753',
            'nama_lengkap' => 'Putri Rahmi Velijha Priwida',
            'sandi' => Hash::make('admin'),
            'email' => 'nanonanotime@gmail.com'
        ]);
    }
}
