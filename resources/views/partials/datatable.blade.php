@php
    $id = $id ?? uniqid();

    $normalizedColumns = [];
    $dataTableColumns = [];
    foreach ($columns as $column) {
        $normalizedColumn = [
            'attribute' => $column['attribute'],
            'label' => $column['label'] ?? ucwords($column['attribute']),
            'orderable' => $column['orderable'] ?? null,
            'searchable' => $column['searchable'] ?? null,
        ];
        $dataTableColumn = [
            'data' => $normalizedColumn['attribute'],
            'orderable' => $normalizedColumn['orderable'] ?? null,
            'searchable' => $normalizedColumn['searchable'] ?? null,
        ];
        $normalizedColumns[] = $normalizedColumn;
        $dataTableColumns[] = $dataTableColumn;
    }
@endphp

<table id="{{ $id }}">
    <thead>
        <tr>
            @foreach($normalizedColumns as $column)
                <th>{{ $column['label'] }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

<script>
    $(document).ready(function(){
        $('#{{ $id }}').DataTable({
            ajax: {
                url: '{{ $url }}',
                dataSrc: 'data'
            },
            columns: @json($dataTableColumns)
            //"bAutoWidth": false,
            //"dom":'<"wrapper"flipt>',
        

        });
    });
</script>