
<div class="sidebar" id="sidebar">
        <div class="d-flex justify-content-between align-items-center p-3">
            <h4 class="logo text-white">Admin</h4>
            <!-- Collapse Button Inside Sidebar -->
            <button class="btn btn-warning btn-sm" id="toggleSidebar">
                <i class="bi bi-caret-left-fill"></i> 
            </button>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('books.index') }}">
                    <i class="bi bi-book"></i> <span>Books Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('authors.index') }}">
                    <i class="bi bi-person"></i> <span>Authors Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="bi bi-tags"></i> <span>Categories Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door"></i> <span>Dashboard</span>
                </a>
            </li>
        </ul>
    </div>