@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.slides.update', $slide)}}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col-lg-6">
                @widget('translatable', ['name' => 'description', 'input' => 'textarea', 'entries' => $slide->getTranslations('description'), 'translation' => __('adminPanel.description')])
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.slideCreate')}}</h4>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="photo">{{__('adminPanel.photo')}}</label>
                            <input name="photo" type="file" id="photo" value="{{ old('photo') }}" accept="image/*"
                                   class="form-control-file{{ $errors->has('photo') ? ' is-invalid': '' }}">
                            @if($errors->has('photo'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('photo') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="link">{{__('adminPanel.link')}}</label>
                            <input name="link" type="text" id="link" value="{{ $slide->link }}" required
                                   class="form-control {{ $errors->has('link') ? ' is-invalid': '' }}">
                            @if($errors->has('link'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('link') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="order">{{__('adminPanel.order')}}</label>
                            <input name="order" type="number" id="order" value="{{ $slide->order }}"
                                   class="form-control {{ $errors->has('order') ? ' is-invalid': '' }}">
                            @if($errors->has('order'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('order') }}</strong></span>
                            @endif
                        </div>
                        <input type="submit" value="{{__('adminPanel.update')}}" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
