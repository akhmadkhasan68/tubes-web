@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Tambah Jenis Buku</h3>
            <form method="post" action="{{ route('jenis.store') }}">
                @csrf
                @include('jenis._form')
            </form>
        </div>
    </div>
</div>
@endsection
