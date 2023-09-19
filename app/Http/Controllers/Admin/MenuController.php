<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Requests\Menu\UpdateFormRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
class MenuController extends Controller
{
    protected $menuService;

    /**
     * @param $menuService
     */
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }


    public function create(){
        return view('admin.menu.add',[
            'title' => 'Thêm danh mục mới',
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request){
        $result = $this->menuService->create($request);
        return redirect()->back();
    }

    public function index(){
        return view('admin.menu.list',[
            'title'=>'Danh sách danh mục mới nhất',
            'menus' => $this->menuService->getAll()
        ]);
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->menuService->destroy($request);
        if ($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xóa thành công danh mục'
            ]);
        }
        return response()->json([
            'error'=>true
        ]);
    }

    //KIỂM TRA TRONG DATA BIẾN ID CÓ TỒN TẠI HAY KHÔNG
    public function show(Menu $menu){
        return view('admin.menu.edit', [
            'title' => 'Chỉnh sửa danh mục:'. $menu->name,
            'menu' =>$menu,
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function update(Menu $menu, UpdateFormRequest $request){
        $this->menuService->update($menu, $request);
        return redirect('admin/menus/list');
    }
}
