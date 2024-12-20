<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Store a new cart for the authenticated user and add items to it
    public function store(FormRequest $request): JsonResponse
    {
        // Validate the request data    
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
        

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::user()->id
        ]);

        // Loop through the items and add them to the cart
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);

            // Check if product exists
            if (!$product) {
                Log::error('Product not found', ['product_id' => $item['product_id']]);
                return response()->json(['message' => 'Product not found'], 404);
            }

            // Create a cart item for each product added
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'total' => $product->price * $item['quantity'],
            ]);
        }

        // Return the response with the created cart and cart items
        return response()->json([
            'message' => 'Cart created and items added successfully',
            'cart' => $cart->load('items.product'),  // Include the cart items and product details
        ], 201);
    }

    // Optional: Method to fetch the cart for the authenticated user
    public function show(Request $request): JsonResponse
    {
        $user = $request->user();
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart) {
            return response()->json(['message' => 'No cart found for this user.'], 404);
        }

        return response()->json([
            'cart' => $cart
        ], 200);
    }

    // destroy the cart item for the authenticated user
    public function destroy(Request $request, $id): JsonResponse
    {
        $user = $request->user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['message' => 'No cart found for this user.'], 404);
        }

        $cartItem = CartItem::where('cart_id', $cart->id)->where('id', $id)->first();

        if (!$cartItem) {
            return response()->json(['message' => 'No cart item found for this user.'], 404);
        }

        $cartItem->delete();

        return response()->json([
            'message' => 'Cart item deleted successfully'
        ], 200);
    }

    // Method to delete the entire cart for the authenticated user
    public function destroyCart(Request $request): JsonResponse
    {
        $user = $request->user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['message' => 'No cart found for this user.'], 404);
        }

        $cart->delete();

        return response()->json([
            'message' => 'Cart deleted successfully'
        ], 200);
    }

}
