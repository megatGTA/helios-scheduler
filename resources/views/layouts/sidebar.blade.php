<aside id="sidebar"  
    class="bg-white border-end position-fixed h-100 sidebar-expanded"
    style="top:0; left:0; z-index:1000; transition: width .3s;">

    
    <div class="p-3 border-bottom text-center">
    <img src="{{ asset('assets/gtalogo1.png') }}" 
         class="img-fluid mb-2 menu-text" 
         id="logo-full"
         style="height: 40px;">

    <!-- Small Logo (Visible when collapsed) -->
    <img src="{{ asset('assets/gtalogo3.png') }}" 
         class="img-fluid mb-2" 
         id="logo-small"
         style="height: 40px; display:none;">

    <small class="text-muted menu-text">Aircraft Engine Maintenance</small>
</div>

    <nav class="p-3 overflow-auto">
        <ul class="list-unstyled">

            <li>
                <a href="#" class="d-flex align-items-center py-2 text-decoration-none text-dark">
                    <i class="bi bi-house-door me-2"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="#" class="d-flex align-items-center py-2 text-decoration-none text-dark">
                    <i class="bi bi-list-check me-2"></i>
                    <span class="menu-text">Tasks</span>
                </a>
            </li>

            <li>
                <a href="#" class="d-flex align-items-center py-2 text-decoration-none text-dark">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    <span class="menu-text">Task Card Library</span>
                </a>
            </li>

            <li>
                <a href="#" class="d-flex align-items-center py-2 text-decoration-none text-dark">
                    <i class="bi bi-gear me-2"></i>
                    <span class="menu-text">Assets</span>
                </a>
            </li>

            {{-- Collapsible Menu --}}
            <li>
    <a class="d-flex align-items-center py-2 text-decoration-none text-dark"
       data-bs-toggle="collapse"
       href="#scheduleMenu"
       role="button"
       aria-expanded="false"
       aria-controls="scheduleMenu">

        <i class="bi bi-calendar3 me-2"></i>
        <span class="menu-text">Schedule Optimization</span>
        <i class="bi bi-caret-down-fill ms-auto small"></i>
    </a>

    <div class="collapse ms-4 mt-1" id="scheduleMenu">
        <a href="#" class="d-block text-decoration-none text-dark small py-1">
            <span class="menu-text">Overview</span>
        </a>

        <a href="#" class="d-block text-decoration-none text-dark small py-1">
            <span class="menu-text">Planning Dashboard</span>
        </a>

        <a href="#" class="d-block text-decoration-none text-dark small py-1">
            <span class="menu-text">Workforce Matrix</span>
        </a>
    </div>
</li>


        </ul>
    </nav>

    <div class="p-3 border-top">
        <div class="d-flex align-items-center mb-2">
            <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center"
                style="width:40px;height:40px;">
                <i class="bi bi-person"></i>
            </div>
            <div class="ms-2">
                <strong class="menu-text">Jane Doe</strong><br>
                <small class="text-muted menu-text">Workshop Manager</small>
            </div>
        </div>

        

</aside>
