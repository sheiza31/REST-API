<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Order_items;
use App\Models\Carts;
use App\Models\Cart_items;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Membuat order baru dari cart user yang sedang login
     */

     public function index()
     {
         $user = JWTAuth::user();
         $orders = Orders::where('user_id', $user->id)->with('orderItems.products')->get();
 
         return response()->json($orders);
     }
    public function store(Request $request)
    {
        $user = JWTAuth::user();

        // Cek apakah user memiliki cart
        $cart = Carts::where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json([
                'response'=> [
                    'status'=>true,
                    'message'=> "Cart Is'nt Empty",
                    'data'=>$cart,

                ]
            ],400);
        }

        // Ambil semua item di cart
        $cartItems = Cart_items::where('cart_id', $cart->id)->with('products')->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'response'=> [
                    'status'=>true,
                    'message'=> "No Items In the Cart",
                    'data'=>$cart,

                ]
            ],400);
        }

        // Hitung total harga order
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        DB::beginTransaction();
        try {
            // Buat order baru
            $order = Orders::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => 'pending', // default status "pending"
            ]);

            // Pindahkan data dari cart_items ke order_items
            foreach ($cartItems as $cartItem) {
                Order_items::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);
            }

            // Hapus cart setelah checkout
            $cart->delete();

            DB::commit();

            return response()->json([
                'response'=> [
                    'status'=>true,
                    'message'=> "Order Created Successfully",
                    'data'=>$order,

                ],
            ],200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Order failed', 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * Menampilkan detail order tertentu
     */
    public function show($id)
    {
        $user = JWTAuth::user();
        $order = Orders::where('id', $id)
            ->where('user_id', $user->id)
            ->with('orderItems.product')
            ->firstOrFail();

            return response()->json([
                'response'=> [
                    'status'=>true,
                    'message'=> "Show Specific Order ",
                    'data'=>$order,
                ],
            ],200);
    }
}
