<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){

        $categories = Product::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return \view('admin.Product.index',\compact('categories'));
    }

    public function create(){

        $categories = Category::Active()->select('id')->get();
        $brands = Brand::Active()->select('id')->get();
        $tags = Tag::select('id')->get();

        return view('admin.Product.general.create',\compact(['categories','tags','brands']));
    }

    public function store(GeneralProductRequest $request){

        if(!$request->has('active')){
            $request->request->add(['active'=>0]);
        }else{
            $request->request->add(['active'=>1]);
        }
        $slug = \explode(' ' ,$request->name);
        $slug = implode('-' , $slug);
        $request->request->add(['slug'=> $slug]);
        
        
        

        $Product= Product::create($request->except('_token'));
        $Product -> name = $request->name ;
        $Product->save();
        return redirect()->route('Product.index')->with(['success' => 'تم الحفظ بنجاح']);

        
    }



    public function edit( $id){

        $Product = Product::find($id);
        return \view('admin.Product.edit',\compact('Product'));
    }



    public function update(Request $request , $id){
        

        try{
          $Product = Product::find($id);

          

        if (!$Product)
            return redirect()->back()->with(['error' => 'هذا القسم غير موجود']);

        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);
            
            DB::beginTransaction();
        
        $Product->update($request->all());
        
        
        //save translations

        $Product->name = $request->name ;
        $Product->save();
        // DB::table('Product_translations')
        //     ->where("Product_id",  $id)
        //     ->limit(1)
        //     ->update(['name'=> $request->name ]);
        
        DB::commit();


        return redirect()->route('Product.index')->with(['success' => 'تم ألتحديث بنجاح']);
    }catch (Exception $ex) {
        DB::rollback();
        return redirect()->route('Product.edit')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }

    }



    public function delete($id){

        try{

            $Product = Product::find($id);
    
            if (!$Product)
                    return redirect()->route('Product.index')->with(['error' => 'هذا القسم غير موجود ']);
    
            $Product->delete();
            return redirect()->route('Product.index')->with(['success' => 'تم الحذف بنجاح']);
        }catch(Exception $ex){
            return redirect()->route('Product.index')->with(['error' => 'حدث مشكله ما يرجي المحاوله لاحقا ']);


        }

    }
}
