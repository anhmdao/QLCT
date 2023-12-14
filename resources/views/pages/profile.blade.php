@extends('welcome')
@section('profile')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <h2>Thông Tin Tài Khoản</h2>
            <form id="profile-form" action="{{ route('profile.update') }}" method="POST">
                @csrf
               
                <div class="form-group">
                    <label for="email">Email:</label>
                    @if(session()->has('email'))
                    <input type="email" class="form-control" id="email" name="email" value="{{ session('email') }}" readonly>
                    @endif
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    @if(session()->has('username'))
                    <input type="text" class="form-control" id="username" name="username" value="{{ session('username') }}" readonly>
                    @endif
                </div>
                <div class="form-group">
                    <label for="address">Số điện thoại:</label>
                   
                    <input type="number" class="form-control" id="address" name="phone"  value="{{ session('phone') }}" readonly>
                  
                </div>
                
                <button type="button" class="btn btn-primary" id="edit-button">Chỉnh Sửa Thông Tin Cá Nhân</button>
                <button type="submit" class="btn btn-success" id="save-button" style="display: none;">Lưu Thông Tin</button>
            </form>
        </div>
    </div>
</div>
<script>
   
</script>
@endsection