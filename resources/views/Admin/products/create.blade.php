@extends('Admin.layouts.master')
@section('title', $isEdit ? 'Edit Product' : 'Add Product')

@section('content')

    <div class="page-header">
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline btn-sm">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1>{{ $isEdit ? 'Edit Product' : 'Add Product' }}</h1>
                <p>{{ $isEdit ? 'Update product details and inventory.' : 'Fill in the details to add a new product to your catalogue.' }}
                </p>
            </div>
        </div>
        <div style="display:flex;gap:8px;">
            <button type="submit" name="save_draft" value="1" class="btn btn-outline" form="productForm">Save as Draft</button>
            <button type="submit" class="btn btn-primary" form="productForm">
                <i class="fa-solid fa-check"></i> {{ $isEdit ? 'Save Changes' : 'Publish' }}
            </button>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-error" style="margin-bottom:18px;">
            <i class="fa-solid fa-circle-xmark"></i> Please fix the highlighted product details.
        </div>
    @endif

    <form id="productForm"
        action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="grid" style="grid-template-columns:1fr 320px;gap:20px;align-items:start;">
            <div style="display:flex;flex-direction:column;gap:18px;">
                <div class="card">
                    <div class="card-header"><span class="card-title">Basic Information</span></div>

                    <div class="form-group">
                        <label class="form-label">Product Name *</label>
                        <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}"
                            class="form-control" placeholder="e.g. Alphonso Mangoes 1kg">
                        @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-2">
                        <div class="form-group">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" class="form-control"
                                placeholder="auto-generated">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Brand</label>
                            <input type="text" name="brand" value="{{ old('brand', $product->brand) }}"
                                class="form-control" placeholder="e.g. Amul">
                            @error('brand')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4"
                            placeholder="Write a product description...">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-2">
                        <div class="form-group">
                            <label class="form-label">Category *</label>
                            <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id) === (string) $category->id)>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tags</label>
                            <input type="text" name="tags" value="{{ old('tags', $product->tags) }}"
                                class="form-control" placeholder="organic, fresh, seasonal">
                            @error('tags')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><span class="card-title">Pricing</span></div>
                    <div class="grid grid-3">
                        <div class="form-group">
                            <label class="form-label">MRP (Rs.) *</label>
                            <input type="number" step="0.01" min="0" name="mrp"
                                value="{{ old('mrp', $product->mrp) }}" class="form-control" placeholder="0.00">
                            @error('mrp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Selling Price (Rs.) *</label>
                            <input type="number" step="0.01" min="0" name="price"
                                value="{{ old('price', $product->price) }}" class="form-control" placeholder="0.00">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Cost Price (Rs.)</label>
                            <input type="number" step="0.01" min="0" name="cost_price"
                                value="{{ old('cost_price', $product->cost_price) }}" class="form-control"
                                placeholder="0.00">
                            @error('cost_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tax / GST (%)</label>
                        <select name="tax" class="form-control">
                            @foreach ([0, 5, 12, 18, 28] as $tax)
                                <option value="{{ $tax }}" @selected((string) old('tax', $product->tax ?? 0) === (string) $tax)>
                                    {{ $tax }}%
                                </option>
                            @endforeach
                        </select>
                        @error('tax')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><span class="card-title">Inventory</span></div>
                    <div class="grid grid-3">
                        <div class="form-group">
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-control"
                                placeholder="e.g. FV-MANGO-1KG">
                            @error('sku')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Stock Quantity *</label>
                            <input type="number" min="0" name="stock" value="{{ old('stock', $product->stock) }}"
                                class="form-control" placeholder="0">
                            @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Low Stock Alert</label>
                            <input type="number" min="0" name="low_stock_threshold"
                                value="{{ old('low_stock_threshold', $product->low_stock_threshold) }}"
                                class="form-control" placeholder="10">
                            @error('low_stock_threshold')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-2">
                        <div class="form-group">
                            <label class="form-label">Pack Size *</label>
                            <input type="number" step="0.01" min="0.01" name="unit_value"
                                value="{{ old('unit_value', $product->unit_value) }}" class="form-control"
                                placeholder="1">
                            @error('unit_value')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Unit *</label>
                            <select name="unit" class="form-control">
                                @foreach (['kg', 'g', 'L', 'ml', 'pcs', 'dozen', 'pack'] as $unit)
                                    <option value="{{ $unit }}" @selected(old('unit', $product->unit) === $unit)>
                                        {{ $unit }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div style="display:flex;flex-direction:column;gap:18px;">
                <div class="card">
                    <div class="card-header"><span class="card-title">Product Images</span></div>
                    <label
                        style="border:2px dashed var(--border);border-radius:10px;padding:30px;text-align:center;cursor:pointer;transition:.15s;margin-bottom:12px;display:block;">
                        <div style="font-size:32px;margin-bottom:8px;"><i class="fa-solid fa-camera"></i></div>
                        <div style="font-weight:600;margin-bottom:4px;">Upload Images</div>
                        <div style="font-size:12px;color:var(--muted);">PNG, JPG, WEBP up to 5MB</div>
                        <input type="file" name="images[]" id="product_images" multiple style="display:none;">
                    </label>
                    @error('images')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @error('images.*')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div id="image-preview" style="display:flex;gap:8px;flex-wrap:wrap;margin-top:10px;">
                        @foreach (($product->images ?? []) as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->product_name }}"
                                style="width:64px;height:64px;border-radius:8px;object-fit:cover;border:1px solid var(--border);">
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><span class="card-title">Status</span></div>
                    <div class="form-group">
                        <label class="form-label">Availability</label>
                        <select name="status" class="form-control">
                            <option value="active" @selected(old('status', $product->status) === 'active')>Active</option>
                            <option value="draft" @selected(old('status', $product->status) === 'draft')>Draft</option>
                            <option value="inactive" @selected(old('status', $product->status) === 'inactive')>Inactive</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="hidden" name="featured" value="0">
                    <label
                        style="display:flex;align-items:center;gap:10px;padding:10px;background:var(--surface2);border-radius:8px;margin-bottom:10px;cursor:pointer;">
                        <input type="checkbox" name="featured" value="1" @checked((string) old('featured', $product->featured ? '1' : '0') === '1')>
                        <span>
                            <span style="font-size:13px;font-weight:500;display:block;">Featured Product</span>
                            <span style="font-size:11px;color:var(--muted);display:block;">Show on homepage</span>
                        </span>
                    </label>
                    @error('featured')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="hidden" name="cod" value="0">
                    <label
                        style="display:flex;align-items:center;gap:10px;padding:10px;background:var(--surface2);border-radius:8px;cursor:pointer;">
                        <input type="checkbox" name="cod" value="1" @checked((string) old('cod', $product->cod ? '1' : '0') === '1')>
                        <span>
                            <span style="font-size:13px;font-weight:500;display:block;">Cash on Delivery</span>
                            <span style="font-size:11px;color:var(--muted);display:block;">Allow COD for this item</span>
                        </span>
                    </label>
                    @error('cod')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="card">
                    <div class="card-header"><span class="card-title">SEO</span></div>
                    <div class="form-group">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}"
                            class="form-control" placeholder="SEO title">
                        @error('meta_title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_desc" class="form-control" rows="2" placeholder="SEO description">{{ old('meta_desc', $product->meta_desc) }}</textarea>
                        @error('meta_desc')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('scripts')
    <script>
        const imageInput = document.getElementById('product_images');
        const preview = document.getElementById('image-preview');

        imageInput?.addEventListener('change', function() {
            preview.innerHTML = '';

            Array.from(this.files).forEach((file) => {
                const reader = new FileReader();

                reader.onload = function(event) {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.style.width = '64px';
                    img.style.height = '64px';
                    img.style.borderRadius = '8px';
                    img.style.objectFit = 'cover';
                    img.style.border = '1px solid var(--border)';
                    preview.appendChild(img);
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
