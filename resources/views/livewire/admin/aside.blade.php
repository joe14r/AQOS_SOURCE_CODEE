<!-- Sidebar -->
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            @php
            //dd(auth()->user()->hasRole('Admin'));
            @endphp
            <nav>
                <ul>
                    @auth
                    <li><a wire:navigate href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                    @if (auth()->user()->hasRole('Admin'))
                        
                        <li><a wire:navigate href="{{ route('users') }}"><i class="fas fa-users"></i> User Management</a></li>
                        <li><a wire:navigate href="{{ route('roles') }}"><i class="fas fa-low-vision"></i> Role Management</a></li>
                        <li><a wire:navigate href="{{ route('tables') }}"><i class="fas fa-utensils"></i> Table Editing</a></li>

                        <li><a wire:navigate href="{{ route('menus') }}"><i class="fas fa-utensils"></i> Menu Editing</a></li>
                        <li><a wire:navigate href="{{ route('transections.index') }}"><i class="fas fa-file-invoice-dollar"></i> Transaction
                            Reports</a></li>

                        <li><a wire:navigate href="{{ route('admin.feedback') }}"><i class="fa-solid fa-comment"></i>Feedback</a></li>
                    @endif
                        <li><a wire:navigate href="{{ route('admin.order') }}"><i class="fas fa-clipboard-list"></i> Orders Tracking</a></li>

                        

                    @endauth

                            
                </ul>

                <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
            </nav>
        </aside>