<aside class="sidebar">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="list-group">
                    @if($user->is_admin)
                        <a href="{{ route("admin.users") }}" class="list-group-item list-group-item-action">Users</a>
                    @endif
                    <a href="{{ route("user.links") }}" class="list-group-item list-group-item-action">My Links</a>
                    <a href="/" class="list-group-item list-group-item-action">My Profile</a>
                </div>
            </div>
        </div>
    </div>
</aside>
