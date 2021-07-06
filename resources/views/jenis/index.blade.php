@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/jenis') }}" method="get" class="form-inline mb-3">
                <div class="form-group {!! $errors->has('q') ? 'has-error' : '' !!}">
                    <input type="text" class="form-control" placeholder="Nama Jenis Buku..." value="{{ isset($q) ? $q : null }}" name="q" />
                    {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
                </div>
                <button class="btn btn-primary">Search</button>
            </form>

            <h3>Data Jenis <small><a href="{{ route('jenis.create') }}" class="btn btn-warning btn-sm">Tambah Jenis</a></small></h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Jenis Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jenis as $val)
                    <tr>
                        <td>{{ $val->jenis_buku }}</td>
                        <td>
                            <a href="{{ route('jenis.edit', $val->id)}}" class="btn btn-warning btn-sm">Edit</a> &nbsp;
                            <form action="{{ route('jenis.destroy', $val->id) }}" class="form-inline" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $jenis->appends(compact('q'))->links() }}
        </div>
    </div>
</div>
@endsection
