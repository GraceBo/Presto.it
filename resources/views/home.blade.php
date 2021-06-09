<x-layout>
    <div style="height: 30vh"></div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card articlesForm">
                    <div class="card-header bg-transparent border-0 fs-3">Presto</div>
                    <div class="card-body fs-5">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
