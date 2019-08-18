<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="text-primary">{{$translatableFieldName}}</h4>
    </div>
    <div class="card-body" id="{{$translatableField}}Container">
        @foreach($item->getTranslations($translatableField) as $language => $entry)
            <div class="form-group d-flex">
                <div class="flex-grow-1">
                    <label for="transEntry{{$translatableField.ucfirst($language)}}"
                           class="col-form-label">
                        {{ucfirst($language)}} language name
                    </label>
                    @if(isset($inputType))
                        <{{$inputType}} class="form-control entryNameInput" type="text"
                               id="transEntry{{$translatableField.ucfirst($language)}}"
                               name="{{sprintf("%s[%s]", $translatableField, $language)}}" value="{{$entry}}">{!!$entry!!}</{{$inputType}}>
                    @else
                        <input class="form-control entryNameInput" type="text"
                               id="transEntry{{$translatableField.ucfirst($language)}}"
                               name="{{sprintf("%s[%s]", $translatableField, $language)}}" value="{{$entry}}">
                    @endif
                </div>
                <button type="button" class="btn btn-danger ml-2 mt-auto"
                        onclick="removeEntryField(this)">&times;
                </button>
            </div>
        @endforeach
        @csrf
        @if(!$languages->isEmpty())
            @include('admin.translations._translatableEntriesSelect', [
                'languages' => $languages,
                'translatableField' => $translatableField,
                'inputType' => $inputType ?? 'input'
            ])
        @endif
    </div>
</div>
