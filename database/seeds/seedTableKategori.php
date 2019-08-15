<?php

use App\Model\Kategori;
use Illuminate\Database\Seeder;

class seedTableKategori extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $raw = 'Pohon
        Lapis Bawah
        Semak/Pohon
        Semak
        Lapis Bawah (invasive)
        Tumbuhan Paku
        semak/perdu
        Epifit
        Anggrek
        Perdu';

        foreach (explode("\n",$raw) as $key => $value) {
            Kategori::create([
                'name'=>trim($value),
                'description'=>null
            ]);
        }
    }
}
