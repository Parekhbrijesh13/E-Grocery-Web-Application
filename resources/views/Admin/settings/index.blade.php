@extends('Admin.layouts.master')
@section('title', 'Settings')

@section('content')

    <div class="page-header">
        <div>
            <h1>Settings</h1>
            <p>Manage your global store configurations.</p>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-2" style="align-items: start;">
            
            <!-- General Info -->
            <div class="card">
                <div class="card-header"><span class="card-title">General Information</span></div>
                
                <div class="form-group">
                    <label class="form-label">Store Name *</label>
                    <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $setting->site_name) }}" required>
                    <span class="text-danger">{{ $errors->first('site_name') }}</span>
                </div>

                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label class="form-label">Store Logo</label>
                        @if($setting->site_logo)
                            <div style="margin-bottom:10px;">
                                <img src="{{ asset('storage/' . $setting->site_logo) }}" alt="Logo" style="max-height: 40px; background: #fff; padding: 5px; border-radius: 4px;">
                            </div>
                        @endif
                        <input type="file" name="site_logo" class="form-control" style="font-size:12px;padding:6px 10px;">
                        <span class="text-danger">{{ $errors->first('site_logo') }}</span>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label class="form-label">Favicon</label>
                        @if($setting->favicon)
                            <div style="margin-bottom:10px;">
                                <img src="{{ asset('storage/' . $setting->favicon) }}" alt="Favicon" style="max-height: 40px; background: #fff; padding: 5px; border-radius: 4px;">
                            </div>
                        @endif
                        <input type="file" name="favicon" class="form-control" style="font-size:12px;padding:6px 10px;">
                        <span class="text-danger">{{ $errors->first('favicon') }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label class="form-label">Currency Symbol</label>
                        <input type="text" name="currency_symbol" class="form-control" value="{{ old('currency_symbol', $setting->currency_symbol) }}">
                        <span class="text-danger">{{ $errors->first('currency_symbol') }}</span>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label class="form-label">Tax Rate (%)</label>
                        <input type="number" step="0.01" name="tax_rate" class="form-control" value="{{ old('tax_rate', $setting->tax_rate) }}">
                        <span class="text-danger">{{ $errors->first('tax_rate') }}</span>
                    </div>
                </div>
            </div>

            <!-- Contact & Social -->
            <div class="card">
                <div class="card-header"><span class="card-title">Contact & Social Links</span></div>
                
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label class="form-label">Support Email</label>
                        <input type="email" name="support_email" class="form-control" value="{{ old('support_email', $setting->support_email) }}">
                        <span class="text-danger">{{ $errors->first('support_email') }}</span>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label class="form-label">Support Phone</label>
                        <input type="text" name="support_phone" class="form-control" value="{{ old('support_phone', $setting->support_phone) }}">
                        <span class="text-danger">{{ $errors->first('support_phone') }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Store Address</label>
                    <textarea name="store_address" class="form-control" rows="2">{{ old('store_address', $setting->store_address) }}</textarea>
                    <span class="text-danger">{{ $errors->first('store_address') }}</span>
                </div>

                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label class="form-label">Facebook URL</label>
                        <input type="url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $setting->facebook_url) }}">
                        <span class="text-danger">{{ $errors->first('facebook_url') }}</span>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label class="form-label">Instagram URL</label>
                        <input type="url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $setting->instagram_url) }}">
                        <span class="text-danger">{{ $errors->first('instagram_url') }}</span>
                    </div>
                </div>

            </div>

        </div>

        <div style="margin-top: 24px; display: flex; justify-content: flex-end;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 24px;">
                <i class="fa-solid fa-save"></i> Save Settings
            </button>
        </div>

    </form>

@endsection
