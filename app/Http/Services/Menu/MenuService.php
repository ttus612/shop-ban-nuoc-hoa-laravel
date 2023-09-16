<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuService
{
    public function create($request){
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
                'slug' => Str::slug($request->input('name'), '-')

            ]);

            Session::flash('success', 'Tạo Danh Mục thành công');
        }catch (\Exception $err){
            Session::flash('error', $err->getMessage());
        }
        return true;
    }

    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }
}
