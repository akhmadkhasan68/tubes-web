@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Edit {{ $jenis->title }}</h3>
            <form action="{{ route('jenis.update', $jenis->id) }}" method="post">
                @csrf
                @method('patch')
                @include('jenis._form', ['model' => $jenis])
            </form>
        </div>
    </div>
</div>
@endsection
