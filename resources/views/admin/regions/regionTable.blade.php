<table class="table table-striped">
    <thead class="thead-dark">
    <tr>
        <th scope="col">{{__('adminPanel.id')}}</th>
        <th scope="col">{{__('adminPanel.name')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($regions as $region)
        <tr>
            <th scope="row">{{ $region->id }}</th>
            <td>
                <a href="{{route('admin.regions.show', $region)}}">{{ $region->name }}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
