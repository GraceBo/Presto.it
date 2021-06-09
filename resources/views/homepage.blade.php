<x-layout>

    @if(session('access.denied.revisor.only'))
        <div class="alert alert-danger">
           {{__('ui.revisorAlert')}}
        </div>
    @endif

    <x-_above />


        <x-_history />


    <div class="container h-100 mt-5">
        <h3 class="fs-2 mt-5 text-center text-white mb-5">{{__('ui.fiveAnnouncements')}}</h3>
        <div class="row w-75 mx-auto justify-content-center justify-content-lg-none">
            @foreach($articles_home as $article)
                <div class="col-12 mx-auto mx-md-0 mb-4">
                    <div class="rounded-2 pb-5 articlesForm justify-content-around align-items-center row mb-5">
                        <div class="col-12 text-center my-3">
                            <h3 class="mb-2">{{$article->customTitle($article,50)}}</h5>
                        </div>
                        <div class="col-12 col-md-4 ps-lg-5 d-flex justify-content-center">
                            @if ($article->images->isNotEmpty())
                                <img src="{{$article->images->first()->getUrl(200,200)}}" class="img-fluid rounded-2" alt="image random">
                            @endif
                        </div>
                        <div class="col-12 col-md-6 d-flex justify-content-center">
                           <div class=" ms-md-0 card-body text-center">
                               <h5 class="card-subtitle mb-3">{{__('ui.price')}}: {{$article->price}} €</h5>
                                <p class="card-text">{{__('ui.details')}}: {{$article->body}}</p>
                                <p class="card-text">{{__('ui.author')}}: {{$article->user->name}}</p>
                                @foreach ($categories as $cate)
                                    @if ($cate->id == $article->category_id)
                                        <p class="card-text">{{__('ui.category')}}: <a class="text-decoration-none text-custom" href="{{route('article.index',compact('cate'))}}">{{$article->category->name}}</a></p>
                                    @endif
                                @endforeach
                                <p class="card-text">{{__('ui.createdAt')}}: {{$article->created_at}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 d-flex justify-content-center d-md-block">
                            <a href="{{route('article.show', compact('article'))}}" class="btn btn-custom">{{__('ui.show')}}</a>
                            <form action="{{route('article.preferite', compact('article'))}}" method="POST">
                                @csrf
                               <input type="hidden" name="preferite" value=true>
                               @if ($article->preferite->isNotEmpty())
    
                               @foreach ($article->preferite as $preferite)
                                    @if($preferite->pivot->article_id==$article->id)
                                    <button type="submit" class="btn fs-3"><i class="fas fa-heart ms-3"></i></button>
                                    @else
                                    <button type="submit" class="btn fs-3"><i class="far fa-heart ms-3"></i></button>
                                    @endif
                               @endforeach
                               @else
                               <button type="submit" class="btn fs-3"><i class="far fa-heart ms-3"></i></button>
                               @endif
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
