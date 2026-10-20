@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0"><i class="bi bi-box me-2 text-primary"></i>{{ $product->name }}</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">
            <i class="bi bi-pencil me-1"></i> Edit
        </a>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pt-3">
                <h5 class="mb-0">Product Details</h5>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3">SKU</dt>
                    <dd class="col-sm-9"><code>{{ $product->sku }}</code></dd>

                    <dt class="col-sm-3">Category</dt>
                    <dd class="col-sm-9">{{ $product->category }}</dd>

                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">{{ $product->description ?: '—' }}</dd>

                    <dt class="col-sm-3">Supplier</dt>
                    <dd class="col-sm-9">{{ $product->supplier ?: '—' }}</dd>

                    <dt class="col-sm-3">Unit Price</dt>
                    <dd class="col-sm-9">${{ number_format($product->unit_price, 2) }}</dd>

                    <dt class="col-sm-3">Created</dt>
                    <dd class="col-sm-9">{{ $product->created_at->format('M d, Y H:i') }}</dd>

                    <dt class="col-sm-3">Last Updated</dt>
                    <dd class="col-sm-9">{{ $product->updated_at->format('M d, Y H:i') }}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body text-center">
                <div class="display-4 fw-bold {{ $product->isOutOfStock() ? 'text-danger' : ($product->isLowStock() ? 'text-warning' : 'text-success') }}">
                    {{ $product->quantity }}
                </div>
                <div class="text-muted">Units in Stock</div>
                <span class="badge {{ $product->stock_status_badge }} mt-2 fs-6">
                    {{ $product->stock_status }}
                </span>
            </div>
        </div>
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Reorder Level</span>
                    <strong>{{ $product->reorder_level }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Inventory Value</span>
                    <strong class="text-primary">${{ number_format($product->inventory_value, 2) }}</strong>
                </div>
            </div>
        </div>
        <form action="{{ route('products.destroy', $product) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this product?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger w-100">
                <i class="bi bi-trash me-1"></i> Delete Product
            </button>
        </form>
    </div>
</div>
@endsection
