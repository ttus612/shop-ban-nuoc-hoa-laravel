<?php

namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    public function getMenu(){
        return Menu::where('active', 1)->get();
    }

    protected function isValidPrice($request){
        if ($request->input('price') != 0
            && $request->input('price_sale') != 0
            && $request->input('price_sale') >= $request->input('price'))
        {
            Session::flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }
        if ($request->input('price_sale') != 0 && $request->input('price') == 0){
            Session::flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }
        return true;
    }
    public function insert($request){
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice == false){
            return false;
        }
        try {
            $request -> except(['_token']);
            $request->merge(['slug' => Str::slug($request->input('name'), '-')]);
            Product::create($request->all());
            Session::flash('success', 'Thêm sản phẩm thành công');
        }catch (\Exception $error){
            Session::flash('error', 'Thêm sản phẩm lỗi');
            \Log::info($error->getMessage());
            return false;
        }
        return true;
    }

    public function get(){
        return Product::
            with('menu')
            ->orderByDesc('id')->paginate(15);
    }

    public function update($request, $product){
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice == false){
            return false;
        }
        try {
            $request->except(['_token']);
            $request->merge(['slug' => Str::slug($request->input('name'), '-')]);
            $product->fill($request->input());

            $product->save();
            Session::flash('success', 'Cập nhật thành công');
        }catch (\Exception $error){
            Session::flash('error', 'Có lỗi vui lòng nhập lại');
            \Log::info($error->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request){
        $product = Product::where('id', $request->input('id'))->first();
        if ($product){
            $path = str_replace('storage', 'public', $product->thumb);
            Storage::delete($path);
            $product->delete();
            return true;
        }
        return false;
    }
}
