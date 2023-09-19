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

    public function getAll()
    {
        return Menu::orderbyDesc('id')->paginate(20);
    }



    public function destroy($request){
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu){
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

//    Menu nhiều cấp hơn
//    public function Remove(int $idMenu)
//    {
//        try {
//            //Xoá Root
//            Menu::where('id', $idMenu)->delete();
//            //Lấy danh sách con của Root
//            $listMenu = Menu::where('parent_id', $idMenu)->get();
//            //Duyệt danh sách con
//            foreach ($listMenu as $menu) {
//                //Gọi đệ quy
//                $this->Remove($menu->id);
//                //Xoá danh sách con
//                Menu::destroy($menu);
//            }
//            return true;
//        } catch (Exception $e) {
//            return false;
//        }
//    }
    public function update($menu,$request): bool
    {
        $menu->name = (string)$request->input('name');
        if ($request->input('parent_id') != $menu->id) {
            $menu->parent_id =(string) $request->input('parent_id');
        }
        $menu->description =(string) $request->input('description');
        $menu->content =(string) $request->input('content');
        $menu->slug = Str::slug($request->input('name'), '-');
        $menu->active =(string) $request->input('active');
        $menu->save();
        Session::flash('success', 'Sửa thành công danh mục');
        return true;
    }
}
