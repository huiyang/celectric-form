@extends('layouts.default')

@section('title', 'New Currency')

@section('content')

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title"></h4>

                    @include('currency.partials.form')
                </div>
            </div>
        </div>
    </div>
@endsection
