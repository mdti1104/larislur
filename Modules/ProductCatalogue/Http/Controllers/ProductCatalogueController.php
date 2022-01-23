<?php

namespace Modules\ProductCatalogue\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Product;
use App\Business;
use App\Discount;
use App\SellingPriceGroup;
use App\Utils\ProductUtil;
use App\BusinessLocation;
use App\Utils\ModuleUtil;
use App\Category;
use DB;
class ProductCatalogueController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $productUtil;
    protected $moduleUtil;

    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct(ProductUtil $productUtil, ModuleUtil $moduleUtil)
    {
        $this->productUtil = $productUtil;
        $this->moduleUtil = $moduleUtil;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($business_id, $location_id)
    {

        $products = Product::where('business_id', $business_id)
                ->whereHas('product_locations', function($q) use ($location_id){
                    $q->where('product_locations.location_id', $location_id);
                })
                ->ProductForSales()
                ->with(['variations', 'variations.product_variation', 'category'])
                ->get()
                ->groupBy('category_id');
        $business = Business::with(['currency'])->findOrFail($business_id);
        $business_location = BusinessLocation::where('business_id', $business_id)->findOrFail($location_id);

        $now = \Carbon::now()->toDateTimeString();
        $discounts = Discount::where('business_id', $business_id)
                                ->where('location_id', $location_id)
                                ->where('is_active', 1)
                                ->where('starts_at', '<=', $now)
                                ->where('ends_at', '>=', $now)
                                ->orderBy('priority', 'desc')
                                ->get();

        $categories = Category::forDropdown($business_id, 'product');
        return view('productcatalogue::catalogue.index')->with(compact('products', 'business', 'discounts', 'business_location', 'categories'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($business_id, $id)
    {
        $product = Product::with(['brand', 'unit', 'category', 'sub_category', 'product_tax', 'variations', 'variations.product_variation', 'variations.group_prices', 'variations.media', 'product_locations', 'warranty'])->where('business_id', $business_id)
                        ->findOrFail($id);

        $price_groups = SellingPriceGroup::where('business_id', $product->business_id)->active()->pluck('name', 'id');

        $allowed_group_prices = [];
        foreach ($price_groups as $key => $value) {
            $allowed_group_prices[$key] = $value;
        }

        $group_price_details = [];
        $discounts = [];
        foreach ($product->variations as $variation) {
            foreach ($variation->group_prices as $group_price) {
                $group_price_details[$variation->id][$group_price->price_group_id] = $group_price->price_inc_tax;
            }

            $discounts[$variation->id] = $this->productUtil->getProductDiscount($product, $product->business_id, request()->input('location_id'), false, false, $variation->id);
        }

        $combo_variations = [];
        if ($product->type == 'combo') {
            $combo_variations = $this->productUtil->__getComboProductDetails($product['variations'][0]->combo_variations, $product->business_id);
        }
        return view('productcatalogue::catalogue.show')->with(compact(
            'product',
            'allowed_group_prices',
            'group_price_details',
            'combo_variations',
            'discounts'
        ));
    }

    public function generateQr()
    {
        $business_id = request()->session()->get('user.business_id');
        if (!(auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'productcatalogue_module'))) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');
        $business_locations = BusinessLocation::forDropdown($business_id);
        $business_locations = $business_locations->add('all');
        $business = Business::findOrFail($business_id);
        return view('productcatalogue::catalogue.generate_qr')
                    ->with(compact('business_locations', 'business'));
    }
    public function all($business_id)
    {
        
        $paginator  = Category::where('business_id',$business_id)->where('category_type', 'product')
        ->paginate(4);
        session()->put('business_id',$business_id);
        return view('productcatalogue::catalogue.index')->with(compact('paginator','business_id'));
    }
    public function Category($business_id,$categories_id)
    {
        $paginator = Product::where('business_id', $business_id)
        ->ProductForSales()
        ->with(['variations', 'modifier_sets','variations.product_variation', 'category'])
        ->where('type','!=','modifier')
        ->where('category_id',$categories_id)
        ->paginate(4);
        $categories = Category::forDropdown($business_id, 'product');
        return view('productcatalogue::catalogue.menu')->with(compact('paginator','categories_id','categories','business_id'));

    }
    public function success(Request $request)
    {
        $max = DB::table('orders_catalog')->orderBy('orders_id','DESC')->first();
        if ($max) {
                $order_no = $this->generateOrderNo($max->orders_id + 1);
        }else{
                $order_no = $this->generateOrderNo(1);
        }
        $cart = $request->session()->get('cart');
        if(!empty($cart)){
                $order_id = DB::table('orders_catalog')->insertGetId([
                    'order_no' => $order_no,
                    'session_id' => session()->getId(),
                ]);
                $carts = $this->CartMapping($cart);
                foreach ($carts['cart'] as $key => $value) {
                if ($value['variant']) {
                    $data = [
                        'id_product' => $value['id_product'],
                        'id_orders' => $order_id,
                        'variation_id' => $value['id'],
                        'quantity' => $value['quantity'],
                    ];
                }else{
                    $data = [
                        'id_product' => $value['id'],
                        'id_orders' => $order_id,
                        'quantity' => $value['quantity'],
                        'variation_id' => null
                    ];
                }
                DB::table('product_orders')->insert($data);
            }
            \Session::forget('cart');
            \Session::save();
            $request->session()->regenerate();
            return view('productcatalogue::catalogue.success',compact('order_no'));
        }else{
            $business_id = session()->get('business_id');
            return redirect('/catalogue/'.$business_id);
        }
  

    }
    public function generateOrderNo($string)
    {
        return 'KKJ' . str_pad($string, 4, '0', STR_PAD_LEFT);
    }
    public function DestroyCart(Request $request,$id)
    {
        $cart = $request->session()->get('cart');
        $new = array_filter($cart, function ($var) use($id){
            return $var['id_product'] != $id;
        });
        $request->session()->put('cart',$new);
        return redirect()->back();
    }
    private function CartMapping($cart)
    {
        $return = [];
        $total = 0;

        if ($cart) {
            foreach ($cart as $key => $value) {
                $product = Product::with(['variations', 'variations.product_variation', 'variations.group_prices', 'variations.media', 'product_locations', 'warranty'])
                ->findOrFail($value['id_product']);
                if ($value['id_variant']) {
                   $varian = $product->variations()->findOrFail($value['id_variant']);
                   $data = [
                    'name' => $product->name .' - '.$varian->name,
                    'harga' => (int) $value['price'],
                    'variant' => true,
                    'id_product' => $value['id_product'],
                    'id'=> $value['id_variant']
                   ];
                }else{
                  $data = [
                        'name' => $product->name,
                        'harga' => (int) $value['price'],
                        'id_product' => $value['id_product'],
                        'variant' => false,
                        'id'=> $value['id_product']
                       ]; 
                }
                $total += $data['harga'];
                array_push($return,$data);
            }
            $qty = array_count_values(array_column($return, 'id'));
            $unique = array_map("unserialize", array_unique(array_map("serialize", $return)));
            $cart =  array_map(function ($return) use ($qty) {
                $return['quantity'] = $qty[$return['id']];
                $return['subtotal'] = $qty[$return['id']] * (int) $return['harga'];
                return $return;
            }, $unique);
            return [
                'cart' => $cart,
                'total' => $total,
            ];
        }else{
            return [
                'cart' => [],
                'total' => 0,
            ];
        }
     
        
    }
    public function cart(Request $request)
    {

        $cart = $request->session()->get('cart');
      

        $mapp = $this->CartMapping($cart);
        return view('productcatalogue::catalogue.cart',$mapp);
    }
    public function add_cart(Request $request)
    {
        $cart = $request->session()->get('cart');
        if ($cart) {
            $array = [];
            $data = ['id_product' => $request->id_product,'id_variant' => $request->variant,'price' => $request->price];
            array_push($cart,$data);
            $request->session()->put('cart',$cart);
        }else{
            $array = [];
            array_push($array,[

                'id_product' => $request->id_product,
                'id_variant' => $request->variant,
                'price' => $request->price
            ]);

            $request->session()->put('cart',$array);
        }   
    }
    public function getOrderNumber($order_no)
    {
        $order_no = DB::table('orders_catalog')->where('order_no',$order_no)
        ->join('product_orders','product_orders.id_orders','orders_catalog.orders_id')->get();
       $products =[];
        foreach ($order_no as $key => $value) {
            $query = Product::where('id', $value->id_product)
            ->ProductForSales()
            ->with(['variations', 'variations.product_variation', 'category'])
            ->where('type','!=','modifier');
            if ($value->variation_id) {
                $query->whereHas('variations', function($q) use($value) {
                    $q->where('variations.id', $value->variation_id);
                });

            }
            $query = $query->first();
            $products[$key]['variation_id'] = $query->variations->first()->id;
            $products[$key]['quantity'] = $value->quantity;
        }
        return json_encode($products);
    }
}
