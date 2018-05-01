<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ahmad Faiyaz
 * Date: 4/19/2016
 * Time: 1:56 AM
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use \DB;

class SaleItem extends Model {
    use SoftDeletes;
    protected $table = 'sales_items';


    public function sale(){
        return $this->belongsTo('App\Sale');
    }

    public function original(){
        return $this->belongsTo('App\Item','item_id', 'id');
    }

    /**
     * Returns the total price of a certain sale item
     * @return double
     */
    public function totalPrice(){
        return $this->attributes['selling_price'] * $this->attributes['quantity'];
    }

    public function totalCost(){
        return $this->attributes['cost_price'] * $this->attributes['quantity'];
    }

    public function getSaleInfoOnADay($date = null){
        if($date == null){
            $date = date("Y-m-d");
        }

        //$items = $this->where( DB::raw('DATE(created_at)'), '=', $date)->get();

        $items = $this->join('items', 'item_id', '=', 'items.id')->selectRaw("DATE(sales_items.created_at) as created_at, sales_items.selling_price as price, sum(sales_items.quantity) as quantity, sales_items.cost_price as cost, items.name as name, items.code as code")->groupBy(DB::raw('code'))->where( DB::raw('DATE(sales_items.created_at)'), '=', $date)->get();

        //dd($items);

        $collection = collect();

        foreach ($items as $item) {

            $ret = [];

            $ret['date'] = new \DateTime($date);
            $ret['name'] = $item->name;
            $ret["code"] = $item->code;
            $ret['quantity'] = $item->quantity;
            $ret['price'] = $item->price;
            $ret["cost"] = $item->cost;
            $ret["total"] = $item->price * $item->quantity;
            $ret["totalCost"] = $item->cost * $item->quantity;

            $collection->push($ret);
        }

        return $collection;
    }
}