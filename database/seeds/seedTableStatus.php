<?php

use App\Model\Status;
use Illuminate\Database\Seeder;

class seedTableStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'cites'=>[
                'Unknown',
                'APPENDIX I',
                'APPENDIX II',
                'APPENDIX III'
            ],
            'iucn'=>[
                'Unknown',
                'EX',
                'EW',
                'CR',
                'EN',
                'VU',
                'NT',
                'LC',
                'DD'
            ]
        ];
        $iucn = [
            'Tidak Diketahui',
            'Extinct (punah)',
            'Extinct in the Wild',
            'Critically Endangered',
            'Endangered',
            'Vulnerable',
            'Near Threatened',
            'Least Concern',
            'Data Deficient'
        ];

        foreach ($status as $key => $value) {
            foreach ($value as $k => $v) {
                Status::create([
                    'type'=>$key,
                    'name'=>$v,
                    'description' => $key == 'iucn' ? $iucn[$k] : null
                ]);
            }
        }
    }
}
