<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        @if (isset($breadcrumbs))
            @foreach ($breadcrumbs as $breadcrumb)
                @if (!is_null($breadcrumb[1]) && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb[1] }}">{{ $breadcrumb[0] }}</a></li>
                @else
                    <li class="breadcrumb-item active">{{ $breadcrumb[0] }}</li>
                @endif  
            @endforeach
        @endif
    </ol>
</nav>
