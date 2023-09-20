@extends('admin.main')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px;">ID</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Giá gốc</th>
            <th>Giá giảm</th>
            <th>Ảnh</th>
            <th>Active</th>
            <th>Update</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            @foreach($products as $key => $product)
                <tr>
                    <th>{{$product->id}}</th>
                    <th>{{$product->name}}</th>
                    <th>{{$product->menu->name}}</th>
                    <th>{{$product->price}}</th>
                    <th>{{$product->price_sale}}</th>
                    <th><a href="{{$product->thumb}}"><img src="{{$product->thumb}}" width="70px"></a> </th>
                    <th>{!! \App\Helpers\Helper::active($product->active) !!}</th>
                    <th>{{$product->updated_at}}</th>
                    <th>
                        <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{$product->id}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#" onclick="removeRow(' {{$product->id}}', '/admin/products/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </th>
                </tr>

            @endforeach
        </tbody>
    </table>
    {!! $products->links() !!}
@endsection
