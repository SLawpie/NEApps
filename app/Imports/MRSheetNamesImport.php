<?php

namespace App\Imports;

use App\MedExamintaion;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;

class MRSheetNamesImport implements WithEvents
{

    public $sheetNames;

    public function __construct()
    {
        $this->sheetNames = [];
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) 
                {
                    $this->sheetNames[] = $event->getSheet()->getTitle();
                }
        ];
    }

    public function getSheetNames() 
    {
        return $this->sheetNames;
    }
}
