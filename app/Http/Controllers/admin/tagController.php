<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use FFI\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class tagController extends Controller
{

    public function index()
    {
        $tags = Tag::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }


    public function store(TagRequest $request)
    {

        //validation
        try{

        
        DB::beginTransaction();
        $tag = Tag::create($request->all());
        //save translations
        $tag->name = $request->name;
        $tag->save();
        DB::commit();
    
        return redirect()->route('tag.index')->with(['success' => 'تم ألاضافة بنجاح']);
    }catch(Exception $ex){
        return redirect()->route('tag.index')->with(['error' => 'عفوا حدث مشكله ما يرجي المحاوله لاحقا']);
    }


    }


    public function edit($id)
    {

        //get specific categories and its translations
        $tag = Tag::find($id);

        if (!$tag)
            return redirect()->route('admin.tags')->with(['error' => 'هذا العلامه غير موجوده ']);

        return view('admin.tags.edit', compact('tag'));

    }


    public function update($id, TagRequest $request)
    {
        try {
            //validation

            //update DB
            


            $tag = Tag::find($id);
            

            if (!$tag)
                return redirect()->route('tag.index')->with(['error' => 'هذا العلامه غير موجوده']);


            DB::beginTransaction();
            

               

            $tag->update(['slug'=>$request->slug]);

            //save translations
            // DB::table('tag_translations')
            // ->where("id",  $id)
            // ->limit(1)
            // ->update(['name'=> $request->name ]);
            $tag->name = $request->name ;
            $tag ->save();

            DB::commit();
            return redirect()->route('tag.index')->with(['success' => 'تم ألتحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('tag.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function delete($id)
    {
        try {
            //get specific categories and its translations
            $tag = Tag::find($id);
            

            if (!$tag)
                return redirect()->route('tag.index')->with(['error' => 'هذا العلامه غير موجوده ']);

            $tag->delete();
            

            return redirect()->route('tag.index')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('tag.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
