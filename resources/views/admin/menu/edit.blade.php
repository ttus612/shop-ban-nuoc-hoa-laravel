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
        <div class="card-body">

            <div class="form-group">
                <label for="menu">Tên danh mục</label>
                <input type="text" name="name" value="{{$menu->name}}"  class="form-control" placeholder="Nhập tên danh mục">
            </div>

            <div class="form-group">
                <label>Danh mục </label>
                <select class="form-control" name="parent_id">
                    <option value="0" {{ $menu->parent_id == 0 ? 'selected' : '' }}>Danh mục cha</option>
                    @foreach($menus as $menuParent)
                        <option value="{{ $menuParent->id }}"
                            {{ $menu->parent_id ==$menuParent->id ? 'selected' : '' }}>
                            {{ $menuParent->name}}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control">{{ $menu->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Chi tiết danh mục:</label>
                <textarea name="content" id="content" class="form-control">{{ $menu->content }}</textarea>
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="1" id="active" name="active" {{$menu->active == 1 ? ' checked="" ': ' ' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="0" id="no_active" name="active" {{$menu->active == 0 ? ' checked="" ': ' ' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
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
