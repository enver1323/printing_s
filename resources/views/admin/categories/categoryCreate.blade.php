@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.categories.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                @widget('translatable')
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.categoryCreate')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="parent">{{__('adminPanel.parent')}}</label>
                            <select name="parent_id" id="parent"
                                    class="form-control{{ $errors->has('parent_id') ? ' is-invalid': '' }}">
                                <option value="">{{__('adminPanel.choose')}}</option>
                                @isset($category)
                                    <option value="{{ $category->id}}" selected>
                                        {{$category->name}}
                                    </option>
                                @endisset
                            </select>
                            @if($errors->has('parent_id'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('parent_id') }}</strong></span>
                            @endif
                        </div>
                        <input type="submit" value="{{__('adminPanel.save')}}" class="float-right btn btn-primary">
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
            new APISelect("#parent", "{{route('ajax.categories')}}");
        });
    </script>
@endpush
