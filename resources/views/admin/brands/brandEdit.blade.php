@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.brands.update', $brand)}}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col-lg-6">
                @widget('translatable', ['entries' => $brand->getTranslations('name'), 'translation' => __('adminPanel.name')])
            </div>
            <div class="col-lg-6">
                @widget('translatable', ['name' => 'description', 'input' => 'textarea', 'entries' => $brand->getTranslations('description'), 'translation' => __('adminPanel.description')])
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.brandCreate')}}</h4>
                    </div>
                    <div class="card-body">
                        @isset($brand->photo)
                            <img src="{{$brand->photo->getUrl()}}" alt="" class="img-thumbnail">
                        @endisset
                        <div class="form-group">
                            <label class="col-form-label" for="photo">{{__('adminPanel.photo')}}</label>
                            <input name="photo" type="file" id="photo" value="{{ old('photo') }}" accept="image/*"
                                   class="form-control-file{{ $errors->has('photo') ? ' is-invalid': '' }}">
                            @if($errors->has('photo'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('photo') }}</strong></span>
                            @endif
                        </div>
                        <input type="submit" value="{{__('adminPanel.update')}}" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{asset('js/admin/apiSelect.js')}}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            new APISelect("#category", "{{route('ajax.categories')}}");
        });
    </script>
@endpush
