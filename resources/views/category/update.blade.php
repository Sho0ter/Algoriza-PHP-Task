@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{route('categories.index')}}">{{ __('categories') }} </a></div>
               
                <div class="card-body">
                    <form method="POST" action="{{route('categories.update', ['category' => $category->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="error">{{ $errors->first('name') }}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category_id" class="col-md-4 col-form-label text-md-end">{{ __('parent category') }}</label>
                            <div class="col-md-6">
                                <select id="category_id" name="category_id"  class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="" > Select one </option>
                                    @foreach($categories as $id => $category_name)
                                    <option value="{{$id}}" @if($id == $category->category_id ) selected @endif>
                                        {{$category_name}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="error">{{ $errors->first('category_id') }}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="is_Active" class="col-md-4 col-form-label text-md-end">{{ __('is Active') }}</label>
                            <div class="col-md-6 form-check form-switch">
                            <select id="is_active" name="is_active"  class="form-control @error('is_active') is-invalid @enderror">
                                <option value="0" @if($category->is_active == 0) selected @endif > not active </option>
                                <option value="1" @if($category->is_active == 1) selected @endif  > Active </option>
                                </select>
                                @error('is_active')
                                    <span class="error text-danger">{{ $errors->first('is_active') }}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
