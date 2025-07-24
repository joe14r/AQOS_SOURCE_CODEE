<!-- Sidebar -->
<aside class="modern-admin-sidebar">
    <div class="modern-admin-sidebar-header">
        <div class="modern-admin-sidebar-logo">
            <i class="fas fa-utensils"></i>
        </div>
        <h2>Admin Panel</h2>
    </div>
    <nav>
        <ul class="modern-admin-sidebar-nav">
            @auth
            <li><a wire:navigate href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
            @if (auth()->user()->hasRole('Admin'))
                <li><a wire:navigate href="{{ route('users') }}"><i class="fas fa-users"></i> User Management</a></li>
                <li><a wire:navigate href="{{ route('roles') }}"><i class="fas fa-user-shield"></i> Role Management</a></li>
                <li><a wire:navigate href="{{ route('tables') }}"><i class="fas fa-utensils"></i> Table Editing</a></li>
                <li><a wire:navigate href="{{ route('menus') }}"><i class="fas fa-hamburger"></i> Menu Editing</a></li>
                <li><a wire:navigate href="{{ route('transections.index') }}"><i class="fas fa-file-invoice-dollar"></i> Transaction Reports</a></li>
                <li><a wire:navigate href="{{ route('admin.feedback') }}"><i class="fas fa-comment-dots"></i> Feedback</a></li>
            @endif
            <li><a wire:navigate href="{{ route('admin.order') }}"><i class="fas fa-clipboard-list"></i> Orders Tracking</a></li>
            @endauth
        </ul>
        <div class="modern-admin-sidebar-divider"></div>
        <form method="POST" action="{{ route('logout') }}" class="modern-admin-sidebar-logout-form">
            @csrf
            <button type="submit" class="modern-admin-sidebar-logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </nav>
</aside>