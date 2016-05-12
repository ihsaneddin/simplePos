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
use \Auth, \Redirect, \Validator, \Input, \Session, \Response;
use Illuminate\Http\Request;

use App\Sale;
use App\SaleItem;
use App\SaleCharge, App\SaleDiscount;
use DB;

class SaleController extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data = Sale::find(15)->saleAmount();
        dd($data);
        return view('sale.index');
    }
}
