@extends('layouts.default')

@section('title', 'Edit Currency - '.$currency->name)

@section('content')

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title"></h4>

                    @include('currency.partials.form', ['currency' => $currency])
                </div>
            </div>
        </div>
    </div>
@endsection
