<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoryController extends Controller
{
    public function index(){

        $categories = Category::where('parent_id',null)->paginate(PAGINATION_COUNT);
        return \view('admin.category.index',\compact('categories'));
    }

    public function create(){

        
        return view('admin.category.create');
    }

    public function store(categoryRequest $request){

        if(!$request->has('active')){
            $request->request->add(['active'=>0]);
        }else{
            $request->request->add(['active'=>1]);
        }
        $slugArray = \explode(' ' ,$request->name);
        $slugArray = implode('-' , $slugArray);
        
        $request->request->add(['slug'=> $slugArray]);
        $category= Category::create($request->except('_token'));
        $category -> name = $request->name ;
        $category->save();
        return redirect()->route('category.index')->with(['success' => 'تم ألتحديث بنجاح']);

        
    }

    public function edit( $id){

        $category = Category::find($id);
        return \view('admin.category.edit',\compact('category'));
    }

    public function update(categoryRequest $request , $id){


        try{
          $category = Category::find($id);


        if (!$category)
            return redirect()->back()->with(['error' => 'هذا القسم غير موجود']);

        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);
            DB::beginTransaction();
        
        $category->update($request->all());
        
        
        //save translations
        DB::table('category_translations')
            ->where("category_id",  $id)
            ->limit(1)
            ->update(['name'=> $request->name ]);
        
        DB::commit();


        return redirect()->route('category.index')->with(['success' => 'تم ألتحديث بنجاح']);
    }catch (Exception $ex) {
        DB::rollback();
        return $ex ;
        return redirect()->route('category.edit')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }

    }

    public function delete($id){
        Category::find($id)->delete();
        return redirect()->route('category.index')->with(['success' => 'تم ألتحديث بنجاح']);

    }
}
