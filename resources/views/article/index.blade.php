<x-layout>
<div class="container my-5 p-5">
    <div class="row mt-5">
        <div class="col-12 text-center">
            <h3 class="text-center text-white fs-2 mb-5">{{__('ui.chooseCategory')}}</h3>
            <div class="justify-content-center row">
                @foreach ($categories as $cate)
                    <div class="col-lg-4 p-0 col-md-4 col-6 d-flex justify-content-around">
                        <a href="{{route('article.index', compact('cate'))}}" style="width: 120px" class="text-custom articlesForm my-1 fs-6 btn text-center text-decoration-none">{{$cate->name}}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="container mt-5" style="height: 70vh">
    <div class="row">
        @if($category->id)
            <div class="col-12"><h3 class="text-center fs-2 text-white mb-5">{{__('ui.hereThereAre')}} {{__('ui.announcements')}} {{__('ui.ofFS')}} {{__('ui.category')}} {{$category->name}}</h3></div>
        @foreach($articles_category as $article)
        <div class="col-12 mx-auto mx-md-0 mb-4">
            <div class="rounded-2 pb-5 articlesForm justify-content-around align-items-center row mb-5">
                <div class="col-12 text-center my-3">
                    <h3 class="mb-2">{{$article->customTitle($article,50)}}</h5>
                </div>
                <div class="col-12 col-md-4 ps-5">
                    @if ($article->images->count()>0)
                        <img src="{{$article->images->first()->getUrl(200,200)}}" class="img-fluid" alt="image random">
                    @else
                        <img src="https://picsum.photos/200" class="card-img-top" alt="image random">
                    @endif
                </div>
                <div class="col-12 col-md-6">
                   <div class="ms-3 ms-md-0 card-body">
                       <h5 class="card-subtitle mb-3">{{__('ui.price')}}: {{$article->price}} €</h5>
                        <p class="card-text">{{__('ui.details')}}: {{$article->body}}</p>
                        <p class="card-text">{{__('ui.author')}}: {{$article->user->name}}</p>
                        @foreach ($categories as $cate)
                            @if ($cate->id == $article->category_id)
                                <p class="card-text">{{__('ui.category')}}: <a class="text-custom text-decoration-none" href="{{route('article.index',compact('cate'))}}">{{$article->category->name}}</a></p>
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
        <div class="container mb-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    @foreach ($articles_category as $article)
                        {{ $article->name }}
                    @endforeach
                </div>
            </div>
        </div>
        {{ $articles_category->links() }}
        @else
        <div class="col-12">
            <h3 class="text-center text-white mb-5">{{__('ui.allAnnouncements')}}</h3>
        </div>
            @foreach($articles as $article)
            <div class="col-12 mx-auto mx-md-0 mb-4">
                <div class="rounded-2 pb-5 articlesForm justify-content-around align-items-center row mb-5">
                    <div class="col-12 text-center my-3">
                        <h3 class="mb-2">{{$article->customTitle($article,50)}}</h5>
                    </div>
                    <div class="col-12 col-md-4 ps-5">
                        @if ($article->images->count()>0)
                            <img src="{{$article->images->first()->getUrl(200,200)}}" class="img-fluid" alt="image random">
                        @else
                            <img src="https://picsum.photos/200" class="card-img-top" alt="image random">
                        @endif
                    </div>
                    <div class="col-12 col-md-6">
                       <div class="ms-3 ms-md-0 card-body">
                           <h5 class="card-subtitle mb-3">{{__('ui.price')}}: {{$article->price}} €</h5>
                            <p class="card-text">{{__('ui.details')}}: {{$article->body}}</p>
                            <p class="card-text">{{__('ui.author')}}: {{$article->user->name}}</p>
                            @foreach ($categories as $cate)
                                @if ($cate->id == $article->category_id)
                                    <p class="card-text">{{__('ui.category')}}: <a class="text-custom text-decoration-none" href="{{route('article.index',compact('cate'))}}">{{$article->category->name}}</a></p>
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
            <div class="container mb-5">
                <div class="row justify-content-center">
                    <div class="col-12">
                        @foreach ($articles as $article)
                            {{ $article->name }}
                        @endforeach
                    </div>
                </div>
            </div>
            {{ $articles->links() }}
            <div class="mt-5" style="height: 10vh"></div>
        @endif
    </div>


</div>

</x-layout>
