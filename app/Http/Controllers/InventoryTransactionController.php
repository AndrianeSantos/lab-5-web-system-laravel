<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryTransaction;
use App\Models\Product;

class InventoryTransactionController extends Controller
{
    public function index()
    {
        $transactions = InventoryTransaction::with('product')->latest()->paginate(10);
        
        return view('transactions.index', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:stock_in,stock_out,adjustment',
            'quantity' => 'required|integer|min:1',
            'reference_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->type == 'stock_in') {
            $product->stock += $request->quantity;
        } elseif ($request->type == 'stock_out') {
            if ($product->stock < $request->quantity) {
                return redirect()->back()->with('error', 'Insufficient stock for this transaction!');
            }
            $product->stock -= $request->quantity;
        } elseif ($request->type == 'adjustment') {
            $product->stock = $request->quantity;
        }
        
        $product->save();

        InventoryTransaction::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'type' => $request->type,
            'quantity' => $request->quantity,
            'reference_number' => $request->reference_number,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Transaction recorded and stock updated successfully!');
    }
}