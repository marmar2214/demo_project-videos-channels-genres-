<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ isset($active) && $active == 'home' ? '' : 'collapsed' }}" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isset($active) && $active == 'home' ? '' : 'collapsed' }}" href="{{ route('videos.index') }}">
                <i class="bi bi-grid"></i>
                <span>Videos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isset($active) && $active == 'home' ? '' : 'collapsed' }}" href="{{ route('channels.index') }}">
                <i class="bi bi-grid"></i>
                <span>Channels</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isset($active) && $active == 'home' ? '' : 'collapsed' }}" href="{{ route('genres.index') }}">
                <i class="bi bi-grid"></i>
                <span>Genere</span>
            </a>
        </li>
    </ul>
</aside>
