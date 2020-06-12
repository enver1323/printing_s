@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.pages.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                @widget('translatable', ['name' => 'name', 'translation' => __('adminPanel.name')])
            </div>
            <div class="col-lg-6">
                @widget('translatable', ['name' => 'content', 'input' => 'textarea', 'translation' =>
                __('adminPanel.content')])
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.productCreate')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="documents">{{__('adminPanel.documents')}}</label>
                            <input name="documents[]" type="file" id="documents" value="{{ old('documents') }}"
                                   accept="application/pdf"
                                   class="form-control-file{{ $errors->has('photo') ? ' is-invalid': '' }}" multiple>
                            @if($errors->has('documents'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('documents') }}</strong></span>
                            @endif
                        </div>
                        <input type="submit" value="{{__('adminPanel.save')}}" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
@endpush
