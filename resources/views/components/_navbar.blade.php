<nav class="navbar navbar-expand-lg navbar-light p-0 navbarBg fixed-top">
  <div class="container-fluid">

      <a href="{{route('homepage')}}"><img src="/img/logo.png" class="w-50 img-fluid" alt="logo"></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
            <li class="nav-item">
                <a class="nav-link fs-5 active" aria-current="page" href="{{route('homepage')}}">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link fs-5 active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{__('ui.announcementsNavDrop')}}
                </a>
                <ul class="dropdown-menu bg-custom border-0" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item text-custom" href="{{route('article.index')}}">{{__('ui.announcementsNav')}}</a>
                    </li>
                    <li>
                        <a class="dropdown-item text-custom" href="{{route('article.create')}}">{{__('ui.announcementsNavCreate')}}</a>
                    </li>
                </ul>
            </li>
          @if (Auth::user() && !Auth::user()->revisor_flag)
              <li class="nav-item">
                <a class="nav-link fs-5 active" aria-current="page" href="{{route('contact.index')}}">{{__('ui.workWithUs')}}</a>
              </li>
          @elseif (Auth::user() && Auth::user()->revisor_flag)
              <li class="nav-item dropdown">
                  <a class="nav-link active fs-5 dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{__('ui.revisorNav')}}
                    @if(App\Models\Article::notifyArticlesForRevisor() > 0)
                      <button class="rounded-circle bg-danger p-1 ms-2 border-0"></button>
                    @endif
                  </a>
                  <ul class="dropdown-menu bg-custom border-0" aria-labelledby="navbarDropdown">
                      <li>
                          <a class="dropdown-item text-custom" aria-current="page" href="{{route('revisor.index')}}">{{__('ui.revisorAnnouncementsNav')}} <button class="bg-danger p-1 border-0">{{App\Models\Article::notifyArticlesForRevisor()}}</button></a>
                      </li>
                      <li>
                          <a class="dropdown-item text-custom" href="{{route('revisor.bin')}}">{{__('ui.binNav')}}</a>
                      </li>
                  </ul>
              </li>
          @endif
        </ul>

        <ul class="navbar-nav mx-auto d-flex align-items-center">
            <li class="nav-item  dropdown">
                <a class="nav-link fs-5 active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{__('ui.categories')}}
                </a>
                <ul class="dropdown-menu border-0" aria-labelledby="navbarDropdown">
                    @foreach ($categories as $cate)
                    <li>
                        <a href="{{route('article.index', compact('cate'))}}" class="dropdown-item text-custom my-1 fs-6 btn text-center text-decoration-none">{{$cate->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <form action="{{route('search_results')}}" class="input-group h-75" method="GET">
                    <input type="search" id="search" name="q" class="form-control">
                    <button class="btn btn-custom text-center" type="submit">{{__('ui.searchButton')}}</button>
                </form>
            </li>
        </ul>

        <ul class="navbar-nav me-3">
            <li class="nav-item">
                <x-_locale lang="it" nation="it" />
            </li>
            <li class="nav-item">
                <x-_locale lang="en" nation="gb"/>
            </li>
            <li class="nav-item">
                <x-_locale lang="es" nation="es"/>
            </li>
            @guest
                @if (Route::has('login'))
                    <li class="nav-item d-flex justify-content-center">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('ui.login') }}</a>
                    </li>
                @endif
                @if (Route::has('register'))
                    <li class="nav-item d-flex justify-content-center">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('ui.register') }}</a>
                    </li>
                @endif
            @else
            <li class="nav-item dropdown dropstart">
                <a id="navbarDropdown" class="btn active pt-0 fs-5 dropdown-lg-toggle nav-link d-flex justify-content-center align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                    <i class="fas fa-user ms-2"></i>
                </a>
                <ul class="dropdown-menu me-lg-3 bg-custom border-0">
                    <li class="dropdown-item">
                        <a class="text-center p-0 ps-2 text-decoration-none text-custom" href="{{route('user.panel')}}">{{__('ui.profileNav')}}</a>
                    </li>
                    <li class="dropdown-item">
                        <a class="text-center p-0 ps-2 text-decoration-none text-custom" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            {{ __('ui.logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul>
            </li>
            @endguest
        </ul>
    </div>
  </div>
</nav>

