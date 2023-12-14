@extends('welcome')
@section('edit_category')
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Chỉnh Sửa Danh Mục</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="add-category-form" action="{{ route('category.update', ['category_id' => $category->id]) }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="category-name">Tên:</label>
                <input type="text" class="form-control" id="category-name" name="name" value="{{ $category->name }}" required>
            </div>
            <div class="form-group">
                <label for="category-description">Mô tả:</label>
                <textarea class="form-control" id="category-description" name="description" >{{ $category->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="category-type">Phân loại:</label>
                <input type="number" class="form-control" id="status" name="status" value="{{ $category->status }}" required>
            </div>
            <div class="form-group">
                <label for="category-color">Màu sắc:</label>
                <input type="text" class="form-control" id="category-color" name="color"  value="{{ $category->color }}" >
            </div>
            <div>
                <a href="{{ route('category') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</a>
                <button type="submit" class="btn btn-primary" id="save-category-button">Thêm Mới</button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
       
    </div>
</div>
@endsection