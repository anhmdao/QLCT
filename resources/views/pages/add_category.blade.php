@extends('welcome')
@section('add_category')
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
                <input type="text" class="form-control" id="category-name" name="name" >
            </div>
            <div class="form-group">
                <label for="category-description">Mô tả:</label>
                <textarea class="form-control" id="category-description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="category-type">Phân loại:</label>
                <select class="form-control" id="category-type" name="status" >
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
@endsection