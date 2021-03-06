<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ahmad Faiyaz
 * Date: 4/18/2016
 * Time: 4:18 AM
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sale;
use App\Http\Requests\ItemRequest;
use \Auth, \Redirect, \Validator, \Input, \Session;
use Illuminate\Http\Request;

use Excel;

class ReportController extends Controller {
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $data = $this->resources();
        return view('report.index')->with('data', $data);
    }

    public function store(){

        $startDate = new \DateTime(Input::get('startDate'));
        $endDate   = new \DateTime(Input::get('endDate'));


        if($endDate < $startDate){
            $tmp = $startDate;
            $startDate = $endDate;
            $endDate = $tmp;
        }

        $data = array(
            'startDate' => $startDate->format('j F, Y'),
            'endDate' => $endDate->format('j F, Y'),
            'sales' => array()
        );



        $curDate = $startDate;

        $sale = new Sale;
        while($curDate <= $endDate){
            array_push($data['sales'], $sale->getSaleInfoOnADay($curDate->format('Y-m-d')));
            $curDate->modify('+1 day');
        }

        return view('report.index')->with('data', $data);
    }

    public function export(){

        $data = $this->resources();

        Excel::create('Report', function($excel) use($data) {

            $excel->sheet($data['startDate']->format("Y-m-d").'-'.$data['endDate']->format("Y-m-d"), function($sheet) use($data) {

                $sheet->loadView('report._report', array("data" => $data));

            });

        })->download("xlsx");
    }

    protected function resources(){
        $startDate = new \DateTime();
        if(Input::get('startDate')){
            $startDate = new \DateTime(Input::get('startDate'));
        }

        $endDate   = new \DateTime();

        if(Input::get('endDate')){
            $endDate = new \DateTime(Input::get('endDate'));
        }


        if($endDate < $startDate){
            $tmp = $startDate;
            $startDate = $endDate;
            $endDate = $tmp;
        }

        $data = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'sales' => array()
        );





        $curDate = clone $startDate;

        $sale = new Sale;
        while($curDate <= $endDate){
            array_push($data['sales'], $sale->getSaleInfoOnADay($curDate->format('Y-m-d')));
            $curDate->modify('+1 day');
        }
        return $data;
    }
}