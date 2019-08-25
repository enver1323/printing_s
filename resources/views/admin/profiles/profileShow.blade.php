<hr>
<div class="row ml-1">
    @isset($profile->photo)
        <div class="image-resizable-container mr-3">
            <img src="{{$profile->photo->getUrl()}}" class="img-thumbnail" alt="">
            <form action="{{route('admin.users.profiles.photo.delete', $profile)}}" method="POST">
                @method('DELETE')
                @csrf
                <input type="submit" class="btn btn-block btn-danger" value="{{__('adminPanel.delete')}}">
            </form>
        </div>
    @endisset
    <div>
        <div class="mb-4">
            <strong>{{__('adminPanel.profile')}}: </strong>
        </div>
        <div class="mb-4">
            <span>{{__('adminPanel.id')}}: </span>
            <span>{{$profile->id}}</span>
        </div>
        <div class="mb-4">
            <span>{{__('adminPanel.name')}}: </span>
            <span>{{$profile->name}}</span>
        </div>
        <div class="mb-2">
            <span>{{__('adminPanel.surname')}}: </span>
            <span>{{$profile->family_name}}</span>
        </div>
    </div>
</div>
<hr>
<div class="row mb-4">
    <div class="col">
        <span>{{__('adminPanel.birthDate')}}: </span>
        <span>{{date('Y-m-d', $profile->birth_date)}}</span>
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <span>{{__('adminPanel.gender')}}: </span>
        <span>
            {{$profile->gender}} <i class="fas fa-{{$profile->gender}}"></i>
        </span>
    </div>
</div>
@isset($profile->country)
    <div class="row mb-4">
        <div class="col">
            <span>{{__('adminPanel.country')}}: </span>
            <span>{{$profile->country->name}}</span>
        </div>
    </div>
@endisset
<hr>
