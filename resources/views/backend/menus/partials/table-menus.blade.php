<table class="table table-hover">
    <thead>
    <th>Name</th>
    <th>Active</th>
    <th>Target</th>
    <th></th>
    </thead>
    <tbody>
    @foreach($menus as $menu)
        <tr>
            <td> {{ $menu->name }}</td>
            <td> {!! $menu->active ? '<span class="text-success"><i class="fa fa-check"></i></span>' : '<span class="text-warning"><i class="fa fa-times"></i></span>' !!}</td>
            <td> {{ $menu->menuTarget }}</td>
            <td class="text-right">
                <a class="btn btn-sm btn-secondary"
                   href="{{ route('private.menus.edit', $menu->id) }}"><i class="fa fa-pencil-square-o"></i></a>

                @include('backend.partials.delete-link', ['url' => route('private.menus.destroy', $menu->id), 'id' => $menu->id,  'form_id' => 'delete-menu-' . $menu->id])
            </td>
        </tr>
    @endforeach
    </tbody>
</table>