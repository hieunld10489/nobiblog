<nav id="breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($aryContent as $aryContentItem)
            @if(isset($aryContentItem['link']))
                <li class="breadcrumb-item">
                    <a href="{{ $aryContentItem['link'] }}">{{ $aryContentItem['text'] }}</a>
                </li>
            @else
                <li class="breadcrumb-item {!! $aryContentItem['class'] !!}">{{ $aryContentItem['text'] }}
                    @if(isset($aryContentItem['span']))
                        <span class="text-danger">{{ $aryContentItem['span'] }}</span>
                    @endif
                </li>
            @endif
        @endforeach
    </ol>
</nav>