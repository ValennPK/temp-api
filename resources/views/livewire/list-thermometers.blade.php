<div>
    <h3>{{$role}}</h3>
    <h3>Your list of Thermometers</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @if (!$thermometers)
                <tr>
                    <td colspan="3">No data available in this table.</td>
                </tr>
            @else
                @foreach ($thermometers as $thermometer)
                <tr>
                    <td>{{ $thermometer->id }}</td>
                    <td><a href="/thermometer/{{ $thermometer->username }}">{{ $thermometer->username }}</a></td>
                    <td>{{ $thermometer->created_at }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
