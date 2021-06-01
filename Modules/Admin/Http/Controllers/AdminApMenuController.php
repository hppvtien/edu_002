<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Grmenu;
use App\Models\Imenu;
use App\Models\Education\SeoEdutcation;
use App\Service\Seo\RenderUrlSeoCourseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\AdminCategoryRequest;

class AdminApMenuController extends AdminController
{
    public function index()
    {
        $ap_menu = Grmenu::orderByDesc('id')
            ->paginate(20);

        // $viewData = [
        //     'categories' => $categories
        // ];
        return view('admin::pages.apmenu.index', compact('ap_menu'));
    }

    public function create()
    {
        $data = Grmenu::orderByDesc('id')->get();

        return view('admin::pages.apmenu.create', compact('data'));
    }

    // public function store(AdminCategoryRequest  $request)
    // {
    //     $data = $request->except(['avatar','save','_token']);
    //     $data['created_at'] = Carbon::now();
    //     $data['c_position_1'] = 0;

    //     if(!$request->c_title_seo)             $data['c_title_seo'] = $request->c_name;
    //     if(!$request->c_description_seo) $data['c_description_seo'] = $request->c_name;
    //     if($request->c_position_1) $data['c_position_1'] = 1;

    //     $categoryID = Category::insertGetId($data);
    //     if($categoryID)
    //     {
    //         $this->showMessagesSuccess();
    //         RenderUrlSeoCourseService::init($request->c_slug,SeoEdutcation::TYPE_CATEGORY, $categoryID);
    //         return redirect()->route('get_admin.category.index');
    //     }
    //     $this->showMessagesError();
    //     return  redirect()->back();
    // }

    // public function edit($id)
    // {
    //     $category = Category::findOrFail($id);
    //     $categories = Category::orderByDesc('c_sort')->get();
    //     return view('admin::pages.category.update',compact('category','categories'));
    // }

    // public function update(AdminCategoryRequest $request, $id)
    // {
    //     $category = Category::findOrFail($id);
    //     $data = $request->except(['avatar','save','_token','c_position_1']);
    //     $data['updated_at'] = Carbon::now();

    //     if(!$request->c_title_seo)             $data['c_title_seo'] = $request->c_name;
    //     if(!$request->c_description_seo) $data['c_description_seo'] = $request->c_name;
    //     if($request->c_position_1) $data['c_position_1'] = 1;

    //     $category->fill($data)->save();
    //     RenderUrlSeoCourseService::update($request->c_slug,SeoEdutcation::TYPE_CATEGORY, $id);
    //     $this->showMessagesSuccess();
    //     return redirect()->route('get_admin.category.index');
    // }


    // public function delete(Request $request, $id)
    // {
    //     if($request->ajax())
    //     {
    //         $category = Category::find($id);
    //         if ($category)
    //         {
    //             $category->delete();
    //             RenderUrlSeoCourseService::deleteUrlSeo(SeoEdutcation::TYPE_CATEGORY, $id);
    //         }
    //         return response()->json([
    //             'status' => 200,
    //             'message' => 'Xoá dữ liệu thành công'
    //         ]);
    //     }

    //     return redirect()->to('/');
    // }
    public function menuChildren($data, $id, $item)
    {
        if (count($item->get_child_cate()) > 0) {
            echo '<ol class="dd-list">';
            foreach ($item->get_child_cate() as $item) {
                if ($item->parent_id == $id) {
                    echo '<li class="dd-item" data-id="' . $item->id . '">';
                    echo '  <div class="dd-handle">' . $item->title . '(<i>' . $item->url . '</i>)</div>
                                        <div class="button-group">
                                            <a href="javascript:;" class="modalEditMenu" data-id="' . $item->id . '">
                                                <i class="fa fa-pencil fa-fw"></i> Sửa
                                            </a> &nbsp; &nbsp; &nbsp;
                                            <a class="text-danger" href="' . route('setting.menu.delete', $item['id']) . '" onclick="return confirm(\'Bạn có chắc chắn xóa không ?\')" title="Xóa"> <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                                        </div>';
                    menuChildren($data, $item->id, $item);
                    echo '</li>';
                }
            }
            echo '</ol>';
        }
        return view('admin::pages.apmenu.create');
    }
}
