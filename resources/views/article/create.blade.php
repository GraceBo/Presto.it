<x-layout>
    <div style="height:10vh"></div>
    <div class="mt-5 pt-3">
        @if (session('message'))
            <div class="alert alert-success mt-3 py-3 text-center">
                {{session('message')}}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger mx-auto w-50 col-12 mt-2">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif
        <h3 class="mt-3 text-white text-center">Compila il form e crea il tuo annuncio</h3>
    </div>
<div class="container h-100 mb-5 p-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 p-4 articlesForm">
            <form action="{{route('article.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input 
                type="hidden" 
                name="uniqueSecret" 
                value="{{$uniqueSecret}}">
        
                <label for="category" class="form-label mb-4 fs-5">Seleziona la categoria:</label>
                <select class="form-select" name="category" id="category" aria-label="Default select example">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <div class="mb-4 mt-3">
                    <label for="title" class="form-label fs-5">Titolo:</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}" id="title" aria-describedby="title">
                </div>
                <div class="mb-4">
                    <label for="price" class="form-label fs-5">Prezzo:</label>
                    <input type="text" name="price" class="form-control" value="{{old('price')}}" id="price" aria-describedby="price">
                </div>
                <div class="mb-4">
                    <label for="body" class="form-label fs-5">Descrizione:</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{old('body')}}</textarea>
                </div>

                <div class="form-group row">
                    <label for="images" class="col-md-12 col-form-label text-md-right fs-5">Immagini</label>
                    <div class="col-md-12">

                        <div class="dropzone" id="drophere"></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-custom mt-3">Posta Annuncio</button>
            </form>
        </div>
    </div>
</div>
</x-layout>
