@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.pages.update', $page)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        <div class="row">
            <div class="col-lg-6">
                @widget('translatable', ['entries' => $page->getTranslations('name'), 'translation' => __('adminPanel.name')])
            </div>
            <div class="col-lg-6">
                @widget('translatable', ['name' => 'content', 'input' => 'textarea',
                    'entries' => $page->getTranslations('content'), 'translation' => __('adminPanel.content')
                ])
            </div>

            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4 class="text-primary">{{__('adminPanel.pageCreate')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="documents">{{Str::plural(__('adminPanel.documents'))}}</label>
                            <input name="documents[]" type="file" id="documents" value="{{ old('documents') }}" accept="application/pdf"
                                   class="form-control-file{{ $errors->has('documents') ? ' is-invalid': '' }}" multiple>
                            @if($errors->has('documents'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('documents') }}</strong></span>
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
    <script type="text/javascript" src="{{mix('js/apiSelect.js', 'build')}}"></script>
    <script type="text/javascript" src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            new APISelect("#category", "{{route('ajax.categories')}}");
            new APISelect("#brand", "{{route('ajax.brands')}}");
            new APISelect("#line", "{{route('ajax.lines')}}");
        });
    </script>
@endpush
