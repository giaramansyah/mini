<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link px-2" data-toggle="dropdown" href="#">
        {{ Auth::user()->fullname }}
        <i class="fas fa-user"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="{{ route('account') }}" class="dropdown-item">
          {{ __('label.navigation.account') }}
        </a>
        <a href="{{ route('auth.out') }}" class="dropdown-item">
          {{ __('label.navigation.logout') }}
        </a>
      </div>
    </li>
		<li class="nav-item">
			<a class="nav-link px-2" href="{{ route('auth.out') }}" title="{{ __('label.navigation.logout') }}">
				<i class="fas fa-power-off text-danger"></i>
			</a>
    </li>
    <li class="nav-item">
      <div class="nav-link px-2">
        <div class="btn-group">
          @foreach ($languagesArr as $value)
            <button type="button" class="btn btn-xs btn-lazy-control btn-outline-primary btn-sm {{ $value['active'] }}"
              title="{{ $value['title'] }}" data-action="{{ route('locale.index', ['id' => $value['code']]) }}">
              {{ $value['label'] }}
            </button>
          @endforeach
        </div>
      </div>
    </li>
  </ul>
</nav>
