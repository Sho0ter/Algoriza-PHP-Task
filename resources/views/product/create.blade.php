@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{route('products.index')}}">{{ __('products') }} </a></div>
               
                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="error">{{ $errors->first('name') }}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category_id" class="col-md-4 col-form-label text-md-end">{{ __('category') }}</label>
                            <div class="col-md-6">
                                <select id="category_id" name="category_id"  class="form-control @error('category_id') is-invalid @enderror" required>
                                    <option value="" disabled selected> Select one </option>
                                    @foreach($categories as $id => $category)
                                    <option value="{{$id}}" @if($id == old('category_id') )  selected @endif>
                                        {{$category}}
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
                            <label for="tags" class="col-md-4 col-form-label text-md-end">{{ __('tags') }}</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('tags') is-invalid @enderror" value="{{ old('tags') }}" name="tags" id="tags" />
                                @error('tags')
                                    <span class="error text-danger">{{ $errors->first('tags') }}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('description') }}</label>
                            <div class="col-md-6">
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="error text-danger">{{ $errors->first('description') }}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="picture" class="col-md-4 col-form-label text-md-end">{{ __('Picture') }}</label>
                            <div class="col-md-6">
                            <input type="file" class="form-control @error('picture') is-invalid @enderror" value="{{old('picture')}}" name="picture" id="picture" />
                                @error('picture')
                                    <span class="error text-danger">{{ $errors->first('picture') }}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('create') }}
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
