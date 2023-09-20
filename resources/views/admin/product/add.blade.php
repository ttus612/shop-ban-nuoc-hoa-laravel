@extends('admin.main')
@section('head')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <style>
        #container {
            width: 1000px;
            margin: 20px auto;
        }
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }
        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
@endsection
@section('content')
    <form action="" method="POST">
        @csrf
        <div class="card-body row">

            <div class="form-group col-6">
                <label for="menu">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Nhập tên danh mục">

            </div>

            <div class="form-group col-6">
                <label>Danh mục </label>
                <select class="form-control" name="menu_id">
                    @foreach($menus as $menu)
                        <option value="{{$menu->id}}">{{$menu->name}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group col-6">
                <label for="menu">Giá gốc:</label>
                <input type="text" name="price"  value="{{old('price')}}" class="form-control" placeholder="Nhập giá gốc">
            </div>

            <div class="form-group col-6">
                <label for="menu">Giá giảm:</label>
                <input type="text" name="price_sale" value="{{old('price_sale')}}" class="form-control" placeholder="Nhập giá giảm">
            </div>


            <div class="form-group col-12">
                <label>Mô tả</label>
                <textarea name="description" class="form-control">{{old('description')}}</textarea>
            </div>

            <div class="form-group col-12">
                <label>Mô tả chi tiết:</label>
                <textarea name="content" id="content" class="form-control">{{old('content')}}</textarea>
            </div>

            <div class="form-group col-12">
                <label for="menu">Ảnh sản phẩm</label>
                <input type="file" class="form-group" id="upload">
                <div id="image_show">

                </div>
                <input type="hidden" name="thumb" id="thumb">
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
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </div>
    </form>
@endsection

@section('footer')
    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection
