@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.categories.update', $category)}}" method="POST">
        @method('PATCH')
        @csrf
        @widget('translatable', ['entries' => $category->getTranslations('name')])
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{__('adminPanel.update')}}</button>
        </div>
    </form>
@endsection
