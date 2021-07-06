@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Edit {{ $identitas->title }}</h3>
            <form action="{{ route('identitas.update', $identitas->id) }}" method="post">
                @csrf
                @method('patch')
                @include('identitas._form', ['model' => $identitas])
            </form>
        </div>
    </div>
</div>
@endsection
