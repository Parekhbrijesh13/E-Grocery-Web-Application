@extends('Admin.layouts.master')
@section('title', 'Add Product')

@section('content')

<div class="page-header">
    <div style="display:flex;align-items:center;gap:12px;">
        <a href="" class="btn btn-outline btn-sm"><i class="fa-solid fa-arrow-left"></i></a>
        <div>
            <h1>Add Product</h1>
            <p>Fill in the details to add a new product to your catalogue.</p>
        </div>
    </div>
    <div style="display:flex;gap:8px;">
        <button class="btn btn-outline">Save as Draft</button>
        <button class="btn btn-primary" form="productForm"><i class="fa-solid fa-check"></i> Publish</button>
    </div>
</div>

<form id="productForm" action="" method="POST" enctype="multipart/form-data">
@csrf
<div class="grid" style="grid-template-columns:1fr 320px;gap:20px;align-items:start;">
    <!-- Left -->
    <div style="display:flex;flex-direction:column;gap:18px;">
        <div class="card">
            <div class="card-header"><span class="card-title">Basic Information</span></div>
            <div class="form-group">
                <label class="form-label">Product Name *</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Alphonso Mangoes 1kg">
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Write a product description…"></textarea>
            </div>
            <div class="grid grid-2">
                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        <option>Fruits & Vegetables</option>
                        <option>Dairy & Eggs</option>
                        <option>Grains & Pulses</option>
                        <option>Snacks & Beverages</option>
                        <option>Personal Care</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Sub Category</label>
                    <select name="subcategory_id" class="form-control">
                        <option>Select Subcategory</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Tags</label>
                <input type="text" name="tags" class="form-control" placeholder="e.g. organic, fresh, seasonal (comma separated)">
            </div>
        </div>

        <div class="card">
            <div class="card-header"><span class="card-title">Pricing</span></div>
            <div class="grid grid-3">
                <div class="form-group">
                    <label class="form-label">MRP (₹) *</label>
                    <input type="number" name="mrp" class="form-control" placeholder="0.00">
                </div>
                <div class="form-group">
                    <label class="form-label">Selling Price (₹) *</label>
                    <input type="number" name="price" class="form-control" placeholder="0.00">
                </div>
                <div class="form-group">
                    <label class="form-label">Cost Price (₹)</label>
                    <input type="number" name="cost_price" class="form-control" placeholder="0.00">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Tax / GST (%)</label>
                <select name="tax" class="form-control">
                    <option>0% (Exempt)</option>
                    <option>5%</option>
                    <option>12%</option>
                    <option>18%</option>
                    <option>28%</option>
                </select>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><span class="card-title">Inventory</span></div>
            <div class="grid grid-3">
                <div class="form-group">
                    <label class="form-label">SKU</label>
                    <input type="text" name="sku" class="form-control" placeholder="e.g. FV-MANGO-1KG">
                </div>
                <div class="form-group">
                    <label class="form-label">Stock Quantity *</label>
                    <input type="number" name="stock" class="form-control" placeholder="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Unit</label>
                    <select name="unit" class="form-control">
                        <option>kg</option>
                        <option>g</option>
                        <option>L</option>
                        <option>ml</option>
                        <option>pcs</option>
                        <option>dozen</option>
                        <option>pack</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Low Stock Alert Threshold</label>
                <input type="number" name="low_stock_threshold" class="form-control" placeholder="e.g. 10">
            </div>
        </div>
    </div>

    <!-- Right -->
    <div style="display:flex;flex-direction:column;gap:18px;">
        <div class="card">
            <div class="card-header"><span class="card-title">Product Images</span></div>
            <div style="border:2px dashed var(--border);border-radius:10px;padding:30px;text-align:center;cursor:pointer;transition:.15s;margin-bottom:12px;" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">
                <div style="font-size:32px;margin-bottom:8px;">📷</div>
                <div style="font-weight:600;margin-bottom:4px;">Drop images here</div>
                <div style="font-size:12px;color:var(--muted);">PNG, JPG up to 5MB each</div>
                <input type="file" name="images[]" multiple style="opacity:0;position:absolute;">
            </div>
            <div style="font-size:11px;color:var(--muted);">First image will be the main product photo.</div>
        </div>

        <div class="card">
            <div class="card-header"><span class="card-title">Status</span></div>
            <div class="form-group">
                <label class="form-label">Availability</label>
                <select name="status" class="form-control">
                    <option value="active">Active (Live)</option>
                    <option value="draft">Draft</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:10px;background:var(--surface2);border-radius:8px;margin-bottom:10px;">
                <div>
                    <div style="font-size:13px;font-weight:500;">Featured Product</div>
                    <div style="font-size:11px;color:var(--muted);">Show on homepage</div>
                </div>
                <label style="position:relative;display:inline-block;width:40px;height:22px;">
                    <input type="checkbox" name="featured" style="opacity:0;width:0;height:0;">
                    <span style="position:absolute;cursor:pointer;inset:0;background:var(--border);border-radius:22px;transition:.2s;"></span>
                </label>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:10px;background:var(--surface2);border-radius:8px;">
                <div>
                    <div style="font-size:13px;font-weight:500;">Cash on Delivery</div>
                    <div style="font-size:11px;color:var(--muted);">Allow COD for this item</div>
                </div>
                <label style="position:relative;display:inline-block;width:40px;height:22px;">
                    <input type="checkbox" name="cod" checked style="opacity:0;width:0;height:0;">
                    <span style="position:absolute;cursor:pointer;inset:0;background:var(--accent);border-radius:22px;transition:.2s;"></span>
                </label>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><span class="card-title">SEO</span></div>
            <div class="form-group">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control" placeholder="SEO title">
            </div>
            <div class="form-group">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_desc" class="form-control" rows="2" placeholder="SEO description"></textarea>
            </div>
        </div>
    </div>
</div>
</form>

@endsection
