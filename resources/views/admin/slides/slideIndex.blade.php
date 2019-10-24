<?

use App\Domain\Slide\Entities\Slide;

/** @var $slide Slide */
?>
@extends('layouts.admin')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <a href="{{route('admin.slides.create')}}" class="btn btn-primary mr-1">{{__('adminPanel.create')}}</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">{{__('adminPanel.order')}}</th>
                    <th scope="col">{{__('adminPanel.photo')}}</th>
                    <th scope="col">{{__('adminPanel.description')}}</th>
                    <th scope="col">{{__('adminPanel.link')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($slides as $slide)
                    <tr>
                        <th scope="row">{{ $slide->order }}</th>
                        <td width="10%">
                            <a href="{{route('admin.slides.show', $slide)}}">
                                <img src="{{$slide->photo->getUrl()}}" alt="{{$slide->description}}" class="w-100">
                            </a>
                            @unless($loop->first)
                                <a href="{{route('admin.slides.left', $slide)}}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-up"></i>
                                </a>
                            @endunless
                            @unless($loop->last)
                                <a href="{{route('admin.slides.right', $slide)}}" class="btn btn-primary">
                                    <i class="fas fa-arrow-down"></i>
                                </a>
                            @endunless
                        </td>
                        <td>
                            {!! $slide->description !!}
                        </td>
                        <td>
                            <a href="{{$slide->link}}">{{ $slide->link }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            {{$slides->links()}}
            <span class="align-self-center">views: {{$slides->count()}}, total: {{$slides->total()}}</span>
        </div>
    </div>
@endsection
