@extends('Admin.layouts.master')
@section('title', 'My Profile')

@section('content')

    <div class="page-header">
        <div>
            <h1>My Profile</h1>
            <p>Update your personal information and security settings.</p>
        </div>
    </div>

    <div class="grid" style="grid-template-columns:1fr 1fr;gap:20px;align-items:start;">

        <!-- Profile Update -->
        <div class="card">
            <div class="card-header"><span class="card-title">Personal Information</span></div>

            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="text-align: center; margin-bottom: 20px;">
                    <div style="position: relative; display: inline-block;">
                        @if($user && $user->avatar)
                            <img id="avatar_preview" src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border: 2px solid var(--border);">
                        @else
                            <div id="avatar_preview_div" style="width:100px; height:100px; border-radius:50%; background: linear-gradient(135deg, var(--accent), #1a7a2e); display:flex; align-items:center; justify-content:center; font-size:36px; font-weight:bold; color:#0d1117;">
                                {{ $user ? strtoupper(substr($user->name, 0, 1)) : 'A' }}
                            </div>
                            <img id="avatar_preview" src="" alt="Avatar" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border: 2px solid var(--border); display:none;">
                        @endif
                        
                        <label for="avatar_input" style="position:absolute; bottom:0; right:0; background:var(--surface2); width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; border:1px solid var(--border); color:var(--text); transition:all 0.2s;">
                            <i class="fa-solid fa-camera" style="font-size:13px;"></i>
                        </label>
                        <input type="file" name="avatar" id="avatar_input" style="display:none;" accept="image/*">
                    </div>
                    <div style="font-size:12px; color:var(--danger); margin-top:8px;">{{ $errors->first('avatar') }}</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user ? $user->name : '') }}" required>
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user ? $user->email : '') }}" required>
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">Save Changes</button>
            </form>
        </div>

        <!-- Password Update -->
        <div class="card">
            <div class="card-header"><span class="card-title">Security & Password</span></div>

            <form action="{{ route('admin.profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password" class="form-control" required>
                    <span class="text-danger">{{ $errors->first('current_password') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control" required>
                    <span class="text-danger">{{ $errors->first('new_password') }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;"><i class="fa-solid fa-lock"></i> Update Password</button>
            </form>
        </div>

    </div>

    @push('scripts')
    <script>
        document.getElementById('avatar_input').addEventListener('change', function(e) {
            if(this.files && this.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let preview = document.getElementById('avatar_preview');
                    let previewDiv = document.getElementById('avatar_preview_div');
                    
                    if(previewDiv) previewDiv.style.display = 'none';
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
    @endpush

@endsection
