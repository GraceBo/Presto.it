<x-layout>


@if ($article)

<div style="height: 5vh"></div>
<div class="p-5">
    <div class="container-fluid p-5">
        <h2 class="mt-5 text-white">{{__('ui.title')}}: {{$article->title}}</h2>
        <div class="row justify-content-center align-items-center p-5">
            <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start mb-5" id="wrapper">
                @if ($article->images->isNotEmpty())
                    <img src="{{$article->images->first()->getUrl(500,500)}}" class="img-fluid rounded-2" alt="image random">
                @endif
            </div>
            <div class="col-12 col-md-6 p-5 articlesForm">
                <h3 class="my-3">{{__('ui.details').' '.__('ui.announcement')}}:</h3>
                <ul>
                    <li>{{__('ui.price')}}: {{$article->price}} €</li>
                    @foreach ($categories as $cate)
                        @if ($cate->id == $article->category_id)
                            <li class="card-text">{{__('ui.details')}}: <a href="{{route('article.index',compact('cate'))}}">{{$article->category->name}}</a></li>
                        @endif
                    @endforeach
                    <li>{{__('ui.author')}}: {{$article->user->name}}</li>
                </ul>
                <div class="detailsBox">
                    <p>{{__('ui.details')}}: {{$article->body}}</p>
                </div>
                <ul id="wrapperDetails">
                    @foreach($article->images as $key => $image)
                        @if($key==0)
                        <label for="spoof">Spoof</label>
                        <div style="background-color: rgba(255,255,255,0.5)" class="progress">
                            <div class="progress-bar" id="spoof" role="progressbar" style="width: {{$image->spoof}};" aria-valuenow="{{$image->spoof}}" aria-valuemin="0" aria-valuemax="100">{{$image->spoof}}</div>
                        </div>
                        <label for="medical">Medical</label>
                        <div style="background-color: rgba(255,255,255,0.5)" class="progress">
                            <div class="progress-bar" id="medical" role="progressbar" style="width: {{$image->medical}};" aria-valuenow="{{$image->medical}}" aria-valuemin="0" aria-valuemax="100">{{$image->medical}}</div>
                        </div>
                        <label for="violence">Violence</label>
                        <div style="background-color: rgba(255,255,255,0.5)" class="progress">
                            <div class="progress-bar" id="violence" role="progressbar" style="width: {{$image->violence}};" aria-valuenow="{{$image->violence}}" aria-valuemin="0" aria-valuemax="100">{{$image->violence}}</div>
                        </div>
                        <label for="adult">Adult</label>
                        <div style="background-color: rgba(255,255,255,0.5)" class="progress">
                            <div class="progress-bar" id="adult" role="progressbar" style="width: {{$image->adult}};" aria-valuenow="{{$image->adult}}" aria-valuemin="0" aria-valuemax="100">{{$image->adult}}</div>
                        </div>
                        <label for="racy">Racy</label>
                        <div style="background-color: rgba(255,255,255,0.5)" class="progress">
                            <div class="progress-bar" id="racy" role="progressbar" style="width: {{$image->racy}};" aria-valuenow="{{$image->racy}}" aria-valuemin="0" aria-valuemax="100">{{$image->racy}}</div>
                        </div>
                        <label for="racy">Labels</label>
                        <div style="background-color: rgba(255,255,255,0.5)">
                            <ul>
                            @if($image->labels)
                                @foreach ($image->labels as $label)
                                    <li>{{$label}},</li>
                                @endforeach
                            @endif
                            </ul>
                        </div>
                        @endif
                    @endforeach
                </ul>

                    @foreach ($article->images as $key => $image)
                    <div id="details{{$key}}" class="d-none">
                        <label for="spoof">Spoof</label>
                        <div style="background-color: rgba(255,255,255,0.5)" class="progress">
                            <div class="progress-bar" id="spoof" role="progressbar" style="width: {{$image->spoof}};" aria-valuenow="{{$image->spoof}}" aria-valuemin="0" aria-valuemax="100">{{$image->spoof}}</div>
                        </div>
                        <label for="medical">Medical</label>
                        <div style="background-color: rgba(255,255,255,0.5)" class="progress">
                            <div class="progress-bar" id="medical" role="progressbar" style="width: {{$image->medical}};" aria-valuenow="{{$image->medical}}" aria-valuemin="0" aria-valuemax="100">{{$image->medical}}</div>
                        </div>
                        <label for="violence">Violence</label>
                        <div style="background-color: rgba(255,255,255,0.5)" class="progress">
                            <div class="progress-bar" id="violence" role="progressbar" style="width: {{$image->violence}};" aria-valuenow="{{$image->violence}}" aria-valuemin="0" aria-valuemax="100">{{$image->violence}}</div>
                        </div>
                        <label for="adult">Adult</label>
                        <div style="background-color: rgba(255,255,255,0.5)" class="progress">
                            <div class="progress-bar" id="adult" role="progressbar" style="width: {{$image->adult}};" aria-valuenow="{{$image->adult}}" aria-valuemin="0" aria-valuemax="100">{{$image->adult}}</div>
                        </div>
                        <label for="racy">Racy</label>
                        <div style="background-color: rgba(255,255,255,0.5)" class="progress">
                            <div class="progress-bar" id="racy" role="progressbar" style="width: {{$image->racy}};" aria-valuenow="{{$image->racy}}" aria-valuemin="0" aria-valuemax="100">{{$image->racy}}</div>
                        </div>
                        <label for="racy">Labels</label>
                        <div style="background-color: rgba(255,255,255,0.5)">
                            <ul>
                                @if($image->labels)
                                    @foreach ($image->labels as $label)
                                    <li>{{$label}},</li>
                                    @endforeach
                                @endif

                            </ul>
                        </div>
                    </div>
                    @endforeach
                </ul>
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

        <div class="row mt-5">
            <div class="col-6 d-flex justify-content-center">
                <form action="{{route('revisor.rejected', compact('article'))}}" method="POST">
                @csrf
                    <button class="btn btn-danger border-dark border-3" type="submit">{{__('ui.delete')}}</button>
                </form>
            </div>

            <div class="col-6 d-flex justify-content-center">
            <form action="{{route('revisor.accepted', compact('article'))}}" method="POST">
                @csrf
                    <button class="btn btn-success border-dark border-3" type="submit">{{__('ui.accept')}}</button>
                </form>
            </div>

        </div>

    </div>
    @else
    <div class="row mt-5 justify-content-center">
        <div class="col-6 rounded-3 py-2 mt-5">
            <h2 class="bg-success text-center mt-5">{{__('ui.revisorNotWorking')}}</h2>
        </div>
    </div>
    @endif
</div>

        <script>
            let members = document.querySelectorAll(".member");
            let wrapper = document.querySelector("#wrapper");
            let wrapperDetails = document.querySelector("#wrapperDetails");

            members.forEach((member, key) => {
                member.addEventListener("click",()=>{
                    let targetDetails = document.querySelector(`#details${key}`);
                    targetDetails.classList.remove('d-none');
                    wrapperDetails.innerHTML = targetDetails.outerHTML;
                    targetDetails.classList.add('d-none');
                    let str = member.outerHTML;
                    str = str.split("200x200");
                    str = str[0]+"500x500"+str[1];
                    wrapper.innerHTML = str;
                });
            });
        </script>

</x-layout>





