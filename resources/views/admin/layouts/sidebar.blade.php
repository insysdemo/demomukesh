
<style>

</style>

<!-- Sidebar Menu -->
<nav class="mt-2">

    <ul aria-expanded="false">
        @if (Auth::user()->can('Role access'))
            <li><a href="{{ route('home') }}">Dashboard</a></li>
        @endif
    </ul>
    <li class="nav-item">
        <ul aria-expanded="false">
            @if (Auth::user()->can('Role access'))
                <li><a href="{{ route('role.index') }}">Roles</a></li>
            @endif
            @if (Auth::user()->can('Permission access'))
                <li><a href="{{ route('permission.index') }}">Permissions</a></li>
            @endif
            @if (Auth::user()->can('Rolehaspermission access'))
                <li><a href="{{ route('role-has-permission.index') }}">Access</a></li>
            @endif

        </ul>
    </li>

    <ul aria-expanded="false">
        @if (Auth::user()->can('User access'))
            <li><a href="{{ route('user.index') }}">Users</a></li>
        @endif
    </ul>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout', ['id' => auth('admin')->id()]) }}" role="button">
            LogOut
        </a>

    </li>



</nav>
<!-- /.sidebar-menu -->
