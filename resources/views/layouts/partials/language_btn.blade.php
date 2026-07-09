<!-- <div class="lang-dropdown-wrapper">
    <details class="lang-dropdown">
        <summary class="lang-dropdown-summary">
            <span>{{ isset($_GET['lang']) ? config('constants.langs')[$_GET['lang']]['full_name'] : config('constants.langs')[config('app.locale')]['full_name'] }}</span>
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </summary>
        <ul class="lang-dropdown-menu">
            @foreach (config('constants.langs') as $key => $val)
                <li>
                    <a value="{{ $key }}" class="change_lang">{{ $val['full_name'] }}</a>
                </li>
            @endforeach
        </ul>
    </details>
</div> -->