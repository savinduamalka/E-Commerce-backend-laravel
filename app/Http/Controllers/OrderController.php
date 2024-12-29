<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    // Create a new order for the authenticated user
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);

            // Reduce the stock of the product
            if ($product->stock < $item['quantity']) {
                return response()->json(['message' => 'Insufficient stock for product: ' . $product->name], 400);
            }
            $product->stock -= $item['quantity'];
            $product->save();

            $price = $product->discounted_price ?? $product->price;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $price,
                'total' => $price * $item['quantity'],
            ]);
        }

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order->load('items.product'),
        ], 201);
    }

    // Fetch all orders and order items with pagination 
    public function index(): JsonResponse
    {
        return response()->json(Order::with('items.product')->paginate(12));
    }


    // Method to update the order status
    public function updateStatus(Request $request, $orderId): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:pending,completed,declined',
        ]);

        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // If the status is changed to "declined", increase the stock
        if ($order->status !== 'declined' && $request->status === 'declined') {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                $product->stock += $item->quantity;
                $product->save();
            }
        }

        $order->status = $request->status;
        $order->save();

        return response()->json([
            'message' => 'Order status updated successfully',
            'order' => $order,
        ], 200);
    }

    // Method to delete an order
    public function destroy($orderId): JsonResponse
    {
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Increase the stock of the products in the order only if the order is "pending"
        if ($order->status === 'pending') {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                $product->stock += $item->quantity;
                $product->save();
            }
        }

        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully'
        ], 200);
    }
}
