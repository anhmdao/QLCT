@extends('welcome')
@section('wallet')
<div class="container-fluid">
    <div class="row page-titles mx-0" style="background-color: #473d59">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 style="color: white">Chào Mừng Quay Trở Lại!</h4>
                @if(session('success'))
                    <p class="alert alert-success">
                        {{ session('success') }}
                    </p>
                @endif
                @if(session('error'))
                    <p class="alert alert-error">
                        {{ session('error') }}
                    </p>
                @endif
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#addWalletModal"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
            </span>Thêm Ví</button>
    </div>
    <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
        @foreach($wallets as $wallet)
        <div class="card bg-light">
            <div class="card-header">
                <h5 class="card-title">Tên Ví: {{ $wallet->name }}</h5>
            </div>
            <div class="card-body mb-0">
                <p class="card-text">Số Dư: {{ $wallet->money}}
                    @php
                        echo $wallet->money_type_id == 1 ? 'VNĐ' : 'USD';
                    @endphp
                </p>
                <a href="{{ route('wallet.balance', ['wallet_id' => $wallet->id]) }}" type="button" class="btn btn-rounded btn-outline-success">Thêm Số Dư</a>

                <a href="{{ route('wallet.edit', ['wallet_id' => $wallet->id]) }}" type="button" class="btn btn-rounded btn-outline-info">Chỉnh Sửa</a>
                <form id="deleteForm" action="{{ route('wallet.delete', ['wallet_id' => $wallet->id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-rounded btn-outline-danger" onclick="confirmDelete()">Xóa</button>
                </form>
                
                
            </div>
            {{-- <div class="card-footer bg-transparent border-0">Ngày tạo: 
            </div> --}}
        </div>
        @endforeach
        {{ $wallets->links('pagination.default') }}
    </div>
   
</div>
<div class="modal fade" id="addWalletModal" tabindex="-1" role="dialog" aria-labelledby="addWalletModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWalletModalLabel">Thêm Ví Mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-wallet-form" action="{{ route('wallet.add') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="wallet-name">Tên ví:</label>
                        <input type="text" class="form-control" id="wallet-name" name="wallet-name">
                    </div>
                    <div class="form-group">
                        <label for="wallet-balance">Số dư:</label>
                        <input type="text" class="form-control" id="wallet-balance" name="wallet-balance">
                    </div>
                    <div class="form-group">
                        <label for="money-type">Loại tiền:</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="money-type-cash" name="money-type" value="VNĐ">
                            <label class="form-check-label" for="money-type-cash">VNĐ</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="money-type-card" name="money-type" value="USD">
                            <label class="form-check-label" for="money-type-card">USD</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="save-wallet-button">Thêm Mới</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>





@endsection