<div class="card shadow mb-4">
    <div class="card-header">
        <h4>{{ucfirst($translation ?? $name)}}</h4>
    </div>
    <div class="card-body" id="{{$name}}Container"></div>
</div>
<script type="text/javascript" src="{{mix('js/translatable.js', 'build')}}"></script>
<script type="text/javascript" src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('js/ckeditor/plugins/a11yhelp/dialogs/lang/ru.js')}}"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        let {{$name}}Entries = new Translatable(@json(['field' => $name, 'translation' => $translation ?? $name]), "{{$name}}Container", @json(config('laravellocalization.supportedLocales'), JSON_UNESCAPED_UNICODE), "{{$input ?? 'input'}}");
        @php $entries = old($name) ?? ($entries ?? [])  @endphp
        @if(isset($entries) && !empty($entries))
        {{$name}}Entries.setEntries(@json($entries, JSON_UNESCAPED_UNICODE));
        @endif
    });
</script>
