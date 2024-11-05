@extends("layouts.app")

@section("title", "Dashboard | " . config("app.name"))
@section("meta_description", "")


@push("css")
    {{-- code here --}}
@endpush

@section("content")
    <div class="card p-2">
        <h3>Blank Dashboard 2</h3>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, atque aperiam itaque voluptate veniam suscipit consectetur doloremque tempore minus, voluptas obcaecati, earum tempor. </p>
    </div>
@endsection


@push("javascript")
    {{-- code here --}}
@endpush
