@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Tambah Produk Buku</h3>
            <form method="post" action="{{ route('book.store') }}" enctype="multipart/form-data">
                @csrf
                @include('product._form')
            </form>
        </div>
    </div>
</div>
@endsection
