@extends('admin.main')
@section('content')
    <form action="" method="POST">
        @csrf
        <div class="card-body row">

            <div class="form-group col-6">
                <label for="menu">Tiêu đề</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}">
            </div>

            <div class="form-group col-6">
                <label for="menu">Đường dẫn</label>
                <input type="text" name="url" class="form-control" value="{{old('url')}}">
            </div>

            <div class="form-group col-12">
                <label for="menu">Ảnh sản phẩm</label>
                <input type="file" class="form-group" id="upload">
                <div id="image_show">
                </div>
                <input type="hidden" name="thumb" id="thumb">
            </div>


            <div class="form-group col-12">
                <label for="menu">Sắp xếp:</label>
                <input type="number" name="sort_by"  value="{{old('sort_by')}}" class="form-control">
            </div>


            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="1" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="0" id="no_active" name="active" >
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm slider</button>
        </div>
    </form>
@endsection
