<?php

namespace App\Helpers;

class Helper
{
    public static function  menus($menus, $parent_id = 0, $char = ''){
        $html = '';
        foreach ($menus as $key => $menu){
            if ($menu->parent_id == $parent_id){
                $html .= '
                    <tr>
                        <th>' . $menu->id .'</th>
                        <th>' . $char . $menu->name .'</th>
                        <th>' . self::active($menu->active) .'</th>
                        <th>' . $menu->updated_at .'</th>
                        <th>
                            <a class="btn btn-primary btn-sm" href="/admin/menus/edit/'.$menu->id .'">
                               <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="removeRow(' . $menu->id . ', \'/admin/menus/destroy\')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </th>
                    </tr>
                ';
                //KHI CHẠY XONG DÒNG TRÊN SẼ DÙNG ĐỆ QUY GỌI LẠI VÀ XÓA NÓ
                //XÓA MENU CÓ KEY ĐÃ CHẠY
                unset($menus[$key]);

                // -TRUYỀN ZO $MENUS MỚI
                // -SAU KHI CHẠY HẾT $parent_id = 0 CỦA CHA, NÓ SẼ LẤY CÁI ID MỚI LÀ ID CỦA TG CHA TIẾP TỤC TÌM KIẾM CÁC
                // CON CÓ THUỘC VỀ ID CHA

                //VD:
                //A
                // --A1
                // --A2
                //B
                // --B1
                $html .= self::menus($menus,$menu->id, $char .'|---');
            }
        }
        return $html;
    }

    public static function active($active = 0){
        return $active == 0 ? '<span class="btn btn-danger btn-sm">No</span>':'<span class="btn btn-success btn-sm">Yes</span> ';
    }
}
