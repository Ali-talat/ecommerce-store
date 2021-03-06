<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\categoryRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return \view('admin.category.index',\compact('categories'));
    }

    public function create(){

        $categories = Category::select('id','parent_id')->get();

        return view('admin.category.create',\compact('categories'));
    }

    public function store(categoryRequest $request){

        if(!$request->has('active')){
            $request->request->add(['active'=>0]);
        }else{
            $request->request->add(['active'=>1]);
        }
        $slug = \explode(' ' ,$request->name);
        $slug = implode('-' , $slug);
        $request->request->add(['slug'=> $slug]);
        
        if($request->type == CategoryType::mainCat){
            $request->request->add(['parent_id'=> null]);

        }
        

        $category= Category::create($request->except('_token'));
        $category -> name = $request->name ;
        $category->save();
        return redirect()->route('category.index')->with(['success' => 'تم الحفظ بنجاح']);

        
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

        $category->name = $request->name ;
        $category->save();
        // DB::table('category_translations')
        //     ->where("category_id",  $id)
        //     ->limit(1)
        //     ->update(['name'=> $request->name ]);
        
        DB::commit();


        return redirect()->route('category.index')->with(['success' => 'تم ألتحديث بنجاح']);
    }catch (Exception $ex) {
        DB::rollback();
        return redirect()->route('category.edit')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }

    }



    public function delete($id){

        try{

            $category = Category::find($id);
    
            if (!$category)
                    return redirect()->route('category.index')->with(['error' => 'هذا القسم غير موجود ']);
    
            $category->delete();
            return redirect()->route('category.index')->with(['success' => 'تم الحذف بنجاح']);
        }catch(Exception $ex){
            return redirect()->route('category.index')->with(['error' => 'حدث مشكله ما يرجي المحاوله لاحقا ']);


        }

    }
}
