<?php
namespace App\Http\Controllers;

use App\Http\Requests\CartsRequest;
use App\Models\Carts;
use Tymon\JWTAuth\Facades\JWTAuth;

class CartsController extends Controller
{
    /**
     * Display a listing of the user's cart.
     */
    public function index()
    {
        $user = JWTAuth::user(); // Mendapatkan user yang sedang login

        // Ambil keranjang milik user
        $carts = Carts::with('Cart_items.products')->where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return response()->json([
                'status'=>false,
                'message'=>'Carts Not Found',
                'data'=>$carts,
            ],404);
        }

        return response()->json([
            'status'=>true,
            'message'=>'Cart Items User',
            'data'=>$carts,
        ],201);
    }

    /**
     * Store a newly created cart in storage.
     */
    public function store(CartsRequest $request)
    {
        $user = JWTAuth::user(); // Mendapatkan user yang sedang login

        // Buat keranjang baru
        $cart = Carts::firstOrCreate(
            ['user_id' => $user->id] 
        );

        return response()->json([
            'status'=>true,
            'message'=>'Create Cart',
            'data'=>$cart,
        ],201); 
    }

    /**
     * Display the specified cart.
     */
    public function show($id)
    {
        $user = JWTAuth::user();

        // Ambil keranjang berdasarkan ID dan milik user
        $cart = Carts::with('Cart_items.products')
            ->where('user_id', $user->id)
            ->findOrFail($id);

        return response()->json([
            'status'=>true,
            'message'=>'Keranjang Item Milik User',
            'data'=>$cart,
        ],201);
    }

    /**
     * Remove the specified cart from storage.
     */
    public function destroy($id)
    {
        $user = JWTAuth::user();

        // Hapus keranjang berdasarkan ID dan milik user
        $cart = Carts::where('user_id', $user->id)->findOrFail($id);

        $cart->delete();

        return response()->json([
            'status'=>true,
            'message'=>'Cart Deleted Successfully',
            'data'=>$cart,
        ]);
    }
}
