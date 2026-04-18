@extends('Admin.layouts.master')
@section('title', 'Categories')

@section('content')

    <div class="page-header">
        <div>
            <h1>Categories</h1>
            <p>Organise products into categories for easy browsing.</p>
        </div>
    </div>

    <div class="grid" style="grid-template-columns:1fr 380px;gap:20px;">

        <!-- Category List -->
        <div class="card">
            <div class="card-header">
                <span class="card-title">All Categories ({{ $categories->count() }})</span>
                <input type="text" class="form-control" style="width:200px;" placeholder="Search…">
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Emoji</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $cat)
                            <tr>
                                <td style="font-size:22px;">{{ $cat->emoji }}</td>
                                <td style="font-weight:600;">{{ $cat->category_name }}</td>
                                <td style="font-size:12px;color:var(--muted);font-family:monospace;">{{ $cat->slug }}
                                </td>
                                <td>{{ $cat->description }}</td>
                                <td><span
                                        class="badge {{ $cat->status ? 'badge-green' : 'badge-gray' }}">{{ $cat->status ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <button class="btn btn-outline btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>

                                        <form action="{{ route('admin.categories.delete', $cat->id) }}" method="POST"
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

        <!-- Add Category Form -->
        <div class="card" style="align-self:start;">
            <div class="card-header"><span class="card-title">Add New Category</span></div>

            <form enctype="multipart/form-data" id="category-form">
                @csrf

                <div class="form-group">
                    <label class="form-label">Category Name *</label>
                    <input type="text" name="category_name" class="form-control" placeholder="e.g. Organic Foods">
                    <span class="text-danger">{{ $errors->first('category_name') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="auto-generated">
                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Icon / Emoji</label>
                    <input type="text" name="emoji" class="form-control" placeholder="🥦">
                    <span class="text-danger">{{ $errors->first('emoji') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Category Image</label>

                    <label
                        style="border:2px dashed var(--border);border-radius:8px;padding:24px;text-align:center;cursor:pointer;display:block;">
                        <div style="font-size:24px;margin-bottom:6px;">📷</div>
                        <div style="font-size:13px;color:var(--muted);">Click or drag to upload</div>

                        <input type="file" name="category_img" id="category_img" style="display:none;">
                    </label>

                    <img id="preview" src="" width="100" style="margin-top:10px;display:none;">
                    <span class="text-danger">{{ $errors->first('category_img') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                    <span class="text-danger">{{ $errors->first('description') }}</span>
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
                    Create Category
                </button>
            </form>
        </div>


        <!-- Add Category Form -->

        <div class="modal fade" id="editCategoryModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background: var(--surface); border: 1px solid var(--border);">

                    <div class="modal-header" style="border-bottom: 1px solid rgba(48, 54, 61, .5);">
                        <h5 class="modal-title" style="font-family: 'Syne', sans-serif; font-size: 16px; font-weight: 700;">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form id="edit-category-form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body" style="padding: 20px;">

                            <input type="hidden" name="id" id="edit_id">

                            <div class="row">
                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Category Name *</label>
                                    <input type="text" name="category_name" id="edit_category_name" class="form-control">
                                </div>

                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" name="slug" id="edit_slug" class="form-control">
                                </div>

                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Icon / Emoji</label>
                                    <input type="text" name="emoji" id="edit_emoji" class="form-control">
                                </div>

                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" id="edit_status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="col-sm-12 form-group mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="edit_description" class="form-control" rows="2" style="min-height: 60px;"></textarea>
                                </div>

                                <div class="col-sm-12 form-group mb-0">
                                    <label class="form-label">Header Image (optional)</label>
                                    <input type="file" name="category_img" id="edit_category_img" class="form-control" style="font-size: 12px; padding: 6px 10px;">
                                    <img id="edit_preview" src="" width="60" style="margin-top:10px; display:none; border-radius:6px; border:1px solid var(--border);">
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
            $('#category_img').change(function(e) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview')
                        .attr('src', e.target.result)
                        .show();
                };

                reader.readAsDataURL(this.files[0]);
            });

            // Form submit
            $('#category-form').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                console.log('Submitting form with data:', formData);
                $.ajax({
                    url: "{{ route('admin.categories.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        alert('Category created successfully!');
                        $('#category-form')[0].reset();
                        $('#preview').hide();
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



            $(document).on('submit', '.delete-form', function(e) {
                e.preventDefault();

                let form = this;
                let formData = new FormData(form);
                let actionUrl = $(form).attr('action');

                $.ajax({
                    url: actionUrl,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        alert('Category Deleted successfully!');
                        location.reload(); // optional
                    },

                    error: function(xhr) {
                        if (xhr.status === 422) {
                            alert('Sorry, you cannot delete this category');
                        } else {
                            alert('Something went wrong!');
                        }
                    }
                });
            });

        });
    </script>

@endsection
