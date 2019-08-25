<div class="card shadow">
    <div class="card-header">
        <h4 class="text-primary">{{__('adminPanel.profileCreate')}}</h4>
    </div>
    <div class="card-body">
        @csrf
        <div class="form-group">
            <label class="col-form-label" for="name">{{__('adminPanel.name')}}</label>
            <input name="profile[name]" class="form-control{{ $errors->has('name') ? ' is-invalid': '' }}" id="name"
                   value="{{ old('profile[name]') }}">
            @if($errors->has('profile[name]'))
                <span class="invalid-feedback"><strong>{{ $errors->first('profile[name]') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label class="col-form-label" for="surname">{{__('adminPanel.surname')}}</label>
            <input name="profile[family_name]" type="text" id="surname" value="{{ old('profile[family_name]') }}"
                   class="form-control{{ $errors->has('profile[family_name]') ? ' is-invalid': '' }}">
            @if($errors->has('profile[family_name]'))
                <span class="invalid-feedback"><strong>{{ $errors->first('profile[family_name]') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label class="col-form-label" for="nickname">{{__('adminPanel.nickname')}}</label>
            <input name="profile[nickname]" type="text" id="nickname" value="{{ old('profile[nickname]') }}"
                   class="form-control{{ $errors->has('profile[nickname]') ? ' is-invalid': '' }}">
            @if($errors->has('profile[nickname]'))
                <span class="invalid-feedback"><strong>{{ $errors->first('profile[nickname]') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label class="col-form-label" for="birthDate">{{__('adminPanel.birthDate')}}</label>
            <input name="profile[birth_date]" type="text" id="birthDate" value="{{ old('profile[birth_date]') }}"
                   class="form-control{{ $errors->has('profile[birth_date]') ? ' is-invalid': '' }}">
            @if($errors->has('profile[birth_date]'))
                <span class="invalid-feedback"><strong>{{ $errors->first('profile[birth_date]') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label class="col-form-label" for="photo">{{__('adminPanel.photo')}}</label>
            <input name="profile[photo]" type="file" id="photo" value="{{ old('profile[photo]') }}" accept="image/*"
                   class="form-control-file{{ $errors->has('profile[photo]') ? ' is-invalid': '' }}">
            @if($errors->has('profile[photo]'))
                <span class="invalid-feedback"><strong>{{ $errors->first('profile[photo]') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label class="col-form-label" for="gender">{{__('adminPanel.gender')}}</label>
            <select name="profile[gender]" type="text" id="gender"
                    class="form-control{{ $errors->has('profile[gender]') ? ' is-invalid': '' }}">
                @foreach($genders as $gender)
                    <option value="{{$gender}}">{{ucfirst($gender)}}</option>
                @endforeach
            </select>
            @if($errors->has('profile[gender]'))
                <span class="invalid-feedback"><strong>{{ $errors->first('profile[gender]') }}</strong></span>
            @endif
        </div>
    </div>
</div>
