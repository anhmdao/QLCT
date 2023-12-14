@extends('welcome')
@section('edit_transaction')
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addTransactionModalLabel">Chỉnh Sửa Giao Dịch</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-header">
            <span>Lưu ý: Chỉ có thể chỉnh sửa mô tả và ngày giao dịch!</span>
        </div>
        <div class="modal-body">
            <form id="add-transaction-form" action="{{ route('transaction.update', ['transaction_id' => $transaction->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="transaction-category">Danh Mục:</label>
                    <input class="form-control" id="transaction-category" name="transaction-category" value="{{ $transaction->category->name }}" readonly>
                
                </div>
                <div class="form-group">
                    <label for="transaction-wallet">Nguồn Ví:</label>
                    <input class="form-control" id="transaction-category" name="transaction-wallet" readonly value="{{ $transaction->wallet->name }}">
                      
                   
                </div>
                <div class="form-group">
                    <label for="transaction-name">Mô tả:</label>
                    <input type="text" class="form-control" id="transaction-name" name="transaction-name">
                </div>
                <div class="form-group">
                    <label for="transaction-amount">Số tiền:</label>
                    <input type="text" class="form-control" id="transaction-amount" name="transaction-amount" value="{{ $transaction->total }}" readonly>
                </div>
                <div class="form-group">
                    <label for="transaction-time">Thời gian giao dịch:</label>
                    <input type="date" class="form-control" id="transaction-time" name="transaction-time" value="{{ $transaction->time }}">
                </div>
                <div class="form-group">
                    <a href="{{ route('transaction') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                    <button type="submit" class="btn btn-primary" id="save-transaction-button">Thêm Giao Dịch</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            
        </div>
    </div>
</div>
@endsection