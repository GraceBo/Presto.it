<header>
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
      <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
      <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
      <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <!-- Slide One - Set the background image for this slide in the line below -->
      <div class="carousel-item active gradientSlide1">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
      <!-- Slide Two - Set the background image for this slide in the line below -->
      <div class="carousel-item gradientSlide2">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
      <!-- Slide Three - Set the background image for this slide in the line below -->
      <div class="carousel-item gradientSlide3">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
    </div>
  </div>
</header>

<div class="container-fluid articlesForm p-5 rounded-3 animate__animated animate__fadeInDownBig" id="searchBar">
  <div class="row">
    <div class="col-12 p-0">
      <h2 class="display-4 text-black">{{__('ui.welcome')}}</h2>
      <p class="lead text-black">{{__('ui.subWelcome')}}</p>
      <form action="{{route('search_results')}}" class="input-group" method="GET">
        <input type="search" id="search" name="q" class="form-control">
        <button class="btn btn-custom px-md-5" type="submit">{{__('ui.searchButton')}}</button>
      </form>
    </div>
  </div>
</div>
