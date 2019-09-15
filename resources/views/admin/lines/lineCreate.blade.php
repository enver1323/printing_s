@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.lines.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @widget('translatable', ['name' => 'name'])
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{__('adminPanel.save')}}</button>
        </div>
    </form>
@endsection
