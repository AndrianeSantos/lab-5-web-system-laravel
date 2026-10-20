@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0"><i class="bi bi-box me-2 text-primary"></i>Product Inventory</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Add Product
    </a>
</div>

<!-- Filters & Search -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('products.index') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Search</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Name or SKU..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select">
                    <option value="all">All Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Stock Status</label>
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="in" {{ request('status') == 'in' ? 'selected' : '' }}>In Stock</option>
                    <option value="low" {{ request('status') == 'low' ? 'selected' : '' }}>Low Stock</option>
                    <option value="out" {{ request('status') == 'out' ? 'selected' : '' }}>Out of Stock</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Products Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>SKU</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Qty</th>
                        <th>Reorder</th>
                        <th>Unit Price</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr class="{{ $product->isLowStock() ? 'table-warning' : ($product->isOutOfStock() ? 'table-danger' : '') }}">
                        <td><code>{{ $product->sku }}</code></td>
                        <td>
                            <a href="{{ route('products.show', $product) }}" class="text-decoration-none fw-medium">
                                {{ $product->name }}
                            </a>
                            @if($product->supplier)
                                <br><small class="text-muted">{{ $product->supplier }}</small>
                            @endif
                        </td>
                        <td>{{ $product->category }}</td>
                        <td class="fw-bold">{{ $product->quantity }}</td>
                        <td>{{ $product->reorder_level }}</td>
                        <td>${{ number_format($product->unit_price, 2) }}</td>
                        <td>${{ number_format($product->inventory_value, 2) }}</td>
                        <td>
                            <span class="badge {{ $product->stock_status_badge }}">
                                {{ $product->stock_status }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-outline-secondary" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            No products found. <a href="{{ route('products.create') }}">Add your first product</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($products->hasPages())
    <div class="card-footer bg-white">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
