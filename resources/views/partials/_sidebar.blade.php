<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/home') }}">
              <i class="mdi mdi-collage menu-icon"></i>
              <span class="menu-title">Overview</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#post" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-blur menu-icon"></i>
              <span class="menu-title">Posts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="post">
              <ul class="nav flex-column sub-menu">                
                <li class="nav-item"> <a class="nav-link" href="{{ route('berita') }}">Artikel</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('katalog') }}">S-Katalog</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/ka-pasar') }}">Ka Pasar</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/faq') }}">
              <i class="mdi mdi-comment-question-outline menu-icon"></i>
              <span class="menu-title">FAQ</span>
            </a>
          </li>
          <li class="nav-item">
            <form id="logout-form" action="{{ route('keluar') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" class="nav-link btn btn-link text-decoration-none" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="mdi mdi-logout menu-icon"></i>
                <span class="menu-title">Keluar</span>
            </a>
          </li>
        </ul>
      </nav>