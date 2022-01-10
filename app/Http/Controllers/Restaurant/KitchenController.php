<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Transaction;
use App\TransactionSellLine;

use App\Utils\Util;

use App\Utils\RestaurantUtil;

class KitchenController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $commonUtil;
    protected $restUtil;

    /**
     * Constructor
     *
     * @param Util $commonUtil
     * @param RestaurantUtil $restUtil
     * @return void
     */
    public function __construct(Util $commonUtil, RestaurantUtil $restUtil)
    {
        $this->commonUtil = $commonUtil;
        $this->restUtil = $restUtil;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // if (!auth()->user()->can('sell.view')) {
        //     abort(403, 'Unauthorized action.');
        // }
        $business_id = request()->session()->get('user.business_id');
        $location = auth()->user()->permitted_locations();
        $orders = $this->restUtil->getAllOrders($business_id, ['line_order_status' => 'received','location_id' => $location]);
        $orders_coocked = $this->restUtil->getAllOrders($business_id, ['line_order_status' => 'cooked','location_id' => $location]);
        $served_orders = $this->restUtil->getAllOrders($business_id, ['line_order_status' => 'served','location_id' => $location]);
        return view('restaurant.kitchen.index', compact('orders','served_orders','orders_coocked','location')); 
    }
    public function line_orders($id)
    {
        $business_id = request()->session()->get('user.business_id');
        $location = auth()->user()->permitted_locations();
        $orders = $this->restUtil->getLineOrders($business_id, ['transaction_id' => $id,'location_id' => $location]);
        return view('restaurant.kitchen.line_orders', compact('orders','id')); 

    }
    public function markAsCookedLine($id)
    {
        try {
            $business_id = request()->session()->get('user.business_id');
            $user_id = request()->session()->get('user.id');

            $query = TransactionSellLine::where('id', $id);
            
            if($this->restUtil->is_service_staff($user_id)){
                $query->where('res_service_staff_id', $user_id);
            }
            $sell_line = $query->first();
            if (!empty($sell_line)) {
                $sell_line->res_line_order_status = 'cooked';
                $sell_line->save();
                $output = ['success' => 1,
                            'msg' => trans("restaurant.order_successfully_marked_cooked")
                        ];
            } else {
                $output = ['success' => 0,
                            'msg' => trans("messages.something_went_wrong")
                        ];
            }
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => 0,
                            'msg' => trans("messages.something_went_wrong")
                        ];
        }

        return $output;

    }
    /**getLineOrders185
     * Marks an order as cooked
     * @return json $output
     */
    public function markAsCooked($id)
    {
        // if (!auth()->user()->can('sell.update')) {
        //     abort(403, 'Unauthorized action.');
        // }
        try {
            $business_id = request()->session()->get('user.business_id');
            $sl = TransactionSellLine::leftJoin('transactions as t', 't.id', '=', 'transaction_sell_lines.transaction_id')
                        ->where('t.business_id', $business_id)
                        ->where('transaction_id', $id)
                        ->where(function($q) {
                            $q->whereNull('res_line_order_status')
                                ->orWhere('res_line_order_status', 'received');
                        })
                        ->update(['res_line_order_status' => 'cooked']);

            $output = ['success' => 1,
                            'msg' => trans("restaurant.order_successfully_marked_cooked")
                        ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => 0,
                            'msg' => trans("messages.something_went_wrong")
                        ];
        }

        return $output;
    }

    /**
     * Retrives fresh orders
     *
     * @return Json $output
     */
    public function refreshOrdersList(Request $request)
    {

        // if (!auth()->user()->can('sell.view')) {
        //     abort(403, 'Unauthorized action.');
        // }
        $business_id = request()->session()->get('user.business_id');
        $orders_for = $request->orders_for;
        $filter = [];
        $service_staff_id = request()->session()->get('user.id');

        if (!$this->restUtil->is_service_staff($service_staff_id) && !empty($request->input('service_staff_id'))) {
            $service_staff_id = $request->input('service_staff_id');
        }

        if ($orders_for == 'kitchen') {
            $filter['line_order_status'] = 'received';
        } elseif ($orders_for == 'waiter') {
            $filter['waiter_id'] = $service_staff_id;
        }
        $location = auth()->user()->permitted_locations();
        $filter['location_id'] =$location;
        
        $orders = $this->restUtil->getAllOrders($business_id, $filter);
        if(!empty($request->single)){
            $line_orders = $this->restUtil->getLineOrders($business_id, ['transaction_id' => $request->single,'location_id'=>$location]);
            return view('restaurant.partials.line_orders', compact('line_orders', 'orders_for'));
        }else{
            return view('restaurant.partials.show_orders', compact('orders', 'orders_for'));
        }
    }

    /**
     * Retrives fresh orders
     *
     * @return Json $output
     */
    public function refreshLineOrdersList(Request $request)
    {

        // if (!auth()->user()->can('sell.view')) {
        //     abort(403, 'Unauthorized action.');
        // }
        $location = auth()->user()->permitted_locations();

        $business_id = request()->session()->get('user.business_id');
        $orders_for = $request->orders_for;
        $filter = [];
        $service_staff_id = request()->session()->get('user.id');

        if (!$this->restUtil->is_service_staff($service_staff_id) && !empty($request->input('service_staff_id'))) {
            $service_staff_id = $request->input('service_staff_id');
        }

        if ($orders_for == 'kitchen') {
            $filter['order_status'] = 'received';
        } elseif ($orders_for == 'waiter') {
            $filter['waiter_id'] = $service_staff_id;
        }
        $filter['location_id'] =$location;
         $line_orders = $this->restUtil->getLineOrders($business_id, $filter);
        if(!empty($request->single)){
          $line_orders = $this->restUtil->getLineOrders($business_id, ['transaction_id' => $request->single,'location_id' => $location]);
        }
        return view('restaurant.partials.line_orders', compact('line_orders', 'orders_for'));
    }
}
