<div class="btn-group dropdown ">
    <a href="{{ $url ?? '#' }}" id="{{ $id ?? '' }}" class="btn btn-primary btn-xs {{ $class ?? '' }}" data-toggle="{{ $dataToggle ?? '' }}" data-target="{{ $dataTarget ?? '' }}">{{ $label }}</a>

    <button type="button" class="btn btn-primary btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{-- <span class="sr-only">Toggle Dropdown</span> --}}
    </button>
    <div class="dropdown-menu">
        @foreach($items as $item)
            <a class="dropdown-item {{ $item['class'] ?? '' }}" id="{{ $item['id'] ?? '' }}" >{{ $item['label'] ?? '' }}</a>
        @endforeach
    </div>
</div>
