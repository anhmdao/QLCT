@extends('welcome')
@section('transaction')
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
            <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#addTransactionModal"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
            </span>Thêm Giao Dịch</button>
            <button type="button" class="btn btn-rounded btn-info" id="add-button" data-toggle="modal" data-target="#searchTransactionModal">
               Tìm Kiếm
            </button>
        </div>
        
    </div>
    <!-- row -->
    
    <div class="row">
      
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Danh Sách Giao Dịch</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Số tiền giao dịch</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Sửa/Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->description }}</td>
                                    <td>
                                        {{ $transaction->time }}
                                    </td>
                                    <td>{{ $transaction->total }}</td>
                                    <td>
                                        @if($transaction->category)
                                            <div style="width: 20px; height: 20px; background-color: {{ $transaction->category->color }};"></div>
                                            <span>{{ $transaction->category->name }}</span> 
                                        @endif
                                    </td>
                                    <td>
                                        <span>
                                            <a href="{{ route('transaction.edit', ['transaction_id' => $transaction->id]) }}" class="edit-item mr-4" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-pencil color-muted"></i>
                                            </a>
                                            
                                            
                                                <button type="submit" class="delete-item mr-4" data-toggle="tooltip" data-placement="top" title="Xóa" onclick="confirmDeleteTransactions()">
                                                    <i class="fa fa-close color-danger"></i>
                                                </button>
                                            
                                                    
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $transactions->links('pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<div class="modal fade" id="addTransactionModal" tabindex="-1" role="dialog" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTransactionModalLabel">Thêm Giao Dịch Mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-transaction-form" action="{{ route('transaction.add') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="transaction-category">Danh Mục:</label>
                        <select class="form-control" id="transaction-category" name="transaction-category" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="transaction-wallet">Nguồn Ví:</label>
                        <select class="form-control" id="transaction-category" name="transaction-wallet" required>
                            @foreach ($wallets as $wallet)
                                <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="transaction-name">Mô tả:</label>
                        <input type="text" class="form-control" id="transaction-name" name="transaction-name">
                    </div>
                    <div class="form-group">
                        <label for="transaction-amount">Số tiền:</label>
                        <input type="text" class="form-control" id="transaction-amount" name="transaction-amount" required>
                    </div>
                    <div class="form-group">
                        <label for="transaction-time">Thời gian giao dịch:</label>
                        <input type="date" class="form-control" id="transaction-time" name="transaction-time" required>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="save-transaction-button">Thêm Giao Dịch</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="searchTransactionModal" tabindex="-1" role="dialog" aria-labelledby="editTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTransactionModalLabel">Edit Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="search-form" action="{{ route('transaction.search') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="start-time">Thời gian bắt đầu:</label>
                        <input type="date" class="form-control" id="start-time" name="start-time" required>
                    </div>
                    <div class="form-group">
                        <label for="end-time">Thời gian kết thúc:</label>
                        <input type="date" class="form-control" id="end-time" name="end-time" required>
                    </div>
                    {{-- <div class="form-group">
                        <label for="search-type">Loại giao dịch:</label>
                        <select class="form-control" id="search-type" name="search-type">
                            <option value="income">Nguồn Thu</option>
                            <option value="spending">Nguồn Chi</option>
                        </select>
                    </div> --}}
                    <button type="button" class="btn btn-secondary btn-sm" id="clear-button">Clear</button>
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection