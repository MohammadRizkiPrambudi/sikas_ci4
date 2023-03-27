<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use \App\Models\KasModel;

class KasKeluarSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 1; $i <= 4; $i++) {
            $data = [
                'kode_kas' => $faker->randomNumber(5, true),
                'keterangan_kas' => 'Kas Keluar',
                'tgl_kas' => date('Y-m-d'),
                'jumlah_kas' => 0,
                'jenis_kas' => 'keluar',
                'kas_keluar' => 10000,
                'nama_pengguna' =>  $faker->firstName()
            ];
            $this->KasModel = new KasModel();
            $this->KasModel->save($data);
        }
    }
}
