@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/book') }}" method="get" class="form-inline mb-3">
                <div class="form-group {!! $errors->has('q') ? 'has-error' : '' !!}">
                    <input type="text" class="form-control" placeholder="Judul Buku..." value="{{ isset($q) ? $q : null }}" name="q" />
                    {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
                </div>
                <button class="btn btn-primary">Search</button>
            </form>

            <h3>Data Produk <small><a href="{{ route('book.create') }}" class="btn btn-warning btn-sm">New Book</a></small></h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Harga</th>
                        <th>ISBN</th>
                        <th>Jenis Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($book as $books)
                    <tr>
                        <td>{{ $books->title }}</td>
                        <td>{{ $books->writer }}</td>
                        <td>{{ $books->price }}</td>
                        <td>{{ !empty($books->isbn->no_isbn) ? $books->isbn->no_isbn : '-'}}</td>
                        <td>{{ $books->jenis->jenis_buku }}</td>
                        <td>
                            <a href="{{ route('book.edit', $books->id)}}" class="btn btn-warning btn-sm">Edit</a> &nbsp;
                            <form action="{{ route('book.destroy', $books->id) }}" class="form-inline" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                            </form>
                            <a href="{{ route('book.show', $books->id)}}" class="btn btn-success btn-sm">Detail</a> &nbsp;
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $book->appends(compact('q'))->links() }}
        </div>
    </div>
</div>
@endsection
