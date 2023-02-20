<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use \App\Models\KasModel;

class KasMasukSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 1; $i <= 50; $i++) {
            $data = [
                'kode_kas' => $faker->randomNumber(5, true),
                'keterangan_kas' => 'Kas Masuk',
                'tgl_kas' => '2023-01-31',
                'jumlah_kas' => 100000,
                'jenis_kas' => 'masuk',
                'kas_keluar' => 0,
                'nama_pengguna' =>  $faker->firstName()
            ];
            $this->KasModel = new KasModel();
            $this->KasModel->save($data);
        }
    }
}
