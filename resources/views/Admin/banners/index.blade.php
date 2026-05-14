@extends('Admin.layouts.master')
@section('title', 'Banners')

@section('content')

    <div class="page-header">
        <div>
            <h1>Banners</h1>
            <p>Manage promotional banners for your homepage sliders.</p>
        </div>
    </div>

    <div class="grid" style="grid-template-columns:1fr 380px;gap:20px;">

        <!-- Banner List -->
        <div class="card">
            <div class="card-header">
                <span class="card-title">All Banners ({{ $banners->count() }})</span>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                            <tr>
                                <td>
                                    @if($banner->image)
                                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner" style="width:100px;height:40px;object-fit:cover;border-radius:6px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td style="font-weight:600;">{{ $banner->title }}</td>
                                <td><span style="font-size:12px;color:var(--muted);font-family:monospace;">{{ $banner->position }}</span></td>
                                <td><span
                                        class="badge {{ $banner->status ? 'badge-green' : 'badge-gray' }}">{{ $banner->status ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <button type="button" class="btn btn-outline btn-sm edit-banner-btn" data-bs-toggle="modal"
                                            data-bs-target="#editBannerModal"
                                            data-id="{{ $banner->id }}"
                                            data-update-url="{{ route('admin.banners.update', $banner->id) }}"
                                            data-title="{{ $banner->title }}"
                                            data-position="{{ $banner->position }}"
                                            data-link="{{ $banner->link }}"
                                            data-status="{{ $banner->status ? 1 : 0 }}"
                                            data-image-url="{{ $banner->image ? asset('storage/' . $banner->image) : '' }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>

                                        <form action="{{ route('admin.banners.delete', $banner->id) }}" method="POST"
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

        <!-- Add Banner Form -->
        <div class="card" style="align-self:start;">
            <div class="card-header"><span class="card-title">Add New Banner</span></div>

            <form enctype="multipart/form-data" id="banner-form">
                @csrf

                <div class="form-group">
                    <label class="form-label">Banner Title *</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Summer Sale 2026">
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Link (Optional)</label>
                    <input type="text" name="link" class="form-control" placeholder="e.g. /offers/summer">
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Position</label>
                    <input type="text" name="position" class="form-control" value="main_slider">
                    <span class="text-danger">{{ $errors->first('position') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Banner Image</label>

                    <label
                        style="border:2px dashed var(--border);border-radius:8px;padding:24px;text-align:center;cursor:pointer;display:block;">
                        <div style="font-size:24px;margin-bottom:6px;">📷</div>
                        <div style="font-size:13px;color:var(--muted);">Click or drag to upload</div>
                        <input type="file" name="image" id="image" style="display:none;">
                    </label>

                    <img id="preview" src="" width="100%" style="margin-top:10px;display:none;border-radius:6px;">
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">
                    Create Banner
                </button>
            </form>
        </div>

        <!-- Edit Banner Modal -->
        <div class="modal fade" id="editBannerModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background: var(--surface); border: 1px solid var(--border);">

                    <div class="modal-header" style="border-bottom: 1px solid rgba(48, 54, 61, .5);">
                        <h5 class="modal-title" style="font-family: 'Syne', sans-serif; font-size: 16px; font-weight: 700;">Edit Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form id="edit-banner-form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body" style="padding: 20px;">
                            <input type="hidden" name="id" id="edit_id">

                            <div class="row">
                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Banner Title *</label>
                                    <input type="text" name="title" id="edit_title" class="form-control">
                                </div>

                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Link</label>
                                    <input type="text" name="link" id="edit_link" class="form-control">
                                </div>

                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Position</label>
                                    <input type="text" name="position" id="edit_position" class="form-control">
                                </div>

                                <div class="col-sm-6 form-group mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" id="edit_status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="col-sm-12 form-group mb-0">
                                    <label class="form-label">Banner Image (optional)</label>
                                    <input type="file" name="image" id="edit_image" class="form-control" style="font-size: 12px; padding: 6px 10px;">
                                    <img id="edit_preview" src="" width="100%" style="margin-top:10px; display:none; border-radius:6px; border:1px solid var(--border);">
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
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() }
            });

            // Add Preview
            $('#image').change(function(e) {
                if(!this.files || !this.files[0]) return;
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(this.files[0]);
            });

            // Edit Preview
            $('#edit_image').change(function(e) {
                if(!this.files || !this.files[0]) return;
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#edit_preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(this.files[0]);
            });

            // Submit Add Form
            $('#banner-form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.banners.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function() {
                        alert('Banner created successfully!');
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
            $(document).on('click', '.edit-banner-btn', function() {
                let button = $(this);
                $('#edit-banner-form').attr('action', button.attr('data-update-url'));
                $('#edit_id').val(button.attr('data-id'));
                $('#edit_title').val(button.attr('data-title'));
                $('#edit_link').val(button.attr('data-link'));
                $('#edit_position').val(button.attr('data-position'));
                $('#edit_status').val(button.attr('data-status'));
                $('#edit_image').val('');

                let imgUrl = button.attr('data-image-url');
                if(imgUrl) {
                    $('#edit_preview').attr('src', imgUrl).show();
                } else {
                    $('#edit_preview').hide();
                }
            });

            // Submit Edit Form
            $('#edit-banner-form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                formData.append('_method', 'PUT');
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function() {
                        alert('Banner updated successfully!');
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
                if (!confirm("Are you sure you want to delete this banner?")) return false;
                
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function() {
                        alert('Banner deleted successfully!');
                        location.reload();
                    },
                    error: function() { alert('Something went wrong!'); }
                });
            });
        });
    </script>
@endsection
