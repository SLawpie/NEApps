<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Gate;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

use App\Imports\MRSheetNamesImport;
use App\Imports\MRSelectSheetImport;

use Validator;

use App\MRSettings;
use App\MRImportedSheetData;
use App\MRFacility;
use App\MRExamination;


class MedReportController extends MRBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->savePath = public_path('/upload/');
    }

    public function test()
    {
        if (Gate::denies('medical-reports')){
            return view('home');
        }

        return view('medical_reports.test');
    }


    public function index()
    {
        if (Gate::denies('medical-reports')){
            return view('home');
        }

        return view('medical_reports.index');
    }

    public function importTestFile()
    {

        if (Gate::denies('medical-reports')){
            return view('home');
        }
        return view('medical_reports.excel');
    }

    public function importFile()
    {

        if (Gate::denies('medical-reports')){
            return view('home');
        }
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

        MedReportController::deleteUploadFiles();

        $dateTime = date('Ymd_His');
        $file = $request->file('file');
        $fileName = 'MR-' . $dateTime . '-' . $file->getClientOriginalName();
        
        $file->move($this->savePath, $fileName);
        
        $mrSettings = MRSettings::firstOrCreate(
            ['name' => 'tmp_file_name'],
            ['value' => $fileName]
        );
        if ($mrSettings)
        {
            MRSettings::where('name', 'tmp_file_name')->update([
                'value' => $fileName,
            ]);
        }

        $mrSettings = MRSettings::firstOrCreate(
            ['name' => 'original_file_name'],
            ['value' => $file->getClientOriginalName()]
        );
        if ($mrSettings)
        {
            MRSettings::where('name', 'original_file_name')->update([
                'value' => $file->getClientOriginalName(),
            ]);
        }

        $mrSettings = MRSettings::firstOrCreate(
            ['name' => 'usg'],
            ['value' => false]
        );
        if ($mrSettings)
        {
            MRSettings::where('name', 'usg')->update([
                'value' => 'false',
            ]);
        }

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
    // Delete temporary uploaded files
    //
    public function deleteUploadFiles()
    {
        array_map('unlink', glob($this->savePath . "MR*.*"));
    }

    public function readSheet($request)
    {
        $decrypted = Crypt::decryptString($request);
        $pieces = explode("-", $decrypted);
        $sheetNo = $pieces[0];
        $doctorName = $pieces[1];

        MRImportedSheetData::truncate();

        $import = new MRSelectSheetImport();
        $import->onlySheets($sheetNo);

        $fileName = MRSettings::where('name', 'tmp_file_name')->first();  

        $ts = Excel::import($import, $this->savePath.$fileName->value);

        //Temporarty OFF
        //MedReportController::deleteUploadFiles();

        $count = MRImportedSheetData::count();

        $reportables = MRFacility::where('reportable',true)->get();
        //$reportables = MRFacility::all();

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

        //dd($report);

        // foreach ($reportables as $reportable) {
        //     $text = $reportable->name;
        //     $examinations[$text] = MRImportedSheetData::where('col0', 'like', $text);
        // }

        // $text = 'Płatne';
        // $examinations[$text] = MRImportedSheetData::where('col0', 'like', $text);
        
        //dd($examinations);
        
        //echo ("GOTOWE ! - ".$count);
        
        // return view('medical_reports.usg.report')->with([
        //     'count' => $count,
        // ]);
        return view('medical_reports.usg.report', compact('doctorName', 'count', 'examinations', 'reportables', 'report'));
    }

}
