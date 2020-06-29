@if (session('optionalMessages'))
    @foreach (session('optionalMessages') as $message)
    <div class="alert alert-danger">
        {{$message}}
    </div>
    @endforeach
@endif
