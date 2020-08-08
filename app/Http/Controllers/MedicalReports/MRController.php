<?php

namespace App\Http\Controllers\MedicalReports;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Gate;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;

use App\Imports\MRSheetNamesImport;
use App\Imports\MRSelectSheetImport;

use Validator;

use App\MRSettings;
use App\MRImportedSheetData;
use App\MRFacility;
use App\MRExamination;
use App\MRPrice;


class MRController extends MRBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->savePath = public_path('/upload/');
        $this->paid = null;
    }

    public function test()
    {
        return view('medical_reports.test');
    }


    public function index()
    {
        return view('medical_reports.index');
    }

    public function importTestFile()
    {
        return view('medical_reports.excel');
    }

    public function importFile()
    {
        return view('medical_reports.import');
    }

    public function importTestExcel(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'file' => 'required|max:5000|mimes:xlsx,xlx,csv',
        // ]);

        $request->validate([
            'file' => 'required|file|max:5000|mimes:xls,xlsx',
        ]);
         
        //dd($request);
        $dateTime = date('Ymd_His');
        $file = $request->file('file');
        $fileName = $dateTime . '-' . $file->getClientOriginalName();
        $savePath = public_path('/upload/');
        //$file->move($savePath, $fileName);

        $import = new MedExaminationsImport();
        $ts = Excel::import($import, request()->file('file'));

        // $data = [];
        // // Return an import object for every sheet
        // foreach ($Import->getSheetNames() as $index => $sheetName) {
        //      $this->sheetData[$index] = new MedExaminationsImport();
        // }

        //dd($Import->getSheetNames());

        $sheetNames = $import->getSheetNames();

        //dd($sheetNames);

        // if ($validator->passes()){
        //     return redirect()->back()
        //         ->with(['success'=>'File upload succesfully.']);
        // } else {
        //     return redirect()->back()
        //         ->with(['errors'=>$validator->errors()->all()]);
        // }

        $request->session()->flash('success', 'File upload succesfully.');

        // return view('medicla_reportd.import')->with(
        //       'sheetNames', $sheetNames
        // );
        return view('medical_reports.excel')->with(
            'sheetNames', $sheetNames
        );
    }

    public function importExcel(Request $request){
        $request->validate([
            'file' => 'required|file|max:5000|mimes:xls,xlsx',
        ]);

        MRController::deleteUploadFiles();
        MRController::initialSettings();

        $dateTime = date('Ymd_His');
        $file = $request->file('file');
        $fileName = 'MR-' . $dateTime . '-' . $file->getClientOriginalName();
        
        $file->move($this->savePath, $fileName);

        MRSettings::where('name', 'tmp_file_name')->update([
            'value' => $fileName,
        ]);

        MRSettings::where('name', 'original_file_name')->update([
            'value' => $file->getClientOriginalName(),
        ]);

        $Import = new MRSheetNamesImport();
        $ts = Excel::import($Import, $this->savePath . $fileName);

        $this->sheetNames = $Import->getSheetNames();
      
        $request->session()->flash('success', trans('medical_reports.import.success'));

        return view('medical_reports.doctors')->with([
            'file' => $file->getClientOriginalName(),
            'sheetNames' => $this->sheetNames
        ]);
    }


    //
    // Setup initial settings
    //
    public function initialSettings()
    {
        //
        // sprawdzenie/dodanie INNYch jako 'placówki'
        // 'Others' sa zawsze 'reportable'
        // dlatego jest 'false'
        //
        $mrSettings = MRFacility::firstOrCreate(
            ['name' => 'Others'],   
            ['reportable' => 0]
        );

        $mrSettings = MRSettings::firstOrCreate(
            ['name' => 'paid'],
            ['value' => 'Płatne']
        );
        $mrSettings = MRSettings::firstOrCreate(
            ['name' => 'tmp_file_name'],
            ['value' => '']
        );
        $mrSettings = MRSettings::firstOrCreate(
            ['name' => 'original_file_name'],
            ['value' => '']
        );
        $mrSettings = MRSettings::firstOrCreate(
            ['name' => 'usg'],
            ['value' => 'false']
        );
        if ($mrSettings)
        {
            MRSettings::where('name', 'usg')->update([
                'value' => 'false',
            ]);
        }
        $mrSettings = MRSettings::firstOrCreate(
            ['name' => 'imported'],
            ['value' => 'false']
        );
        if ($mrSettings)
        {
            MRSettings::where('name', 'imported')->update([
                'value' => 'false',
            ]);
        }
    }

    //
    // Delete temporary uploaded files
    //
    public function deleteUploadFiles()
    {
        array_map('unlink', glob($this->savePath . "MR*.*"));
    }

    public function readSheet($request)
    {

        try {
            $decrypted = Crypt::decryptString($request);
        } catch (DecryptException $e) {
            return view('medical_reports.index');
            //echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

        $pieces = explode("-", $decrypted);
        $sheetNo = $pieces[0];
        $doctorName = $pieces[1];


        $imported = MRSettings::where('name', 'imported')->first(); 
        
        if ($imported->value != 'true') //read from DB or from file
        {
            MRImportedSheetData::truncate();
            MRSettings::where('name', 'usg')->update([
                'value' => 'false',
            ]);

            $tmp_fileName = MRSettings::where('name', 'tmp_file_name')->first();

            if ($tmp_fileName->value == '' ) // if temp file is deleted return to upload
            {
                return view('medical_reports.index');
            }

            $import = new MRSelectSheetImport();
            $import->onlySheets($sheetNo);

            $fileName = MRSettings::where('name', 'tmp_file_name')->first();  

            $ts = Excel::import($import, $this->savePath.$fileName->value);

            //Temporarty OFF
            MRController::deleteUploadFiles();
            MRSettings::where('name', 'tmp_file_name')->update([
                'value' => '',
            ]);
        }

        $count = MRImportedSheetData::count();

        $reportables = MRFacility::where('reportable',true)->orwhere('name', 'Others')->orderBy('name')->get();
    
        $examinations = MRExamination::where('reportable', true)->orderBy('name', 'asc')->get();

        foreach ($examinations as $key => $examination) {
           
            $info = DB::table('m_r_imported_sheet_data')
                ->select(DB::raw('count(*) as sum'))
                ->where('col1', '=',  $examination->name)
                ->get();

            $report[$examination->name]['All'] = $info[0]->sum;
            $sum = $info[0]->sum;
            foreach ($reportables as $reportable) {

                $text = "count(if(col0='" . $reportable->name . "',1,NULL)) as sum";

                $info = DB::table('m_r_imported_sheet_data')
                    ->select(DB::raw($text))
                    ->where('col1', '=',  $examination->name)
                    ->get();

                $report[$examination->name][$reportable->name] = $info[0]->sum;
                    
                $sum -= $info[0]->sum;

            }
            $report[$examination->name]['Others'] = $sum;

        };

        $this->paid = MRSettings::where('name', 'paid')->first();
        $this->paid = $this->paid['value'];

        $reportables = $reportables->reject(function($value){
            return $value['name'] == $this->paid;
        })
        ->merge($reportables->filter(function($value){
            return $value['name'] == $this->paid;
            })
        );
        $reportables = $reportables->reject(function($value){
            return $value['name'] == "Others";
        })
        ->merge($reportables->filter(function($value){
            return $value['name'] == "Others";
            })
        );
        $reportables = $reportables->reject(function($value){
            return (($value['name'] != $this->paid) && ($value['name'] != "Others"));
        })
        ->merge($reportables->filter(function($value){
            return (($value['name'] != $this->paid) && ($value['name'] != "Others"));
            })
        );

        $priceList = MRPrice::with('examination', 'facility')->get();

        // data stored in DB
        MRSettings::where('name', 'imported')->update([
            'value' => 'true',
        ]);

        $paid = $this->paid;

        return view('medical_reports.usg.report', compact('doctorName', 'count', 'examinations', 'reportables', 'priceList', 'report', 'paid'));
    }
}
