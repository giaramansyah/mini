<aside class="main-sidebar sidebar-light-lightblue elevation-1">
  <a href="{{ route('home') }}" class="brand-link">
    <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image"
      style="opacity: .8">
    <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-child-indent" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link {{ $activeParent == 'home' ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              {{ __('label.navigation.home') }}
            </p>
          </a>
        </li>
        @foreach (session('navigation') as $value)
          <li class="nav-item {{ $activeParent == $value['alias'] ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $activeParent == $value['alias'] ? 'active' : '' }}">
              <i class="nav-icon fas {{ $value['icon'] }}"></i>
              <p>
                {{ __('label.navigation.parent_menu.'.$value['alias']) }}
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @foreach ($value['menus'] as $val)
                <li class="nav-item">
                  <a href="{{ route($val['url']) }}" class="nav-link {{ $activeMenu == $val['alias'] ? 'active' : '' }}">
                    <i class="fas fa-diamond nav-icon"></i>
                    <p>{{ __('label.navigation.menu.'.$val['alias']) }}</p>
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endforeach
      </ul>
    </nav>
  </div>
</aside>