<x-layout>
    <div style="height: 10vh"></div>
    @if (session('message'))
        <div class="bg-primary py-3 text-center">
            {{session('message')}}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger col-12 mt-2">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
    @endif
    <h3 class="mt-5 text-center">{{__('ui.delete')." ".__('ui.yourMS')." ".__('ui.announcements')}}</h3>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 p-3 articlesForm">
            <form action="{{route('user.update',compact('article'))}}" method="POST">
                @csrf
                @method('PUT')
                <input 
                type="hidden" 
                name="uniqueSecret" 
                value="{{$uniqueSecret}}">
                <label for="category" class="form-label">Seleziona la categoria:</label>
                <select class="form-select" name="category" id="category" aria-label="Default select example">
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <div class="mb-3 mt-3">
                    <label for="title" class="form-label">{{__('ui.title')}}:</label>
                    <input type="text" name="title" class="form-control" value="{{$article->title}}" id="title" aria-describedby="title">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo:</label>
                    <input type="text" name="price" class="form-control" value="{{$article->price}}" id="price" aria-describedby="price">
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Descrizione:</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{$article->body}}</textarea>
                </div>
                <div class="form-group row">
                    <label for="images" class="col-md-12 col-form-label text-md-right">Immagini</label>
                    <div class="col-md-12">

                        <div class="dropzone" id="drophere"></div>
                    </div>
                </div>
                <button type="submit" class="mt-3 btn btn-custom">Conferma modifiche</button>
            </form>
            <div class="row mt-5">
                @if ($article->images->count()>1)  
                    @foreach ($article->images as $image)    
                        <div class="col-md-2 col-sm-6 mb-4 d-flex justify-content-center">
                            
                            <form action="{{route('article.deleteImage',compact('image'))}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <img class="member img-fluid" src="{{$image->getUrl(200,200)}}" alt="">
                                <button type="submit" class="btn btn-danger">Cancella</button>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
</x-layout>
