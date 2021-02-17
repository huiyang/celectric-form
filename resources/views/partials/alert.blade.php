
@php
    $messageClass = [
    ];
@endphp
<div class="">
    @if($errors->any())
    <ul class="{{ $messageClass['error'] ?? 'alert alert-danger' }} {{ $class ?? '' }}" role="alert">
        @foreach($errors->all() as $error)
            <li> {{ $error }}</li>
        @endforeach
    </ul>
    @endif

    @if (session('success'))
        <div class="{{ $messageClass['success'] ?? 'alert alert-success' }}" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('invalid'))
        <ul class="woocommerce-error" role="alert">
            <li> {{ session('invalid') }}</li>
        </ul>
    @endif

</div>

@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert alert-{{ $message['level'] }} {{ $messageClass[$message['level']] ?? 'alert-'.$message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}" role="alert">

            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
