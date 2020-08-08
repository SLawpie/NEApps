<?php

namespace App\Http\Controllers\MedicalReports;

use Illuminate\Http\Request;

use App\MRFacility;
use App\MRExamination;
use App\MRPrice;
use App\MRSettings;

class PriceListController extends MRBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $paid = MRSettings::where('name', 'paid')->first();
        $this->paid = $paid['value'];
    }


    public function priceList() {

        $facilities = MRFacility::where('reportable', true)->orwhere('name', 'Others')->orderBy('name')->get();
        $examinations = MRExamination::orderBy('name', 'asc')->get();
        $priceList = MRPrice::with('examination', 'facility')->get();
        $paid = $this->paid;

        $facilities = $facilities->reject(function($value){
            return $value['name'] == $this->paid;
        })
        ->merge($facilities->filter(function($value){
            return $value['name'] == $this->paid;
            })
        );
        $facilities = $facilities->reject(function($value){
            return $value['name'] == "Others";
        })
        ->merge($facilities->filter(function($value){
            return $value['name'] == "Others";
            })
        );
        $facilities = $facilities->reject(function($value){
            return (($value['name'] != $this->paid) && ($value['name'] != "Others"));
        })
        ->merge($facilities->filter(function($value){
            return (($value['name'] != $this->paid) && ($value['name'] != "Others"));
            })
        );

        return view('medical_reports.pricelist', compact('examinations', 'facilities', 'priceList', 'paid'));
    }

    public function actionGet(Request $request) {

        if($request->ajax()) {
            $text = "Udało się !";
            echo $text;
        }
    }

    public function action(Request $request) {

        if($request->ajax()) {

            $id = $request->id;
            $price = (float) $request->price;

            $ids = explode('-', $id);
            $ids["price"] = number_format($price, 2, ',', '');
            $priceId = MRPrice::updateOrCreate(
                ['examination_id' => (int) $ids[1], 'facility_id' => (int) $ids[0]],
                ['price' => $price]
            );

            $text = $ids[0];
            $text .= "/";
            $text .= $ids[1];
            $text .= "/";
            $text .= $priceId->id;
            $ids["text"] = $text;

            echo json_encode($ids);
        }
    }

}
