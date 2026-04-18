@extends('Admin.layouts.master')
@section('title', 'Create Offer')

@section('content')

<div class="page-header">
    <div style="display:flex;align-items:center;gap:12px;">
        <a href="" class="btn btn-outline btn-sm"><i class="fa-solid fa-arrow-left"></i></a>
        <div>
            <h1>Create New Offer</h1>
            <p>Set up a discount or promotional offer.</p>
        </div>
    </div>
</div>

<div class="grid" style="grid-template-columns:1fr 340px;gap:20px;align-items:start;">
    <!-- Main Form -->
    <div style="display:flex;flex-direction:column;gap:18px;">
        <div class="card">
            <div class="card-header"><span class="card-title">Offer Details</span></div>
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Offer Name *</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Summer Fresh Sale">
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="What does this offer include?"></textarea>
                </div>
                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">Discount Type *</label>
                        <select name="discount_type" class="form-control" id="discountType">
                            <option value="percentage">Percentage (%)</option>
                            <option value="flat">Flat Amount (₹)</option>
                            <option value="bxgy">Buy X Get Y</option>
                            <option value="free_delivery">Free Delivery</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Discount Value *</label>
                        <input type="number" name="discount_value" class="form-control" placeholder="e.g. 20">
                    </div>
                </div>
                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">Min Order Amount (₹)</label>
                        <input type="number" name="min_order" class="form-control" placeholder="0 = no minimum">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Max Discount Cap (₹)</label>
                        <input type="number" name="max_discount" class="form-control" placeholder="Leave empty for unlimited">
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><span class="card-title">Applies To</span></div>
                <div class="form-group">
                    <label class="form-label">Offer Scope</label>
                    <select name="scope" class="form-control">
                        <option value="all">All Products</option>
                        <option value="category">Specific Categories</option>
                        <option value="product">Specific Products</option>
                        <option value="new_user">New Users Only</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Select Categories (if applicable)</label>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        @foreach(['Fruits & Vegetables','Dairy & Eggs','Grains & Pulses','Snacks & Beverages','Personal Care','Meat & Seafood'] as $cat)
                        <label style="display:flex;align-items:center;gap:6px;padding:6px 12px;background:var(--surface2);border:1px solid var(--border);border-radius:6px;cursor:pointer;font-size:12.5px;">
                            <input type="checkbox" name="categories[]" value="{{ strtolower($cat) }}"> {{ $cat }}
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><span class="card-title">Validity & Limits</span></div>
                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">Start Date *</label>
                        <input type="date" name="start_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control">
                    </div>
                </div>
                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">Usage Limit (total)</label>
                        <input type="number" name="usage_limit" class="form-control" placeholder="Leave empty = unlimited">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Per User Limit</label>
                        <input type="number" name="per_user_limit" class="form-control" placeholder="e.g. 1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Coupon Code (optional)</label>
                    <div style="display:flex;gap:8px;">
                        <input type="text" name="coupon_code" class="form-control" placeholder="e.g. SUMMER20" style="text-transform:uppercase;">
                        <button type="button" class="btn btn-outline">Generate</button>
                    </div>
                    <div style="font-size:11px;color:var(--muted);margin-top:5px;">Leave empty to apply automatically without a code.</div>
                </div>
                <div style="display:flex;gap:8px;margin-top:8px;">
                    <button type="button" class="btn btn-outline" style="flex:1;justify-content:center;">Save as Draft</button>
                    <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center;"><i class="fa-solid fa-check"></i> Create Offer</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Preview -->
    <div class="card" style="position:sticky;top:76px;">
        <div class="card-header"><span class="card-title">Preview</span></div>
        <div style="background:linear-gradient(135deg,rgba(63,185,80,.15),rgba(63,185,80,.05));border:1px solid rgba(63,185,80,.3);border-radius:10px;padding:20px;text-align:center;">
            <div style="font-size:36px;margin-bottom:8px;">🌿</div>
            <div style="font-family:'Syne',sans-serif;font-size:18px;font-weight:800;color:var(--accent);">Your Offer Name</div>
            <div style="font-size:13px;color:var(--muted);margin:6px 0 14px;">Offer description goes here</div>
            <div style="font-size:32px;font-family:'Syne',sans-serif;font-weight:800;">20% OFF</div>
            <div style="font-size:12px;color:var(--muted);margin-top:8px;">Min order ₹200 · Max discount ₹100</div>
            <div style="font-size:11px;margin-top:10px;padding:5px;background:rgba(63,185,80,.1);border-radius:5px;">Valid till Jul 31, 2025</div>
        </div>
        <div style="margin-top:14px;font-size:12px;color:var(--muted);line-height:1.7;">
            <div><strong style="color:var(--text);">💡 Tips:</strong></div>
            <div>• Clear offer names perform better</div>
            <div>• Short validity increases urgency</div>
            <div>• Category-specific deals convert higher</div>
        </div>
    </div>
</div>

@endsection
