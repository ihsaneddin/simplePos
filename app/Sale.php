<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ahmad Faiyaz
 * Date: 4/19/2016
 * Time: 1:54 AM
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sale extends Model {
    use SoftDeletes;
    protected $table = 'sales';

    public function items(){
        return $this->hasMany('App\SaleItem');
    }

    public function discounts(){
        return $this->hasMany('App\SaleDiscount');
    }

    public function charges(){
        return $this->hasMany('App\SaleCharge');
    }

    public function getTotalPrice(){
        return $this->items->sum(function($item) {
            return $item->totalPrice();
        });
    }

    public function saleAmount(){
        $data = [];
        $data = array_merge($data, $this->toArray());
        $data ['items'] = $this->items->toArray();
        $data['discounts'] = $this->discounts->toArray();
        $data['charges']   = $this->charges->toArray();

        $data['grossTotal'] = 0.0;

        foreach($data['items'] as $key => $item){
            $data['items'][$key]['name'] = Item::find($item['item_id'])->name;
            $data['grossTotal'] += ($item['quantity'] * $item['selling_price']);
        }


        $discountSum = 0.0;
        foreach($data['discounts'] as $key => $discount){
            $val = 0.0;

            if($discount['type'] == 1){ // %
                $val = ($data['grossTotal'] * $discount['amount'])/100.0;
            }else{ // -
                $val = ($discount['amount']);
            }
            $data['discounts'][$key]['name'] = Discount::find($discount['discount_id'])->name;
            $data['discounts'][$key]['value'] = $val;
            $discountSum += $val;
        }


        $chargeSum = 0.0;
        foreach($data['charges'] as $key => $charge){
            $val = 0.0;

            if($charge['type'] == 1){
                $val = (( $data['grossTotal'] - $discountSum) * $charge['amount'])/100.0;
            }else{
                $val = ($charge['amount']);
            }

            $data['charges'][$key]['name'] = ChargeRule::find($charge['charge_id'])->name;
            $data['charges'][$key]['value'] = $val;

            $chargeSum += $val;
        }


        $data['totalPayment'] = $data['grossTotal'] - $discountSum + $chargeSum;
        return $data['totalPayment'];
    }
}
