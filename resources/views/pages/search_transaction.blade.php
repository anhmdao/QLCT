@extends('welcome')
@section('search')
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
                            @foreach($filteredTransactions as $transaction)
                            <tr>
                                <td>{{ $transaction->description }}</td>
                                <td>
                                    {{ $transaction->time }}
                                </td>
                                <td>{{ $transaction->total }}</td>
                                <td>
                                    @if($transaction->category)
                                        <div style="width: 20px; height: 20px; background-color: {{ $transaction->category->color }};"></div>
                                        {{ $transaction->category->name }}
                                    @endif
                                </td>
                                <td>
                                    <span>
                                        <a href="{{ route('transaction.edit', ['transaction_id' => $transaction->id]) }}" class="edit-item mr-4" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa fa-pencil color-muted"></i>
                                        </a>
                                        
                                        <form action="{{ route('transaction.delete', ['transaction_id' => $transaction->id]) }}" method="POST" style="display: inline;" id="deleteForm">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-item mr-4" data-toggle="tooltip" data-placement="top" title="Xóa" onclick="confirmDelete()">
                                                <i class="fa fa-close color-danger"></i>
                                            </button>
                                        </form>
                                                
                                    </span>
                                </td>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $transactions->links('pagination.default') }} --}}
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection