@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Tambah Identitas Buku</h3>
            <form method="post" action="{{ route('identitas.store') }}">
                @csrf
                @include('identitas._form')
            </form>
        </div>
    </div>
</div>
@endsection
