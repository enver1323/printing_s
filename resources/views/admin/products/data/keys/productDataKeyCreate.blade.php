@extends('layouts.admin')
@section('content')
    <form action="{{route('admin.products.data.keys.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @widget('translatable', ['translation' => __('adminPanel.name')])
        <div class="form-group">
            <input type="submit" value="{{__('adminPanel.save')}}" class="btn btn-primary">
        </div>
    </form>
@endsection
