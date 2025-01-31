<?php
namespace App\Http\Controllers;

use App\Http\Requests\CartItemsRequest;
use App\Models\Carts;
use App\Models\Cart_items;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CartItemsController extends Controller
{
    /**
     * Display all cart items for the authenticated user.
     */
    public function index()
    {
        $user = JWTAuth::user();
        
        // Ambil keranjang user beserta item dan produknya
        $cart = Carts::with('Cart_items.products')->where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json([
                'status'=>false,
                'message'=>'Cart Is Empty',
                'data'=>$cart->Cart_items,
            ],404);
        }

        return response()->json([
            'status'=>true,
            'message'=>'All Resource Cart Items',
            'data'=>$cart->Cart_items,
        ],201);
    }

    /**
     * Store a newly created cart item.
     */
    public function store(CartItemsRequest $request)
    {
        $user = JWTAuth::user();

        // Ambil atau buat keranjang untuk user
        $cart = Carts::firstOrCreate(['user_id' => $user->id]);

        // Cek apakah produk sudah ada di keranjang
        $cartItem = Cart_items::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // Jika produk sudah ada, tambahkan kuantitas
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Jika produk belum ada, buat item baru
            $cartItem = Cart_items::create([
                'cart_id'    => $cart->id,
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
            ]);
        }

        return response()->json([
            'status'=>true,
            'message'=>'Add Item To Cart User',
            'data'=>$cartItem,
        ],201);
    }

    public function show($id)
    {
        $user = JWTAuth::user();
    
        // Cari item keranjang berdasarkan ID dan user yang sedang login
        $cartItem = Cart_items::whereHas('carts', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('products')->findOrFail($id);
    
        return response()->json([
            'response' => [
            'status'=>true,
            'message'=>'Show Speific Resource Cart Item',
            'data'=>[
            'id'        => $cartItem->id,
            'cart_id'   => $cartItem->cart_id,
            'quantity'  => $cartItem->quantity,
            'product'   => [
                'id'    => $cartItem->products->id,
                'name'  => $cartItem->products->name,
                'price' => $cartItem->products->price,
            ],
        ],
    ],
        ],201);
    }
    /**
     * Update an existing cart item (update quantity).
     */
    public function update(UpdateCartItemsRequest $request, $id)
    {
        $user = JWTAuth::user();

        // Ambil item keranjang berdasarkan ID milik user
        $cartItem = Cart_items::whereHas('carts', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($id);

        // Update kuantitas produk
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json([
            'status'=>true,
            'message'=>'Update Quantity Item Successfully',
            'data'=>$cartItem,
        ],201);
    }

    /**
     * Remove a cart item.
     */
    public function destroy($id)
    {
        $user = JWTAuth::user();

        // Cari item yang sesuai dengan user
        $cartItem = Cart_items::whereHas('carts', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($id);

        $cartItem->delete();

        return response()->json([
            'status'=>true,
            'message'=>'Cart Item Successfully Deleted',
            'data'=>$cartItem,
        ],201);
    }
}
