<div>
    <h2>Data from Table: {{ $thermometerName }}</h2>

    @if ($data->isEmpty())
        <p>No data available in this table.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach ($data->first() as $column => $value)
                        <th>{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        @foreach ($row as $value)
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
