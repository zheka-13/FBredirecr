<aside class="sidebar">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="list-group">
                    @if($user->is_admin)
                        <a href="{{ route("admin.users") }}" class="list-group-item list-group-item-action">{{ __("Users") }}</a>
                    @endif
                    <a href="{{ route("user.links") }}" class="list-group-item list-group-item-action">{{ __("Facebook Links") }}</a>
                </div>
            </div>
        </div>
        <div class="row" style="padding-top: 10px;">
            <div class="col">
                {{ __("Choose your language") }}:<br>
                <a title="{{ __("English") }}" href="{{ request()->fullUrlWithQuery(["lang"=>'en']) }}"><img src="/img/flag_en.png"></a>
                <a title="{{ __("Russian") }}" href="{{ request()->fullUrlWithQuery(["lang"=>'ru']) }}"><img src="/img/flag_ru.png"></a>
            </div>
        </div>
    </div>
</aside>
