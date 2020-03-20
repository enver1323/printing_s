@extends('layouts.admin')
@section('content')
    @if(!$page->documents->isEmpty())
        <div class="row">
            <div class="col-md-6 col-12">
                @endif
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex flex-row mb-4">
                            <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-primary mr-1">
                                {{__('adminPanel.edit')}}
                            </a>
                            <form action="{{route('admin.pages.destroy', $page)}}" method="POST" class="mr-1">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">{{__('adminPanel.delete')}}</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col">
                                <strong>{{__('adminPanel.id')}}: </strong>
                                <span>{{$page->id}}</span>
                            </div>
                        </div>
                        <hr>
                        @if($page->getTranslations('name')->count())
                            <div class="row ml-1">
                                @isset($page->mainPhoto->photo)
                                    <div class="image-resizable-container mr-3">
                                        <img src="{{$page->mainPhoto->photo->getUrl()}}" class="img-thumbnail" alt="">
                                        <form action="{{route('admin.pages.photo.delete', $page)}}"
                                              method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="btn btn-block btn-danger"
                                                   value="{{__('adminPanel.delete')}}">
                                        </form>
                                    </div>
                                @endisset
                                <div>
                                    <div class="mb-4">
                                        <strong>{{__('adminPanel.names')}}: </strong>
                                    </div>
                                    @foreach($page->getTranslations('name') as $language => $entry)
                                        <div class="mb-4">
                                            <span>{{ucfirst($language)}}  {{__('adminPanel.language')}}: </span>
                                            <span>{{$entry}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <hr>
                        <div>
                            <div class="mb-4">
                                <strong>{{__('adminPanel.description')}}: </strong>
                            </div>
                            @foreach($page->getTranslations('content') as $language => $entry)
                                <div class="mb-4">
                                    <span>{{ucfirst($language)}}  {{__('adminPanel.language')}}: </span>
                                    <span>{!! $entry !!}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <strong>{{__('adminPanel.slug')}}: </strong>
                                <span>{{$page->slug}}</span>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            @if(!$page->documents->isEmpty())
                <div class="col-md-6 col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>
                                {{__('adminPanel.documents')}}
                            </h4>
                        </div>
                        <div class="card-body">
                            <table>
                                <tr>
                                    <th>

                                    </th>
                                </tr>
                                @foreach($page->documents as $document)
                                    <tr>
                                        <td>
                                            <a href="{{$document->manual->getUrl()}}">{{$document->manual->getUrl()}}</a>
                                        <td>
                                            <form action="{{route('admin.pages.document.delete', $document)}}"
                                                  method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
@endsection
