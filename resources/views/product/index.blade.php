@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="col-md-8 ">
                    <form method="GET" class="" action="{{route('products.index')}}">
                        @csrf
                    <input type="search" id="search" value="{{request()->input('search')}}" name="search" class="form-control" />
                    <input type="submit" value="search" class="form-control btn-btn-primary" />
                    </form>
                </div>

            <div class="card">
            <div class="col-md-3">
                    <a class="btn btn-primary" role="button" href="{{route('products.create')}}" > {{ __('new product') }} </a>
                </div>
                
                <div class="card-header">{{ __('products') }}</div>

                <div class="card-body">
                   <table class="table" >
                    <thead>
                        <th>name</th>
                        <th>category</th>
                        <th>description</th>
                        <th>tags</th>
                        <th>image</th>
                        <th>created at</th>
                        <th></th>
                    </thead>
                    
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name}} </td>
                            <td>{{ $product->category->name}} </td>
                            <td>{{ $product->description}} </td>
                            <td>{{ $product->tags}} </td>
                            <td> <img src="{{url($product->picture)}}" style="width:200px; height:200px;" />  </td>
                            <td>{{ $product->created_at}} </td>
                            <td>
                            <a class="btn btn-primary" href="{{route('products.edit', ['product' => $product->id ] )}}"> edit </a>
                            
                            <form method="POST" action="{{route('products.destroy',  ['product' => $product->id ] )}}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" value="delete" />    
                            </form>
                            </td>
                        </tr>

                    @endforeach
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
