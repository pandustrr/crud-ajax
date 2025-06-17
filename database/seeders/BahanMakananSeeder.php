<?php

namespace Database\Seeders;

use App\Models\BahanMakanan;
use Illuminate\Database\Seeder;

class BahanMakananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bahan = [
            ['nama' => 'Beras', 'satuan' => 'kg', 'stok' => 100],
            ['nama' => 'Gula', 'satuan' => 'kg', 'stok' => 50],
            ['nama' => 'Minyak Goreng', 'satuan' => 'liter', 'stok' => 30],
            ['nama' => 'Telur', 'satuan' => 'butir', 'stok' => 200],
            ['nama' => 'Ayam', 'satuan' => 'ekor', 'stok' => 20],
            ['nama' => 'Ikan', 'satuan' => 'kg', 'stok' => 15],
            ['nama' => 'Tepung Terigu', 'satuan' => 'kg', 'stok' => 40],
            ['nama' => 'Garam', 'satuan' => 'kg', 'stok' => 10],
            ['nama' => 'Bawang Merah', 'satuan' => 'kg', 'stok' => 8],
            ['nama' => 'Bawang Putih', 'satuan' => 'kg', 'stok' => 7],
        ];

        foreach ($bahan as $item) {
            BahanMakanan::create($item);
        }
    }
}
