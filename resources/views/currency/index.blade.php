@extends('layouts.default')

@section('title', 'Currencies')

@section('content')

    <div class="row mt-3">
        <div class="col-12">
            <a href="{{ route('currency.create') }}" class="btn btn-primary float-right" id="addBtn">Add New Currency</a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h4 class="header-title"></h4>

            @include('partials.datatable', [
                'url' => url('/api/currency'),
                'columns' => [
                    [
                        'attribute' => 'name',
                    ],
                    
                    [
                        'attribute' => 'code',
                    ],
                    [
                        'attribute' => 'action',
                        'orderable' => false, 
                        'searchable' => false,
                    ]
                ],
            ])
        </div>
    </div>

    <script>
        function submitDelete(id, url) {
            var csrf = '{{csrf_token()}}';
            var $form = document.createElement('form');

            $form.setAttribute('action', url);
            $form.setAttribute('method', 'post');

            addFields($form, [
                {name: '_method', value: 'DELETE'},
                {name: '_token', value: csrf}
            ])
            
            document.querySelector('body').append($form);
            
            $form.submit();
        }

        function addFields($form, fields) {
            fields.forEach((field) => {
                var $field = document.createElement('input');
                
                $field.setAttribute('type', 'hidden');
                $field.setAttribute('name', field.name);
                $field.setAttribute('value', field.value);

                $form.append($field);
            })
        }
    </script>

@endsection