@extends('admin.main')
@section('content')
    <form action="" method="POST">
        @csrf

        <div class="card-body row">

            <div class="form-group col-6">
                <label for="menu">Tiêu đề</label>
                <input type="text" name="name" class="form-control" value="{{ $slider->name }}">
            </div>

            <div class="form-group col-6">
                <label for="menu">Đường dẫn</label>
                <input type="text" name="url" class="form-control" value="{{ $slider->url }}">
            </div>

            <div class="form-group col-12">
                <label for="menu">Ảnh sản phẩm</label>
                <input type="file" class="form-group" id="upload">
                <div id="image_show">
                    <a href="{{ $slider->thumb }}">
                        <img src="{{ $slider->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ $slider->thumb }}" id="thumb">
            </div>


            <div class="form-group col-12">
                <label for="menu">Sắp xếp:</label>
                <input type="number" name="sort_by"  value="{{ $slider->sort_by }}" class="form-control">
            </div>


            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="1" id="active" name="active"
                        {{$slider->active == 1 ? 'checked ="" ': ''}}
                    >

                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="0" id="no_active" name="active"
                        {{$slider->active == 0 ? 'checked ="" ' : ''}}
                    >

                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật slider</button>
        </div>
    </form>
@endsection
