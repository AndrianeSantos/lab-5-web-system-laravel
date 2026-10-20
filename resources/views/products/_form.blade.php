<div class="row g-3">
    <div class="col-md-8">
        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" 
               id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="sku" class="form-label">SKU <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('sku') is-invalid @enderror" 
               id="sku" name="sku" value="{{ old('sku', $product->sku ?? '') }}" required>
        @error('sku')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" 
                  id="description" name="description" rows="2">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
        <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
            <option value="">Select category...</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat }}" {{ old('category', $product->category ?? '') == $cat ? 'selected' : '' }}>
                    {{ $cat }}
                </option>
            @endforeach
        </select>
        @error('category')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="supplier" class="form-label">Supplier</label>
        <input type="text" class="form-control @error('supplier') is-invalid @enderror" 
               id="supplier" name="supplier" value="{{ old('supplier', $product->supplier ?? '') }}">
        @error('supplier')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="unit_price" class="form-label">Unit Price ($) <span class="text-danger">*</span></label>
        <input type="number" step="0.01" min="0" class="form-control @error('unit_price') is-invalid @enderror" 
               id="unit_price" name="unit_price" value="{{ old('unit_price', $product->unit_price ?? '') }}" required>
        @error('unit_price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="quantity" class="form-label">Quantity in Stock <span class="text-danger">*</span></label>
        <input type="number" min="0" class="form-control @error('quantity') is-invalid @enderror" 
               id="quantity" name="quantity" value="{{ old('quantity', $product->quantity ?? 0) }}" required>
        @error('quantity')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="reorder_level" class="form-label">Reorder Level <span class="text-danger">*</span></label>
        <input type="number" min="0" class="form-control @error('reorder_level') is-invalid @enderror" 
               id="reorder_level" name="reorder_level" value="{{ old('reorder_level', $product->reorder_level ?? 10) }}" required>
        <div class="form-text">Alert when stock falls to or below this level.</div>
        @error('reorder_level')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
