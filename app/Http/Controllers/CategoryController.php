<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;


class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageCategory()
    {
        $categories = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::where('is_dir','=',0)->pluck('title','id');
		$dallCategories = Category::pluck('title','id')->all();
        return view('categoryTreeview',compact('categories','allCategories','dallCategories'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCategory(Request $request)
    {
        $this->validate($request, [
        		'title' => 'required',
        	]);
        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
		$input['is_dir'] = empty($input['is_dir']) ? 0 : $input['is_dir'];
        
        Category::create($input);
		if(empty($input['is_dir'])){
			return back()->with('successdir', 'New Directory added successfully.');
		}
		else{
			return back()->with('successfile', 'New File added successfully.');
		}
        
    }
	
	public function deleteCategory(Request $request)
    {
        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
		if($input['parent_id'] > 0){
			Category::where('id',$input['parent_id'])->orWhere('parent_id',$input['parent_id'])->delete();
			return back()->with('successdel', 'File/Directory Deleted...');
		}else{
			return back()->with('faildir', 'Select File or Directory');
		}
        
		
        
    }


}