<x-layout>
    <div style="height: 15vh"></div>
    @if (session('message'))
        <div class="alert w-50 mx-auto alert-danger">
            {{session('message')}}
        </div>
    @endif

    <div class="container  p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="text-center text-white mb-3">{{__('ui.yourMP')." ".__('ui.announcementsNavDrop')}}</h3>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h3 class="text-center mb-5 text-white">{{__('ui.approved')}}</h3>
        <div class="row">
            @foreach($revisedArticles as $article)
            <div class="col-12 mx-auto mx-md-0 mb-4">
                <div class="rounded-2 pb-5 articlesForm justify-content-around align-items-center row mb-5">
                    <div class="col-12 text-center my-3">
                        <h3 class="mb-2">{{$article->customTitle($article,50)}}</h5>
                    </div>
                    <div class="col-12 col-md-4 ps-5">
                        @if ($article->images->isNotEmpty())
                            <img src="{{$article->images->first()->getUrl(200,200)}}" class="img-fluid rounded-2" alt="image random">
                        @endif
                    </div>
                    <div class="col-12 col-md-6">
                       <div class="ms-3 ms-md-0 card-body">
                           <h5 class="card-subtitle mb-3">{{__('ui.price')}}: {{$article->price}} €</h5>
                            <p class="card-text">{{__('ui.details')}}: {{$article->body}}</p>
                            <p class="card-text">{{__('ui.author')}}: {{$article->user->name}}</p>
                            @foreach ($categories as $cate)
                                @if ($cate->id == $article->category_id)
                                    <p class="card-text">{{__('ui.category')}}: <a href="{{route('article.index',compact('cate'))}}">{{$article->category->name}}</a></p>
                                @endif
                            @endforeach
                            <p class="card-text">{{__('ui.createdAt')}}: {{$article->created_at}}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 d-flex justify-content-center d-md-block">
                        <div class="col-6">
                            <a href="{{route('article.show', compact('article'))}}" class="btn w-100 p-1 mb-3 btn-success">{{__('ui.show')}}</a>
                        </div>
                        <div class="col-6">
                            <a href="{{route('user.article_edit',compact('article'))}}" class="btn w-100 p-1 mb-3 btn-primary">{{__('ui.edit')}}</a>
                        </div>
                        <div class="col-6">
                            <button data-bs-toggle="modal" data-bs-target="#deleteArticle" class="btn w-100 p-1 mb-3 btn-danger">{{__('ui.delete')}}</button>
                        </div>
                        <div class="col-6">
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
                            <button type="submit" class="btn fs-3"><i class="far fa-heart ms-4"></i></button>
                            @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteArticle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{__('ui.delete')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{__('ui.modalDelete')}}
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('ui.close')}}</button>
                            <form action="{{route('user.delete',compact('article'))}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{__('ui.delete')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="container mb-5">
                <div class="row justify-content-center">
                    <div class="col-12">
                        @foreach ($revisedArticles as $article)
                            {{ $article->name }}
                        @endforeach
                    </div>
                </div>
            </div>
            {{ $revisedArticles->links() }}
        </div>
        <h3 class="text-center text-white mb-5">{{__('ui.announcementsNav')." ".__('ui.revisorAnnouncementsNav')}}</h3>
        <div class="row">
            @foreach($articles as $article)
            <div class="col-12 mx-auto mx-md-0 mb-4">
                <div class="rounded-2 pb-5 articlesForm justify-content-around align-items-center row mb-5">
                    <div class="col-12 text-center my-3">
                        <h3 class="mb-2">{{$article->customTitle($article,50)}}</h5>
                    </div>
                    <div class="col-12 col-md-4 ps-5">
                        @if ($article->images->isNotEmpty())
                            <img src="{{$article->images->first()->getUrl(200,200)}}" class="img-fluid rounded-2" alt="image random">
                        @endif
                    </div>
                    <div class="col-12 col-md-6">
                       <div class="ms-3 ms-md-0 card-body">
                           <h5 class="card-subtitle mb-3">{{__('ui.price')}}: {{$article->price}} €</h5>
                            <p class="card-text">{{__('ui.details')}}: {{$article->body}}</p>
                            <p class="card-text">{{__('ui.author')}}: {{$article->user->name}}</p>
                            @foreach ($categories as $cate)
                                @if ($cate->id == $article->category_id)
                                    <p class="card-text">{{__('ui.category')}}: <a href="{{route('article.index',compact('cate'))}}">{{$article->category->name}}</a></p>
                                @endif
                            @endforeach
                            <p class="card-text">{{__('ui.createdAt')}}: {{$article->created_at}}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 d-flex justify-content-center d-md-block">
                        <a href="{{route('article.show', compact('article'))}}" class="btn btn-primary">{{__('ui.show')}}</a>
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
        </div>





    </div>
</x-layout>
