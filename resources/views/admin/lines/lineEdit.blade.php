@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.lines.update', $line)}}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @widget('translatable', ['entries' => $line->getTranslations('name')])
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{__('adminPanel.update')}}</button>
        </div>

    </form>
@endsection
