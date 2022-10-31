@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="col-md-8 ">
                    <form method="GET" class="" action="{{route('categories.index')}}">
                        @csrf
                    <input type="search" id="search" value="{{request()->input('search')}}" name="search" class="form-control" />
                    <input type="submit" value="search" class="form-control btn-btn-primary" />
                    </form>
                </div>

            <div class="card">  
                <div class="col-md-3">
                    <a class="btn btn-primary" role="button" href="{{route('categories.create')}}" > {{ __('new category') }} </a>
                </div>
                <div class="card-header">{{ __('categories') }}</div>

                <div class="card-body">
                   <table class="table" >
                    <thead class="thead-dark">
                    <tr>   
                        <th>name</th>
                        <th>parent</th>
                        <th>is Active</th>
                        <th>created at</th>
                        <th></th>
                    </tr>   
                    </thead>
                    <tbody>
                    @foreach($categories as $category)

                        <tr>
                            <td> {{$category->name}} </td>
                            <td> {{$category->category ? $category->category->name : ''}} </td>
                            <td> {{$category->is_active}} </td>
                            <td> {{$category->created_at}} </td>
                            <td>
                            <a class="btn btn-primary" href="{{route('categories.edit', ['category' => $category->id ] )}}"> edit </a>
                            
                            <form method="POST" action="{{route('categories.destroy',  ['category' => $category->id ] )}}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" value="delete" />    
                            </form>
                            </td>
                        </tr>

                    @endforeach    
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
