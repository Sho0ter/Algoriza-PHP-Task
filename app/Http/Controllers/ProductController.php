<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::with('category')->paginate(20);

        if($request->search){
            $search = $request->search;
            $products = Product::with('category')->where('name', 'like', "%$search%")->paginate(20);
        }
       

        return view('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        
        return view('product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $categories = Category::pluck('name', 'id')->all();
        try{

            $image = null;
            if ($request->hasFile('picture')) {
                $randomize = rand(111111, 999999);
                $extension = $request->file('picture')->getClientOriginalExtension();
                $filename = $randomize . '.' . $extension;
                $image = $request->picture->move(public_path('images'), $filename);
            }

          
            $store = Product::create($request->all());
            $store->picture = 'images/' . $filename ;
            $store->Save();

           

        }catch(Exception $e){
            dd($e);
            session()->flash('error', 'error in creating Product');
            return view('product.create',compact('categories'));
        }
        
          session()->flash('success' , 'Product Created Successfully');
        return view('product.create',compact('categories'));
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::pluck('name', 'id')->all();
        
        return view('product.update',compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
       
        $categories = Category::pluck('name', 'id')->all();

        try{

            $product->update($request->all());

            $image = null;
            if ($request->hasFile('picture')) {
                $randomize = rand(111111, 999999);
                $extension = $request->file('picture')->getClientOriginalExtension();
                $filename = $randomize . '.' . $extension;
                $image = $request->picture->move(public_path('images'), $filename);
                $product->picture = 'images/' . $filename ;
                $product->Save();
            }
          
        
        

           

        }catch(Exception $e){
                
            session()->flash('error', 'error in updateing Product');
            return view('product.update',compact('categories','product'));
        }
        
          session()->flash('success' , 'Product updated Successfully');
        return view('product.update',compact('categories','product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try{
            $product->delete();
        }catch(Exception $e){
            session()->flash('error' , 'error In delete');
            return redirect(route('products.index'));
        }
        session()->flash('success' , 'product deleted Successfully');
        return redirect(route('products.index'));   
    }
}
