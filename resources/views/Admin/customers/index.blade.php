@extends('Admin.layouts.master')
@section('title', 'Customers')

@section('content')

    <div class="page-header">
        <div>
            <h1>Customers</h1>
            <p>Manage your registered customers and their profiles.</p>
        </div>
    </div>

    <div class="grid" style="grid-template-columns:1fr 380px;gap:20px;">

        <!-- Customer List -->
        <div class="card">
            <div class="card-header">
                <span class="card-title">All Customers ({{ $customers->count() }})</span>
                <input type="text" class="form-control" style="width:200px;" placeholder="Search…">
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Contact Info</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>
                                    @if($customer->avatar)
                                        <img src="{{ asset('storage/' . $customer->avatar) }}" alt="Avatar" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                                    @else
                                        <div style="width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,var(--accent),#1a7a2e);display:flex;align-items:center;justify-content:center;color:#000;font-weight:bold;">
                                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td style="font-weight:600;">{{ $customer->name }}</td>
                                <td>
                                    <div style="font-size:12px;color:var(--text);">{{ $customer->email }}</div>
                                    <div style="font-size:11px;color:var(--muted);">{{ $customer->phone ?? 'No phone' }}</div>
                                </td>
                                <td><span
                                        class="badge {{ $customer->status ? 'badge-green' : 'badge-gray' }}">{{ $customer->status ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <button type="button" class="btn btn-outline btn-sm edit-customer-btn" data-bs-toggle="modal"
                                            data-bs-target="#editCustomerModal"
                                            data-id="{{ $customer->id }}"
                                            data-update-url="{{ route('admin.customers.update', $customer->id) }}"
                                            data-name="{{ $customer->name }}"
                                            data-email="{{ $customer->email }}"
                                            data-phone="{{ $customer->phone }}"
                                            data-address="{{ $customer->address }}"
                                            data-status="{{ $customer->status ? 1 : 0 }}"
                                            data-image-url="{{ $customer->avatar ? asset('storage/' . $customer->avatar) : '' }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>

                                        <form action="{{ route('admin.customers.delete', $customer->id) }}" method="POST"
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

        <!-- Add Customer Form -->
        <div class="card" style="align-self:start;">
            <div class="card-header"><span class="card-title">Add New Customer</span></div>

            <form enctype="multipart/form-data" id="customer-form">
                @csrf

                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. John Doe">
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-control" placeholder="john@example.com">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control" placeholder="+1 234 567 890">
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Avatar Image</label>

                    <label
                        style="border:2px dashed var(--border);border-radius:8px;padding:24px;text-align:center;cursor:pointer;display:block;">
                        <div style="font-size:24px;margin-bottom:6px;">📷</div>
                        <div style="font-size:13px;color:var(--muted);">Click or drag to upload</div>

                        <input type="file" name="avatar" id="avatar" style="display:none;">
                    </label>

                    <img id="preview" src="" width="100" style="margin-top:10px;display:none;border-radius:50%;">
                    <span class="text-danger">{{ $errors->first('avatar') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Shipping Address</label>
                    <textarea name="address" class="form-control" rows="2" placeholder="Full address"></textarea>
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">
                    Create Customer
                </button>
            </form>
        </div>


        <!-- Edit Customer Form Modal -->

        <div class="modal fade" id="editCustomerModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background: var(--surface); border: 1px solid var(--border);">

                    <div class="modal-header" style="border-bottom: 1px solid rgba(48, 54, 61, .5);">
                        <h5 class="modal-title" style="font-family: 'Syne', sans-serif; font-size: 16px; font-weight: 700;">Edit Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form id="edit-customer-form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body" style="padding: 20px;">

                            <input type="hidden" name="id" id="edit_id">

                            <div class="row">
                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" name="name" id="edit_name" class="form-control">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>

                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Email Address *</label>
                                    <input type="email" name="email" id="edit_email" class="form-control">
                                </div>

                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone" id="edit_phone" class="form-control">
                                </div>

                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" id="edit_status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="col-sm-12 form-group mb-3">
                                    <label class="form-label">Shipping Address</label>
                                    <textarea name="address" id="edit_address" class="form-control" rows="2" style="min-height: 60px;"></textarea>
                                </div>

                                <div class="col-sm-12 form-group mb-0">
                                    <label class="form-label">Avatar Image (optional)</label>
                                    <input type="file" name="avatar" id="edit_avatar" class="form-control" style="font-size: 12px; padding: 6px 10px;">
                                    <img id="edit_preview" src="" width="60" style="margin-top:10px; display:none; border-radius:50%; border:1px solid var(--border);">
                                </div>
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

            // CSRF setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });

            // Image preview
            $('#avatar').change(function(e) {
                if (!this.files || !this.files[0]) {
                    return;
                }
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview')
                        .attr('src', e.target.result)
                        .show();
                };

                reader.readAsDataURL(this.files[0]);
            });

            // Form submit
            $('#customer-form').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.customers.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        alert('Customer created successfully!');
                        location.reload();
                    },

                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let msg = '';

                            for (let field in errors) {
                                msg += errors[field][0] + "\n";
                            }

                            alert(msg);
                        } else {
                            alert('Something went wrong!');
                        }
                    }
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            // CSRF setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });

            $(document).on('click', '.edit-customer-btn', function() {
                let button = $(this);
                let imageUrl = button.attr('data-image-url');

                $('#edit-customer-form').attr('action', button.attr('data-update-url'));
                $('#edit_id').val(button.attr('data-id'));
                $('#edit_name').val(button.attr('data-name'));
                $('#edit_email').val(button.attr('data-email'));
                $('#edit_phone').val(button.attr('data-phone'));
                $('#edit_address').val(button.attr('data-address'));
                $('#edit_status').val(button.attr('data-status'));
                $('#edit_avatar').val('');

                if (imageUrl) {
                    $('#edit_preview').attr('src', imageUrl).show();
                } else {
                    $('#edit_preview').attr('src', '').hide();
                }
            });

            $('#edit_avatar').change(function(e) {
                if (!this.files || !this.files[0]) {
                    return;
                }

                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#edit_preview')
                        .attr('src', e.target.result)
                        .show();
                };

                reader.readAsDataURL(this.files[0]);
            });

            $('#edit-customer-form').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                // Laravel expects PUT method via _method
                formData.append('_method', 'PUT');
                let actionUrl = $(this).attr('action');

                $.ajax({
                    url: actionUrl,
                    type: "POST", // Needs to be POST when sending files, we appended _method='PUT'
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        alert('Customer updated successfully!');
                        location.reload();
                    },

                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let msg = '';

                            for (let field in errors) {
                                msg += errors[field][0] + "\n";
                            }

                            alert(msg);
                        } else {
                            alert('Something went wrong!');
                        }
                    }
                });
            });

            $(document).on('submit', '.delete-form', function(e) {
                e.preventDefault();

                let form = this;
                let formData = new FormData(form);
                let actionUrl = $(form).attr('action');

                if (!confirm("Are you sure you want to delete this customer?")) {
                    return false;
                }

                $.ajax({
                    url: actionUrl,
                    type: "POST", // Uses POST but formData has _method=DELETE
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        alert('Customer Deleted successfully!');
                        location.reload();
                    },

                    error: function(xhr) {
                        alert('Something went wrong!');
                    }
                });
            });

        });
    </script>

@endsection
