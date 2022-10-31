<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request; 

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::with('category')->paginate(20);
        
        if($request->search){
            $search = $request->search;
            $categories = Category::with('category')->where('name', 'like', "%$search%")->paginate(20);
        }
       
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        
        return view('category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
          
        try{
            $store = Category::create([
                'name' => $request->name,
                'is_active' => $request->is_active,
                'category_id' => $request->category_id
            ]);

            $categories = Category::pluck('name', 'id')->all();

        }catch(Exception $e){
            session()->flash('error', 'error in creating Category');
            return view('category.create',compact('categories'));
        }
        
          session()->flash('success' , 'Category Created Successfully');
        return view('category.create',compact('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::pluck('name', 'id')->all();
        
        return view('category.update',compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
               
        try{
            $store = $category->update([
                'name' => $request->name,
                'is_active' => $request->is_active,
                'category_id' => $request->category_id
            ]);

            $categories = Category::pluck('name', 'id')->all();

        }catch(Exception $e){
            
            session()->flash('error', 'error in updating Category');
            return view('category.update',compact('categories', 'category'));
        }
        
          session()->flash('success' , 'Category updated Successfully');
        return view('category.update',compact('categories', 'category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try{
            $category->delete();
        }catch(Exception $e){
            session()->flash('error' , 'error In delete');
            return redirect(route('categories.index'));
        }
        session()->flash('success' , 'Category deleted Successfully');
        return redirect(route('categories.index'));   
    }
}
