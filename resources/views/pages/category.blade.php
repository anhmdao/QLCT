@extends('welcome')
@section('category')
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
            <button type="button" class="btn btn-rounded btn-info" data-toggle="modal" data-target="#addCategoryModal"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
            </span>Thêm Danh Mục</button>
        </div>
    </div>
    <!-- row -->

    <div class="row">
      
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thông Tin Danh Mục</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Tên Danh Mục</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Màu sắc</th>
                                    <th scope="col">Phân loại</th>
                                    <th scope="col">Sửa/Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td><div style="width: 20px; height: 20px; background-color: {{ $category->color }};"></div></td>
                                        <td>
                                            @php
                                                echo $category->status == 0 ? 'Thu' : 'Chi';
                                            @endphp
                                        </td>
                                        <td>
                                            <span>
                                                <!-- Edit link -->
                                                <a href="{{ route('category.edit', ['category_id' => $category->id]) }}" class="edit-item mr-4" data-toggle="tooltip" data-placement="top" title="Sửa">
                                                    <i class="fa fa-pencil color-muted"></i>
                                                </a>

                                                <!-- Delete form -->
                                                <form action="{{ route('category.destroy', ['category_id' => $category->id]) }}" method="POST" style="display: inline;" id="deleteForm">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-item mr-4" data-toggle="tooltip" data-placement="top" title="Xóa" onclick="confirmDelete()">
                                                        <i class="fa fa-close color-danger"></i>
                                                    </button>
                                                </form>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                                
                            </tbody>
                        </table>
                      
                        {{ $categories->links('pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Thêm Danh Mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-category-form" action="{{ route('category.add') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="category-name">Tên:</label>
                        <input type="text" class="form-control" id="category-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="category-description">Mô tả:</label>
                        <textarea class="form-control" id="category-description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category-type">Phân loại:</label>
                        <select class="form-control" id="category-type" name="status" required>
                            <option value="0">Nguồn thu</option>
                            <option value="1">Nguồn chi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category-color">Màu sắc:</label>
                        <input type="color" class="form-control" id="category-color" name="color" >
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="save-category-button">Thêm Mới</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
               
            </div>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Chỉnh Sửa Danh Mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-category-form">
                    @csrf
                    <div class="form-group">
                        <label for="category-name">Tên:</label>
                        <input type="text" class="form-control" id="category-name" name="edit_category_name">
                    </div>
                    <div class="form-group">
                        <label for="category-description">Mô tả:</label>
                        <textarea class="form-control" id="category-description" name="edit_category_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category-type">Phân loại:</label>
                        <select class="form-control" id="category-type" name="edit_category_type">
                            <option value="income">Nguồn thu</option>
                            <option value="spending">Nguồn chi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category-color">Màu sắc:</label>
                        <input type="color" class="form-control" id="category-color" name="edit_category_color">
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="save-category-button">Save Category</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div> --}}

<script>
   



</script>
@endsection