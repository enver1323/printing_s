<table class="table table-striped">
    <thead class="thead-dark">
    <tr>
        <th scope="col">{{__('adminPanel.id')}}</th>
        <th scope="col">{{__('adminPanel.order')}}</th>
        <th scope="col">{{__('adminPanel.name')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $index => $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>
                @if(!$loop->first && $category->isMovable(true, $categories))
                <a href="{{route('admin.categories.move.up', $category)}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-arrow-circle-up"></i>
                </a>
                @endif
                @if(!$loop->last && $category->isMovable(false, $categories))
                <a href="{{route('admin.categories.move.down', $category)}}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-circle-down"></i>
                </a>
                @endif
            </td>
            <td>
                <a href="{{route('admin.categories.show', $category)}}">{{ str_repeat('~', $category->depth).$category->name }}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
