<table class="table table-striped">
    <thead class="thead-dark">
    <tr>
        <th scope="col">{{__('adminPanel.id')}}</th>
        <th scope="col">{{__('adminPanel.name')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($options as $option)
        <tr>
            <th scope="row">{{ $option->id }}</th>
            <td>
                <a href="{{route('admin.products.options.show', $option)}}">{{ $option->name }}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
