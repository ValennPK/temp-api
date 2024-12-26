<div>
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
            @foreach ($thermometers as $thermometer)
                <tr>
                    <td>{{ $thermometer->id }}</td>
                    <td>{{ $thermometer->username }}</td>
                    <td>{{ $thermometer->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
