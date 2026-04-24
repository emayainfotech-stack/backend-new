<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            My City <span>Only</span>
        </a>
        <div class="sidebar-toggler">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="sidebar-body">
        <ul class="nav" id="sidebarNav">
    <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-lucide="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            {{-- ===================== HIDDEN SECTIONS ===================== --}}
            
            {{--
        

            <li class="nav-item nav-category">web apps</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails">
                    <i class="link-icon" data-lucide="mail"></i>
                    <span class="link-title">Email</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="link-icon" data-lucide="message-square"></i>
                    <span class="link-title">Chat</span>
                </a>
            </li>

            <li class="nav-item nav-category">Components</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents">
                    <i class="link-icon" data-lucide="feather"></i>
                    <span class="link-title">UI Kit</span>
                </a>
            </li>

            <li class="nav-item nav-category">Pages</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#authPages">
                    <i class="link-icon" data-lucide="unlock"></i>
                    <span class="link-title">Authentication</span>
                </a>
            </li>


            
            --}}

            {{-- ===================== ONLY THIS SHOW ===================== --}}
               {{-- <li class="nav-item nav-category">Components</li>
            <li class="nav-item"> --}}
                {{-- <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
                    <i class="link-icon" data-lucide="feather"></i>
                    <span class="link-title">UI Kit</span>
                    <i class="link-arrow" data-lucide="chevron-down"></i>
                </a>
                <div class="collapse" data-bs-parent="#sidebarNav" id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Accordion</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Alerts</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Badges</a>
                        </li>
                
                    </ul>
                </div>
            </li> --}}
            <li class="nav-item nav-category">News Management</li>

            <li class="nav-item">
                <a href="{{ route('news.index') }}" 
                   class="nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}">
                    <i class="link-icon" data-lucide="file-text"></i>
                    <span class="link-title">News</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('categories.index') }}" 
                   class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <i class="link-icon" data-lucide="folder"></i>
                    <span class="link-title">Categories</span>
                </a>
            </li>

            @if(auth()->user()?->role === 'admin')
                <li class="nav-item nav-category">Analytics</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.interest') }}"
                       class="nav-link {{ request()->routeIs('dashboard.interest') ? 'active' : '' }}">
                        <i class="link-icon" data-lucide="trending-up"></i>
                        <span class="link-title">User Interest</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</nav>