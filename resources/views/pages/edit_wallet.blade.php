@extends('welcome')
@section('edit_wallet')

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWalletModalLabel">Chỉnh Sửa Thông Tin Cho Ví</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-wallet-form" action="{{route('wallet.update', ['wallet_id' => $wallet->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="wallet-name">Tên ví:</label>
                        <input type="text" class="form-control" id="wallet-name" name="wallet-name" value="{{ $wallet->name }}">
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
                        <a href="{{ route('wallet') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                        <button type="submit" class="btn btn-primary" id="save-wallet-button">Lưu Thông Tin</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>

@endsection