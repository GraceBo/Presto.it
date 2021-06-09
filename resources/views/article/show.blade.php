<x-layout>
    <div style="height: 10vh"></div>
    <div class="container-fluid" style="padding: 10rem">
        <div class="row justify-content-center align-items-center mb-5">
            <div class="col-12 mt-1 d-flex justify-content-center d-lg-block col-lg-6 mb-5" id="wrapper">
                <img class="img-fluid" src="{{$article->images->first()->getUrl(500,500)}}" alt="image random">
            </div>
            <div class="col-12 col-lg-4 articlesForm rounded-3 mb-5">
                <div class="p-5">
                    <div class="row">
                        <div class="col-10">
                            <h3 class="mb-5">{{$article->title}}</h3>
                        </div>
                        <div class="col-2">
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
                    <ul>
                        <dd class="fs-5">{{__('ui.price')}}: {{$article->price}} €</dd>
                        @foreach ($categories as $cate)
                            @if ($cate->id == $article->category_id)
                                <dd class="card-text fs-5">Categoria: <a class="text-decoration-none text-custom" href="{{route('article.index',compact('cate'))}}">{{$article->category->name}}</a></dd>
                            @endif
                        @endforeach
                        <dd class="fs-5">{{__('ui.author')}}: {{$article->user->name}}</dd>
                    </ul>
                    <h5 class="mt-5 text-center mb-3">{{__('ui.detail')}}</h5>
                    <div class="articlesForm rounded-3 p-3 detailsBox">
                        <p>{{$article->body}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="staffWrapper" class="row justify-content-around mt-5">

            @foreach ($article->images as $image)
                <div class="col-md-2 col-sm-6 mb-4 d-flex justify-content-center">
                    <a>
                        <img class="member img-fluid" src="{{$image->getUrl(200,200)}}" alt="">
                    </a>
                </div>
            @endforeach
        </div>
    </div>

        <script>
            let members = document.querySelectorAll(".member");
            let wrapper = document.querySelector("#wrapper");

            members.forEach(member => {
                member.addEventListener("click",()=>{
                    let str = member.outerHTML;
                    str = str.split("200x200");
                    str = str[0]+"500x500"+str[1];
                    wrapper.innerHTML = str;
                });
            });
        </script>

</x-layout>
