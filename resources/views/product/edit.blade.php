@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Edit {{ $book->title }}</h3>
            <form action="{{ route('book.update', $book->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                @include('product._form', ['model' => $book])
            </form>
        </div>
    </div>
</div>
@endsection
