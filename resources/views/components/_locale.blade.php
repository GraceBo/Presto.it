<form action="{{route('locale', $lang)}}" method="POST">
@csrf
    <button class="nav-link bg-transparent border-0" type="submit">
        <span class="flag-icon flag-icon-{{$nation}}"></span>
    </button>
</form>
