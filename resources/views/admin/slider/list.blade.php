@extends('admin.main')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px;">ID</th>
            <th>Tiêu đề</th>
            <th>Link</th>
            <th>Ảnh</th>
            <th>Trạng thái</th>
            <th>Cập nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sliders as $key => $slider)
            <tr>
                <th>{{$slider->id}}</th>
                <th>{{$slider->name}}</th>
                <th>{{$slider->url}}</th>
                <th><a href="{{$slider->thumb}}" target="_blank"><img src="{{$slider->thumb}}" height="40px"></a> </th>
                <th>{!! \App\Helpers\Helper::active($slider->active) !!}</th>
                <th>{{$slider->updated_at}}</th>
                <th>
                    <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{$slider->id}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#" onclick="removeRow(' {{$slider->id}}', '/admin/sliders/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </th>
            </tr>

        @endforeach
        </tbody>
    </table>
    {!! $sliders->links() !!}
@endsection
