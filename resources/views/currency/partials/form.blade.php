@php
    $new = !isset($currency);
    $currency = $currency ?? optional();
@endphp

<form method="post" action="{{ $new ? route('currency.store') : route('currency.update', ['currency' => $currency]) }}">
  @csrf

  @if(!$new)
    {{ method_field('PATCH') }}
  @endif

  <div class="form-group">
    <label for="">Name</label>
    <input value="{{ old('name', $currency->name) }}" name="name" type="" class="form-control" placeholder="Name">
    <small class="form-text text-muted">
        
    </small>
  </div>
  <div class="form-group">
    <label for="">Code</label>
    <input value="{{ old('code', $currency->code) }}" name="code" type="" class="form-control" placeholder="Code">
    <small class="form-text text-muted">
        
    </small>
  </div>
  <div class="form-group">
    <label for="">Exchange Rate</label>
    <input value="{{ old('exchange_rate', $currency->exchange_rate) }}" name="exchange_rate" class="form-control" placeholder="Exchange Rate">
    <small class="form-text text-muted">
        
    </small>
  </div>
  <div class="form-group">
    <label for="">Symbol</label>
    <input value="{{ old('symbol', $currency->symbol) }}" name="symbol" class="form-control" placeholder="Symbol">
    <small class="form-text text-muted">
        
    </small>
  </div>
  <div class="form-group">
    <label for="">Format</label>
    <input value="{{ old('format', $currency->format, '$1,0.00') }}" name="format" class="form-control" placeholder="Format">
    <small class="form-text text-muted">
        
    </small>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>