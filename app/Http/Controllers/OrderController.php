<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function allOrder()
    {
        $output = array('data' => array());
        $orders = DB::table('orders')
            ->join('customer', 'customer.id', '=', 'orders.customer')
            ->join('restaurants', 'restaurants.id', '=', 'orders.restaurant')
            ->select('orders.*',
                'restaurants.name as restaurant_name',
                'customer.first_name as customer_first_name',
                'customer.last_name as customer_last_name')
            ->orderBy('orders.id', 'DESC')
            ->get();

        $x = 1;
        foreach ($orders as $row)
        {
            $actionButton = '

          <td>

         <a href="#"  data-toggle="modal" data-target="#modalShow" onclick="OrdersDetails('.$row->id.')">
            <button type="button" class="btn btn-outline-grey btn-rounded btn-sm px-2">
                <i class="fa fa-list"></i>
            </button>
        </a>

</td>

            ';

            $output['data'][] = array(
                $row->customer_first_name.''.$row->customer_last_name,
                $row->restaurant_name,
                $row->finalAmount,
                $row->status,
                $actionButton
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }

    public function orderDetails(Request $request)
    {
        $id = $request['id'];
        $output = array('data' => array());

        $orders = DB::table('order_items')
            ->select('order_items.*')
            ->where('order',$id)
            ->orderBy('id', 'DESC')
            ->get();

        $x = 1;
        foreach ($orders as $row)
        {
            $output['data'][] = array(
                $row->name,
                $row->price,
                $row->quanitity,
            );
            $x++;
        }

        $data= response()->json($output);
        return $data;
    }
}
