<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderItemsRequest;
use App\Models\Order_items;
use App\Models\Orders;
use App\Models\Products;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderItemsController extends Controller
{
    /**
     * Menampilkan semua item dalam satu order milik user
     */
    public function index($orderId)
    {
        $user = JWTAuth::user();

        // Cari order yang dimiliki user
        $order = Orders::where('id', $orderId)->where('user_id', $user->id)->first();

        if (!$order) {
            return response()->json([
                'response'=> [
                    'status'=>false,
                    'message'=>'Order Not Found',
                    'order'=>$order,
                ]
            ],404);
        }

        // Ambil semua item di dalam order tersebut
        $orderItems = Order_items::where('order_id', $order->id)->with('products')->get();

        return response()->json([
            'response'=> [
                'status'=>false,
                'message'=>'Order items Retrieved Successfully',
                'order'=>$orderItems,
            ]
        ],200);
    }

    /**
     * Menampilkan satu item dalam order
     */
    public function show($orderId, $itemId)
    {
        $user = JWTAuth::user();

        // Cari order milik user
        $order = Orders::where('id', $orderId)->where('user_id', $user->id)->first();

        if (!$order) {
            return response()->json([
                'response'=> [
                    'status'=>false,
                    'message'=>'Order Not Found',
                ]
            ],404);
        }

        // Cari order item dalam order tersebut
        $orderItem = Order_items::where('order_id', $order->id)->where('id', $itemId)->with('product')->first();

        if (!$orderItem) {
            return response()->json([
                'response'=> [
                    'status'=>false,
                    'message'=>'Order item Not Found',
                ]
            ],404);
        }

        return response()->json([
            'response'=> [
                'status'=>true,
                'message'=>'Order Item Retrieved Successfully',
                'order'=>$orderItem,
            ]
        ],200);
    }

    /**
     * Menambahkan item ke dalam order (jika diizinkan)
     */
    public function store(OrderItemsRequest $request, $orderId)
    {
        $user = JWTAuth::user();

        // Validasi input
        $request->validated();

        // Cari order milik user
        $order = Orders::where('id', $orderId)->where('user_id', $user->id)->first();

        if (!$order) {
            return response()->json([
                'response'=> [
                'status'=>false,
                'message'=>'Order Not Found',
                ]
            ],404);
        }

        // Ambil produk
        $product = Products::find($request->product_id);

        // Tambahkan item ke order
        $orderItem = Order_items::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->price
        ]);

        return response()->json([
            'response'=> [
            'status'=>true,
            'message'=>'Order Item Added Successfully',
            'order'=>$orderItem,
            ]
        ],201);
    }

    /**
     * Menghapus item dari order
     */
    public function destroy($orderId, $itemId)
    {
        $user = JWTAuth::user();

        // Cari order milik user
        $order = Orders::where('id', $orderId)->where('user_id', $user->id)->first();

        if (!$order) {
            return response()->json([
                'response'=> [
                'status'=>false,
                'message'=>'Order Not Found',
                ]
            ],404);
        }

        // Cari order item dalam order tersebut
        $orderItem = Order_items::where('order_id', $order->id)->where('id', $itemId)->first();

        if (!$orderItem) {
            return response()->json([
                'response'=> [
                'status'=>false,
                'message'=>'Order item Not Found',
                ]
            ],404);
        }

        // Hapus item
        $orderItem->delete();

        return response()->json([
            'response'=> [
            'status'=>true,
            'message'=>'Order item Deleted Successfully',
            ]
        ],200);
    }
}
