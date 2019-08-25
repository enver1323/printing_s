<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="text-primary">{{$translatableFieldName}}</h4>
    </div>
    <div class="card-body" id="{{$translatableField}}Container">
        @include('admin.translations._translatableEntriesSelect', [
            'languages' => $languages,
            'translatableField' => $translatableField,
            'inputType' => $inputType ?? 'input'
        ])

    </div>
</div>
