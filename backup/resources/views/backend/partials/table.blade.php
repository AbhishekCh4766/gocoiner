<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <th>Name</th>
        <th>Symbol</th>
        <th>Coin ID</th>
        <th class="text-right">Last Updated</th>
        </thead>
        <tbody>
        @foreach($coins as $coin)
            <tr>
                <td><a href="{{ route('admin.coins.edit', $coin->id) }}"> {{ $coin->name }}</a></td>
                <td> {{ $coin->symbol }}</td>
                <td> {{ $coin->coin_id }}</td>
                <td class="text-right">{{ $coin->last_updated }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>