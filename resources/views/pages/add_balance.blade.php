@extends('welcome')
@section('add_balance')
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWalletModalLabel">Thêm Số Dư</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <div class="modal-body" >
                <form id="add-wallet-form"  action="{{ route('wallet.add.balance', ['wallet_id' => $wallet->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="wallet-balance">Tên ví:</label>
                        <input type="text" class="form-control" id="wallet-balance" name="wallet-name" value="{{ $wallet->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="wallet-balance">Số tiền muốn thêm:</label>
                        <input type="number" class="form-control" id="wallet-balance" name="wallet-balance">
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
@endsection