@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.products.data.keys.update', $key)}}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @widget('translatable', ['entries' => $key->getTranslations('name'), 'translation' => __('adminPanel.name')])
        <div class="form-group">
            <input type="submit" value="{{__('adminPanel.save')}}" class="btn btn-primary">
        </div>
    </form>
@endsection
