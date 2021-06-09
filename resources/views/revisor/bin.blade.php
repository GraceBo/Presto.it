<x-layout>
    <div style="height: 15vh"></div>
    @if (session('message'))
        <div class="alert mx-auto w-50 alert-danger">
            {{session('message')}}
        </div>
    @endif

    @if($articles->count()>0)
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
                        <img src="https://picsum.photos/200" class="img-fluid" alt="image random">
                    @endif
                </div>
                <div class="col-12 col-md-6">
                   <div class="ms-3 ms-md-0 card-body">
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
                    <div class="d-flex justify-content-center">
                        <a href="{{route('article.show', compact('article'))}}" class="btn btn-custom">{{__('ui.show')}}</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <form action="{{route('revisor.undo', compact('article'))}}" class="m-0" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success mt-3 ">{{__('ui.undo')}}</button>
                        </form>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button data-bs-toggle="modal" data-bs-target="#deleteArticle" class="btn btn-danger mt-3">{{__('ui.delete')}}</button>
                    </div>
                </div>
                
            </div>
        </div>
            <!-- Modal -->
           
            <div class="modal fade" id="deleteArticle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{__('ui.delete')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{__('ui.areYouSureToDelete')}}
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('ui.close')}}</button>

                            <form action="{{route('revisor.delete', compact('article'))}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" data-bs-toggle="modal" data-bs-target="#deleteArticle" class="btn btn-danger">{{__('ui.delete')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
    @else
    <div class="alert mx-auto w-50 alert-success">
        No article in the bin
    </div>
    @endif

</x-layout>
