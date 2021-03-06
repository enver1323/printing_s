@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.categories.update', $category)}}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col-md-6">
                @widget('translatable', ['entries' => $category->getTranslations('name'), 'translation' => __('adminPanel.name')])
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.categoryCreate')}}</h4>
                    </div>
                    <div class="card-body">
                        @isset($category->photo)
                            <img src="{{$category->photo->getUrl()}}" alt="" class="img-thumbnail">
                        @endisset
                        <div class="form-group">
                            <label class="col-form-label" for="photo">{{__('adminPanel.photo')}}</label>
                            <input name="photo" type="file" id="photo" value="{{ old('photo') }}" accept="image/*"
                                   class="form-control-file{{ $errors->has('photo') ? ' is-invalid': '' }}">
                            @if($errors->has('photo'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('photo') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{__('adminPanel.update')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
