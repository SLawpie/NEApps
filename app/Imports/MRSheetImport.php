<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use App\MRImportedSheetData;
use App\MRSettings;


class MRSheetImport implements OnEachRow
{

    public function __construct()
    {

    }


    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();
        $usg = MRSettings::where('name', 'usg')->first(); 

        if ($row[3] || $row[0])
        {
            if($row[0])
            {
                if($row[0] && ($row[1] != 'Data') && ($usg->value == 'true'))
                {
                    $data = MRImportedSheetData::create([
                        'col0' => $row[2],
                        'col1' => $row[4],
                    ]);
                }
            }
            else 
            {
                if (str_replace(' ', '', $row[3]) == 'USG')
                {
                    MRSettings::where('name', 'usg')->update([
                        'value' => 'true',
                    ]);
                }
            }
        }
    }
}