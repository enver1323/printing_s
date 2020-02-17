<div class="card shadow mb-4">
    <div class="card-header">
        <h4 class="text-primary">{{ucfirst($name)}}</h4>
    </div>
    <div class="card-body" id="{{$name}}Container"></div>
</div>
<script type="text/javascript" src="{{mix('js/translatable.js', 'build')}}"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        let {{$name}}Entries = new Translatable("{{$name}}", "{{$name}}Container", @json($languages, JSON_UNESCAPED_UNICODE), "{{$input}}");
        @php $entries = old($name) ?? $entries  @endphp
        @if(isset($entries) && !empty($entries))
        {{$name}}Entries.setEntries(@json($entries, JSON_UNESCAPED_UNICODE));
        @endif
    });
</script>
