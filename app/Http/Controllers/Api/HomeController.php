<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Category;
use App\Models\Favorit;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Points;
use App\Models\Product;
use App\Models\ProductChild;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $user = $request->user('web-api');
        $categories = Category::all();

        if($categories->count() == 0) {
            return new Response(['status'=>false, 'message' => 'Page Not Content Any Category']);
        }

        return [
            'user' => $user,
            'categories' => $categories
        ];
 
    }

    public function search(Request $request)
    {
        $user = $request->user('web-api');

        $products = DB::table('products')
                ->where('name', 'like', "%{$request->search}%")
                ->orWhere('Description', 'LIKE', "%{$request->search}%")
                ->orWhere('price', 'LIKE', "%{$request->search}%")
                ->get();

 
                // ->paginate();

         return [
            'products' => $products
        ];
 
    }

    public function products(Request $request)
    {
        $user = $request->user('web-api');
 
        $validator = Validator($request->all(), [
            'category_id' => ['required','exists:categories,id'],
        ]);

        if (!$validator->fails()) {
            $products =Product::where('category_id', $request->category_id )
            ->get();


            if($products->count() == 0) {
                return new Response(['status'=>false, 'message' => 'This category does not contain products']);
            }

            return [
                'products' => $products
            ];
        }else {
            return response()->json(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

    }

    public function product(Request $request)
    {
        $user = $request->user('web-api');

        $validator = Validator($request->all(), [
            'product_id' => ['required','exists:products,id'],
        ]);

        if (!$validator->fails()) {

            $product = Product::where('id', $request->peoduct_id )
                    ->get();

            if($product->count() == 0) {
                return new Response(['status'=>false, 'message' => 'This  product Not Found']);
            }

            return [
                'product' => $product
            ];
        }else {
            return response()->json(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
       }
    }

    public function product_items(Request $request)
    {
        $user = $request->user('web-api');

        $validator = Validator($request->all(), [
            'product_id' => ['required','exists:products,id'],
        ]);


        if (!$validator->fails()) {

        $product = ProductChild::where('product_id', $request->product_id )
                ->get();

        if($product->count() == 0) {
            return new Response(['status'=>false, 'message' => 'This  product Not Found']);
        }      
                
        return [
            'product_items' => $product
        ];



        }else {
            return response()->json(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
 
    }

    public function product_item(Request $request)
    {
        $user = $request->user('web-api');

        $validator = Validator($request->all(), [
            'product_item_id' => ['required','exists:items,id'],
        ]);

        if (!$validator->fails()) {
            $product = ProductChild::where('id', $request->product_item_id )->get();
            if($product->count() == 0) {
                return new Response(['status'=>false, 'message' => 'This  product Not Found']);
            }      
            return [
                'product_item' => $product
            ];
        }else {
            return response()->json(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function add_to_cart(Request $request)
    {

        $validator = Validator($request->all(), [
            'product_item_id' => ['required','exists:items,id'],
            'quantity' => ['integer'],
        ]);

        if (!$validator->fails()) {

            $user = $request->user('web-api');
    
            $cart = new Carts();
            $cart->user_id = $user->id;
            $cart->product_id = $request->product_item_id;
            $cart->quantity = $request->quantity;
            $cart->size = $request->size;
            $saved = $cart->save();

                if ($saved) {
                    return [
                        'status' => true ,
                        'message' => 'added to cart successfuly' ,
                    ];
                }

                return [
                    'status' => false ,
                    'message' => 'added to cart  Failed' ,
                ];
        }else {
            return response()->json(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    
 
    }

    public function cart(Request $request)
    {
        $user = $request->user('web-api');
 
        $cart = Carts::join('items', 'carts.product_id', '=', 'items.id')
        ->select('carts.*', 'items.name','items.Description','items.price','items.image','items.color')
        ->where('user_id', $user->id )
        ->get();


 
        if($cart->count() == 0) {
            return new Response(['status'=>false, 'message' => 'This  Cart Is Empty']);
        }      
        $total = 0;
        foreach($cart as $item){
            $total += ($item->price * $item->quantity);
        }
              return [
                'cart' => $cart ,
                'total' => $total ,
            ];
      
            
 
    }

    
    public function increase_quantity(Request $request)
    {
        $user = $request->user('web-api');
 
        $cart = Carts::findOrFail($request->id);

        if($cart->count() == 0) {
            return new Response(['status'=>false, 'message' => 'This product is not in the cart']);
        }      

        if ($cart->user_id == $user->id) {
            $cart->quantity = $cart->quantity +1 ;
            $saved = $cart->save();
            if ($saved) {
                return [
                    'status' => true ,
                    'message' => 'increase quantity to cart successfully' ,
                ];
            }
        }

        return [
            'status' => false,
            'message' => 'increase quantity to cart Faild' ,
        ];
    }

    public function lower_quantity(Request $request)
    {
        $user = $request->user('web-api');
 
        $cart = Carts::findOrFail($request->id);
        if($cart->count() == 0) {
            return new Response(['status'=>false, 'message' => 'This product is not in the cart']);
        }      

        if($cart->quantity == 1) {
            return [
                'status' => false,
                'message' => 'The minimum quantity is 1' ,
            ];
        }
        if ($cart->user_id == $user->id) {
            $cart->quantity = $cart->quantity - 1 ;
            $saved = $cart->save();
            if ($saved) {
                return [
                    'status' => true ,
                    'message' => 'lower quantity to cart successfully' ,
                ];
            }
        }

        return [
            'status' => false,
            'message' => 'lower quantity to cart Faild' ,
        ];
    }

    public function delete_product_from_cart(Request $request)
    {
        $user = $request->user('web-api');

        $validator = Validator($request->all(), [
            'id' => ['required','exists:carts,id'],

        ]);

        if (!$validator->fails()) {

            $cart = Carts::destroy($request->id);
            
            if($cart) {
                return [
                    'status' => true,
                    'message' => 'deleted product from cart is successfully' ,
                ];
            }
    

            return [
                'status' => false,
                'message' => 'deleted product from cart is Faild' ,
            ];
      }else {
        return response()->json(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
    }

        
    }

    public function delete_cart(Request $request)
    {
        $user = $request->user('web-api');

        $deleted = DB::table('carts')->where('user_id', '=', $user->id)->delete();


        if($deleted) {
            DB::table('orders')->where('user_id', '=', $user->id)->where('status', null )->delete();

            return [
                'status' => true,
                'message' => 'deleted  cart is successfully' ,
            ];
        }
 
        return [
            'status' => false,
            'message' => 'the cart not found Products' ,
        ];
        
    }

    public function add_location(Request $request)
    {
        $user = $request->user('web-api');

        $validator = Validator($request->all(), [
             'lng' => ['required'],
            'lat' => ['required'],

            'location' => ['required','string'],
        ]);

        

        if (!$validator->fails()) {

           

 
            $cart = DB::table('carts')
            ->join('items', 'carts.product_id', '=', 'items.id')
            ->select('carts.*', 'items.name','items.Description','items.price','items.image','items.color')
            ->where('user_id', $user->id )
            ->get();


 
            $total = 0;
            foreach($cart as $item){
                $total += ($item->price * $item->quantity);
            }


            $order = new Order();
            $order->user_id = $user->id;
            $order->lat = $request->lat;
            $order->lng = $request->lng;
            $order->location = $request->location;
            $order->total_price = $total;
            $order->datetime = Carbon::now()->toDateTimeString();
 

            $result = DB::table('orders')
            ->where('user_id', $user->id )
            ->where('status', null )
            ->delete();


            $saved = $order->save();

            if($saved) {
                // get order active
                $order = DB::table('orders')
                ->where('user_id', $user->id )
                ->where('status', null )
                ->first();

                // create order-item
                foreach ($cart as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->name,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'image' => $item->image,
                    ]);
                }



                return [
                    'status' => true,
                    'message' => 'select location is  successfully' ,
                ];
            }
    
            return [
                'status' => false,
                'message' => 'select location  cart is Faild' ,
            ];
        }else {
              return response()->json(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
        
    }


    public function show_invoice(Request $request)
    {
        $user = $request->user('web-api');

        $order = DB::table('orders')
        ->where('user_id', $user->id )
        ->where('status', null )
        ->first();


        
        if($order) {

       

            $orders = DB::table('orders_items')
            ->join('orders', 'orders_items.order_id', '=', 'orders.id')
            ->select('orders_items.product_name','orders_items.quantity','orders_items.price')
            ->where('order_id', $order->id )
            ->get();
 
            foreach ($orders as $item) {
                $item->total = $item->price * $item->quantity;
            }

            if($request->use_point == 1)
            {
                $points = DB::table('points')
                ->where('user_id', $user->id )
                ->where('status', 1 )
                ->sum('total');
 
                $discount = 0;
                while (50 <= $points ) {
                    $discount++;
                    $points-=50;
                }
 
                if(!$discount) {
                    return [
                        'status' => false ,
                        'message' => 'You do not have the amount to deduct'
                    ];
            
                 }
                // return  $discount;

                $final_price = $order->total_price  - $discount ;
 

                $order = Order::findOrFail($order->id);
                $order->discount =  $discount;
                $order->final_price =  $final_price;
                $saved = $order->save();
                
                if ($saved) {
 
                    // $deleted = DB::table('points')
                    // ->where('user_id', $user->id )
                    // ->where('status', 1 )
                    // ->delete();

                    $changed =Points::where('user_id', $user->id)->update(['status' => 0 ]);

                     

                    // return [ $points,$discount,$final_price,$saved,$changed];


                         $point = new Points();
                        $point->user_id = $user->id;
                        $point->status = 1 ;
                        $point->total = $points ;
                        $saved = $point->save();
 
                }

                 return [
                    'orders' => $orders ,
                    'total_price' => $order->total_price,
                    'final_price' => $final_price,
                    'discount' => $discount,
                 ];
    
                
            }
 

            return [
                'orders' => $orders ,
                'total_price' => $order->total_price,
                'final_price' => $order->total_price,

             ];
        }

        return [
            'status' => false ,
            'message' => 'invoice not found'
        ];
     


 

 
 
     
        
    }

    
    public function confirm_order(Request $request)
    {
        $user = $request->user('web-api');

        // $order = DB::table('orders')
        // ->where('user_id', $user->id )
        // ->where('status', null )
        // ->first();

        $order = DB::table('orders')
        ->where('user_id', $user->id )
        ->where('status', null )
        ->first();

        if($order) {

            $saved = DB::table('orders')->where('user_id', $user->id)->where('status', null )->update(['status' => "pending"]);
            $point = new Points();
            $point->user_id = $user->id;
            $point->total = 15 ;
            $point->status = 1;
            $stored = $point->save();

            // return $saved;

            $deleted = DB::table('carts')->where('user_id', '=', $user->id)->delete();

            if ($deleted && $saved && $stored) {
                return [
                    'status' => true,
                    'message' => 'Create Order is successfully' ,
                ];
            }

            return [
                'status' => false,
                'message' => 'Create Order is Faild' ,
            ];
        }   

        return [
            'status' => false,
            'message' => 'invoice not found' ,
        ];
    }

    public function orders(Request $request)
    {
        $user = $request->user('web-api');

        $orders = DB::table('orders')
        ->where('user_id', $user->id )
        ->where('status','!=', null )
        ->get();



        foreach ($orders as  $item) {
            $arr = [];
             $order = DB::table('orders_items')->where('order_id', $item->id )->get('product_name');
             $order_count = DB::table('orders_items')->where('order_id', $item->id )->count();
            for ($i=0; $i < $order_count ; $i++) { 
                
                $arr[$i] = $order[$i]->product_name;
            }

            $item->products = $arr;
            $item->count_products = $order_count;
            if($item->final_price == null ) {
                $item->final_price = $item->total_price;
            }
 
        }

        return [ $orders ];


  

        return [
            'status' => true,
            'message' => 'Create Order is Faild' ,
        ];

    }

    public function filter_orders(Request $request)
    {
        $validator = Validator($request->all(), [
            'type_order' => ['required'],
        ]);

        $user = $request->user('web-api');

        

        if (!$validator->fails()) {

            $arr = [];
            $orders = DB::table('orders')
            ->where('user_id', $user->id )
            ->get();
            foreach ($orders as  $item) {
                $arr = [];
                 $order = DB::table('orders_items')->where('order_id', $item->id )->get('product_name');
                 $order_count = DB::table('orders_items')->where('order_id', $item->id )->count();
                for ($i=0; $i < $order_count ; $i++) { 
                    
                    $arr[$i] = $order[$i]->product_name;
                }
    
                $item->products = $arr;
                $item->count_products = $order_count;
     
            }
            // $orders ];



            if ($request->type_order == 'New') {

                foreach ($orders as $item) {

                    $startDate = Carbon::parse($item->datetime);
                    $endDate = Carbon::parse(Carbon::now());
                    $diffInDays = $startDate->diffInDays($endDate);

                    if ($diffInDays < 10) {
                        $arr[] = $item;
                    }

                }
                return $arr;    
            }
 
            $orders = DB::table('orders')
            ->where('user_id', $user->id )
            ->where('status','=', $request->type_order )
            ->get();

            foreach ($orders as  $item) {
                $arr = [];
                 $order = DB::table('orders_items')->where('order_id', $item->id )->get('product_name');
                 $order_count = DB::table('orders_items')->where('order_id', $item->id )->count();
                for ($i=0; $i < $order_count ; $i++) { 
                    
                    $arr[$i] = $order[$i]->product_name;
                }
    
                $item->products = $arr;
                $item->count_products = $order_count;
     
            }
            return $orders;

        }else {
        return response()->json(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show_order(Request $request)
    {
        $validator = Validator($request->all(), [
            'order_id' => ['required'],
        ]);

        $user = $request->user('web-api');

        

        if (!$validator->fails()) {


            $order = Order::findOrFail($request->order_id);

 
            $orders = DB::table('orders_items')
            ->join('orders', 'orders_items.order_id', '=', 'orders.id')
            ->select('orders_items.product_name','orders_items.quantity','orders_items.price')
            ->where('order_id', $request->order_id )
            ->get();

             
            foreach ($orders as $item) {
                $item->total = $item->price * $item->quantity;
            }



            return [
                'orders' => $orders ,
                'total_price' => $order->total_price
            ];

        }else {
        return response()->json(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function add_fav(Request $request)
    {
        $user = $request->user('web-api');

        $validator = Validator($request->all(), [
           'product_id' => ['required','integer','exists:items,id'],
        ]);

 
       if (!$validator->fails()) {

          
         // 1 :Eloquent (Model)
        $favorite = new Favorit();
        $favorite->user_id = $user->id;
        $favorite->product_id = $request->input("product_id");
         $saved = $favorite->save();

        if ($saved) {
            return [
                'status' => true,
                'message' => 'The product has been added to favourites' ,
            ];
        }
        return [
            'status' => false,
            'message' => 'Adding product to wishlist failed' ,
        ];

 
        }else {
        return response()->json(['ststus'=>false, 'message'=>$validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }


    }

    public function show_fav(Request $request)
    {
        $user = $request->user('web-api');

        $favorite = Favorit::join('items', 'favorites.product_id', '=', 'items.id')
        ->select('favorites.*', 'items.name','items.Description','items.price','items.image')
        ->where('user_id', $user->id )
        ->get();



        // Carts::join('items', 'carts.product_id', '=', 'items.id')
        // ->select('carts.*', 'items.name','items.Description','items.price','items.image','items.color')
        // ->where('user_id', $user->id )
        // ->get();



        if($favorite->count() == 0) {
            return new Response(['status'=>false, 'message' => 'There are no favorite products']);
        }      

    
        
        return [
            'status' => true ,
            'products' => $favorite
        ];
     


 

 
 
     
        
    }

}
