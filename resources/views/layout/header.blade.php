<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 align-self-start">
                <a href="/">Zheka13.net.ua</a>
                <a style="padding-left: 50px;" href="{{ route('home') }}"><span class="badge badge-success">FB redirect</span></a>
            </div>
            <div class="col-8">

            </div>
            <div class="col-2">
                <p style="margin-top:10px ">Hello {{ $user->name }}({{ $user->email }}) <a href="{{ route('logout') }}" >{{ __("Logout") }}</a></p>

            </div>
        </div>
    </div>
</header>

