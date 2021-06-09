<x-layout>
    <div style="height: 20vh"></div>
    @if (session('message'))
    <div class="bg-success py-3 mb-5 w-50 mx-auto text-center">
        {{session('message')}}
    </div>
    @endif
@if ($articles->count()>0)
<div class="container">
    <div class="row">
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
                    <button type="submit" class="btn fs-3"><i class="fas fa-heart ms-3"></i></button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
    
    {{-- <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-12">
                @foreach ($articles as $article)
                    {{ $article->name }}
                @endforeach
            </div>
        </div>
    </div>
    {{ $articles->links() }} --}}
    @else
    <div class="container">
        <div class="row">
            <div class="col-12 alert alert-success">
                <h3>Nessun annuncio preferito</h3>
            </div>
        </div>
    </div>
@endif
</x-layout>
