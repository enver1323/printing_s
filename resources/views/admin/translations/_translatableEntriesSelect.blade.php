<div class="form-group row d-flex align-items-end">
    <div class="col-lg-8">
        <label class="col-form-label" for="{{$translatableField}}Select">{{__('adminPanel.addEntry')}}</label>
        <select class="form-control" id="{{$translatableField}}Select">
            @foreach($languages as $language)
                <option value="{{$language->code}}">{{$language->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-4">
        <button class="btn btn-primary btn-block" type="button"
                onclick="addEntries('{{$translatableField}}', '{{$translatableField}}Container', '{{$translatableField}}Select', '{{$inputType ?? 'input'}}')">
            {{__('adminPanel.add')}}
        </button>
    </div>
</div>
