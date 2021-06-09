<x-layout>
    <div style="height: 10vh"></div>
    <div class="container mt-5">
        <div class="content-section-heading text-center">
            <h3 class="my-5 text-white">{{__('ui.searchResults')}}: {{$q}}</h3>
        </div>
        <div class="row">
            @if ($articles->count()>0)
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
                                        <p class="card-text">{{__('ui.category')}}: <a href="{{route('article.index',compact('cate'))}}">{{$article->category->name}}</a></p>
                                    @endif
                                @endforeach
                                <p class="card-text">{{__('ui.createdAt')}}: {{$article->created_at}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 d-flex justify-content-center d-md-block">
                            <a href="{{route('article.show', compact('article'))}}" class="btn btn-primary">{{__('ui.show')}}</a>
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
                <div class="col-12">
                    {{ $articles->links() }}
                </div>
            @else
            <h3>no result</h3>
            @endif
        </div>
    </div>


</x-layout>
