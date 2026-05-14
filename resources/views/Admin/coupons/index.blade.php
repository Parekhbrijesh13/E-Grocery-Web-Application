@extends('Admin.layouts.master')
@section('title', 'Coupons')

@section('content')

    <div class="page-header">
        <div>
            <h1>Coupons</h1>
            <p>Create and manage discount codes for your customers.</p>
        </div>
    </div>

    <div class="grid" style="grid-template-columns:1fr 380px;gap:20px;">

        <!-- Coupon List -->
        <div class="card">
            <div class="card-header">
                <span class="card-title">All Coupons ({{ $coupons->count() }})</span>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Discount</th>
                            <th>Min Spend</th>
                            <th>Validity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td style="font-weight:700;font-family:monospace;letter-spacing:1px;color:var(--accent);">{{ $coupon->code }}</td>
                                <td style="font-weight:600;">
                                    {{ $coupon->type == 'fixed' ? '₹ ' . $coupon->value : $coupon->value . ' %' }}
                                </td>
                                <td style="color:var(--muted);font-size:13px;">{{ $coupon->min_spend ? '₹ '.$coupon->min_spend : 'None' }}</td>
                                <td style="font-size:12px;color:var(--text);">
                                    {{ $coupon->start_date ?? 'Anytime' }}<br>
                                    <span style="color:var(--muted);">to</span> {{ $coupon->end_date ?? 'No expiry' }}
                                </td>
                                <td><span
                                        class="badge {{ $coupon->status ? 'badge-green' : 'badge-gray' }}">{{ $coupon->status ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <button type="button" class="btn btn-outline btn-sm edit-coupon-btn" data-bs-toggle="modal"
                                            data-bs-target="#editCouponModal"
                                            data-id="{{ $coupon->id }}"
                                            data-update-url="{{ route('admin.coupons.update', $coupon->id) }}"
                                            data-code="{{ $coupon->code }}"
                                            data-type="{{ $coupon->type }}"
                                            data-value="{{ $coupon->value }}"
                                            data-min_spend="{{ $coupon->min_spend }}"
                                            data-start_date="{{ $coupon->start_date }}"
                                            data-end_date="{{ $coupon->end_date }}"
                                            data-status="{{ $coupon->status ? 1 : 0 }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>

                                        <form action="{{ route('admin.coupons.delete', $coupon->id) }}" method="POST"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Coupon Form -->
        <div class="card" style="align-self:start;">
            <div class="card-header"><span class="card-title">Add New Coupon</span></div>

            <form id="coupon-form">
                @csrf

                <div class="form-group">
                    <label class="form-label">Coupon Code *</label>
                    <input type="text" name="code" class="form-control" placeholder="e.g. SUMMER20">
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                </div>

                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label class="form-label">Discount Type</label>
                        <select name="type" class="form-control">
                            <option value="fixed">Fixed Amount (₹)</option>
                            <option value="percent">Percentage (%)</option>
                        </select>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="form-label">Value *</label>
                        <input type="number" step="0.01" name="value" class="form-control" placeholder="10.00">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Min Spend (₹)</label>
                    <input type="number" step="0.01" name="min_spend" class="form-control" placeholder="0.00">
                </div>

                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">
                    Create Coupon
                </button>
            </form>
        </div>

        <!-- Edit Coupon Modal -->
        <div class="modal fade" id="editCouponModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background: var(--surface); border: 1px solid var(--border);">

                    <div class="modal-header" style="border-bottom: 1px solid rgba(48, 54, 61, .5);">
                        <h5 class="modal-title" style="font-family: 'Syne', sans-serif; font-size: 16px; font-weight: 700;">Edit Coupon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form id="edit-coupon-form">
                        @csrf
                        @method('PUT')

                        <div class="modal-body" style="padding: 20px;">
                            <input type="hidden" name="id" id="edit_id">

                            <div class="form-group mb-3">
                                <label class="form-label">Coupon Code *</label>
                                <input type="text" name="code" id="edit_code" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Discount Type</label>
                                    <select name="type" id="edit_type" class="form-control">
                                        <option value="fixed">Fixed Amount (₹)</option>
                                        <option value="percent">Percentage (%)</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Value *</label>
                                    <input type="number" step="0.01" name="value" id="edit_value" class="form-control">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Min Spend (₹)</label>
                                <input type="number" step="0.01" name="min_spend" id="edit_min_spend" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="start_date" id="edit_start_date" class="form-control">
                                </div>
                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">End Date</label>
                                    <input type="date" name="end_date" id="edit_end_date" class="form-control">
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <label class="form-label">Status</label>
                                <select name="status" id="edit_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer" style="border-top: 1px solid rgba(48, 54, 61, .5); padding: 12px 20px;">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() }
            });

            // Submit Add Form
            $('#coupon-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.coupons.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        alert('Coupon created successfully!');
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let msg = '';
                            for (let field in errors) { msg += errors[field][0] + "\n"; }
                            alert(msg);
                        } else alert('Something went wrong!');
                    }
                });
            });

            // Open Edit Modal
            $(document).on('click', '.edit-coupon-btn', function() {
                let button = $(this);
                $('#edit-coupon-form').attr('action', button.attr('data-update-url'));
                $('#edit_id').val(button.attr('data-id'));
                $('#edit_code').val(button.attr('data-code'));
                $('#edit_type').val(button.attr('data-type'));
                $('#edit_value').val(button.attr('data-value'));
                $('#edit_min_spend').val(button.attr('data-min_spend'));
                $('#edit_start_date').val(button.attr('data-start_date'));
                $('#edit_end_date').val(button.attr('data-end_date'));
                $('#edit_status').val(button.attr('data-status'));
            });

            // Submit Edit Form
            $('#edit-coupon-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        alert('Coupon updated successfully!');
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let msg = '';
                            for (let field in errors) { msg += errors[field][0] + "\n"; }
                            alert(msg);
                        } else alert('Something went wrong!');
                    }
                });
            });

            // Delete
            $(document).on('submit', '.delete-form', function(e) {
                e.preventDefault();
                if (!confirm("Are you sure you want to delete this coupon?")) return false;
                
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function() {
                        alert('Coupon deleted successfully!');
                        location.reload();
                    },
                    error: function() { alert('Something went wrong!'); }
                });
            });
        });
    </script>
@endsection
