<?php

use App\Model\Family;
use App\Model\Flora;
use App\Model\Kategori;
use App\Model\Status;
use Illuminate\Database\Seeder;

class seedTableFlora extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function csv_to_array($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }

            }
            fclose($handle);
        }
        return $data;
    }

    public function run()
    {
        $csv_file = '/Users/bard/Downloads/flora new.csv';
        
        $raw = $this->csv_to_array($csv_file,';');
        //dd($raw);
        foreach ($raw as $i => $row) {
                $col = [];
                foreach ($row as $key => $value) {
                    $col[] = $value;
                }
                //dd($col);
                $family = Family::where('name', $col['0'])->first();
                //dd($col['0']);
                $flora = new Flora();
                $flora->family_id = $family->id;
                $flora->locale_name = $col[2];
                $flora->scientific_name = $col[1];
                $flora->kategori_id = Kategori::where('name', $col[3])->first()->id;
                $flora->endemik = '-';
                $flora->images = [null,null,null,null,null];
                $flora->alt_text = [null,null,null,null,null];
                $flora->status_uu_id = (!in_array(strtolower($col[5]), ['-', 'tidak dilindungi']));
                $flora->status_iucn_id = $col[6] == '-' ? 5 : Status::where('name', $col[6])->first()->id;
                $flora->status_cites_id = $col[7] == '-' ? 1 : Status::where('name', strtoupper($col[7]))->first()->id;
                $flora->save();
        }
    }
}
