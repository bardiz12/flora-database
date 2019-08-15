<?php

use App\Model\Family;
use App\Model\Kategori;
use Illuminate\Database\Seeder;

class seedTableFamily extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $txt = 'Annonaceae
        Araceae
        Araliaceae
        Arecaceae
        Apiaceae
        Asteraceae
        Aspleniaceae
        Begoniaceae
        Cunoniaceae
        Cyatheaceae
        Euphorbiaceae
        Eriaceae
        Fabaceae
        Juglandaceae
        Lauraceae
        Lamiaceae
        Leguminoceae
        Malvaceae
        Melastomataceae
        Meliaceae
        Moraceae
        Orchidaceae
        Polypodiaceae
        Phyllantaceae
        Proteaceae
        Rosaceae
        Selaginellaceae
        Urticaceae
        Vitaceae';
        foreach (explode("\n",$txt) as $key => $value) {
            Family::create([
                'name'=>trim($value)
            ]);
        }
        
    }
}
