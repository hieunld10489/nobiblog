@if($type === 'pc')
    <nav id="nav">
        <ul>
            @foreach (config('const.LS_MENU') as $aryRouteItem)
                @php $strUrl = '#'; $strClass = ''; @endphp
                @if($aryRouteItem['url'])
                    @php $strUrl = url($aryRouteItem['url']) @endphp
                @endif
                @if($routeAs === $aryRouteItem['url'])
                    @php $strClass = 'active ' @endphp
                @endif
                <li>
                    <a href="{{ $strUrl }}" class="{{ $strClass }} font-weight-bold h5">
                        <i class="fa {{ $aryRouteItem['icon'] }}" aria-hidden="true"></i>&nbsp;&nbsp;
                        {{ $aryRouteItem['text'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
@elseif($type === 'sp')
    <div id="nav-mobile" class="pos-f-t mar-bot-5rem">
        <nav class="navbar">
            <button class="navbar-toggler bg-white"
                    type="button" data-toggle="collapse"
                    aria-expand="false"
                    aria-controls="mobile-menu"
                    data-target="#mobile-menu">
                <i class="fa fa-slideshare text-dark" aria-hidden="true"></i>
            </button>
            <h3 class="text-white">NobiBlog</h3>
        </nav>

        <div class="collapse border-top" id="mobile-menu">
            @foreach (config('const.LS_MENU') as $aryRouteItem)
                @php $strUrl = '#'; $strClass = ''; @endphp
                @if($aryRouteItem['url'])
                    @php $strUrl = url($aryRouteItem['url']) @endphp
                @endif
                @if($routeAs === $aryRouteItem['url'])
                    @php $strClass = 'active' @endphp
                @endif

                <a href="{{ $strUrl }}" class="text-white nav-link">
                    &nbsp;&nbsp;<i class="fa {{ $aryRouteItem['icon'] }}" aria-hidden="true"></i>&nbsp;&nbsp;
                    {{ $aryRouteItem['text'] }}
                </a>
            @endforeach
        </div>
    </div>
@else
@endif