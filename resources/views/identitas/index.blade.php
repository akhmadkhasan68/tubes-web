@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/identitas') }}" method="get" class="form-inline mb-3">
                <div class="form-group {!! $errors->has('q') ? 'has-error' : '' !!}">
                    <input type="text" class="form-control" placeholder="Judul Buku..." value="{{ isset($q) ? $q : null }}" name="q" />
                    {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
                </div>
                <button class="btn btn-primary">Search</button>
            </form>

            <h3>Data Identitas <small><a href="{{ route('identitas.create') }}" class="btn btn-warning btn-sm">Tambah Identitas</a></small></h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Identitas Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($identitas as $val)
                    <tr>
                        <td>{{ $val->nama_identity }}</td>
                        <td>
                            <a href="{{ route('identitas.edit', $val->id)}}" class="btn btn-warning btn-sm">Edit</a> &nbsp;
                            <form action="{{ route('identitas.destroy', $val->id) }}" class="form-inline" method="post">
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
            {{ $identitas->appends(compact('q'))->links() }}
        </div>
    </div>
</div>
@endsection
