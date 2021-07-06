<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
    <label for="title">Judul buku</label>
    <input type="text" class="form-control" name="title" value="{{ isset($model) ? $book->title : '' }}">
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {!! $errors->has('id_jenis') ? 'has-error' : '' !!}">
    <label for="id_jenis">Jenis Buku</label>
    @if(count($dataJenisBuku)>0)   
    <select name="id_jenis" id="id_jenis" class="form-control">
        <option value="">Pilih Kategori</option>
        @foreach($dataJenisBuku as $jenis)
            <option value="{{ $jenis->id }}" {{ isset($model) && $book->id_jenis == $jenis->id ? 'selected' : '' }}>{{ $jenis->jenis_buku }}</option>
        @endforeach
    </select>
    @else
    <p>tidak ada pilihan Kategori</p>
    @endif

    {!! $errors->first('id_jenis', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {!! $errors->has('id_jenis') ? 'has-error' : '' !!}">
    <label for="identity">Identitas Buku</label>
    @if(count($list_identity)>0)   
        @foreach($list_identity as $identity)
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="identity[]" value="{{ $identity->id }}" @if(isset($model)) @if(in_array($identity->id, $book->getIdentityBookAttribute())) checked @endif @endif>
                    {{ $identity->nama_identity }}
                </label>
            </div>
        @endforeach
    @else
    <p>tidak ada pilihan Kategori</p>
    @endif

    {!! $errors->first('identity', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {!! $errors->has('writer') ? 'has-error' : '' !!}">
    <label for="writer">Penulis</label>
    <input type="text" class="form-control" name="writer" value="{{ isset($model) ? $book->writer : '' }}">
    {!! $errors->first('writer', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {!! $errors->has('summary') ? 'has-error' : '' !!}">
    <label for="summary">Ringkasan</label>
    <textarea name="summary" id="summary" cols="30" rows="10" class="form-control">{{ isset($model) ? $book->summary : '' }}</textarea>
    {!! $errors->first('summary', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {!! $errors->has('price') ? 'has-error' : '' !!}">
    <label for="price">Harga</label>
    <input type="text" class="form-control" name="price" value="{{ isset($model) ? $book->price : '' }}">
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {!! $errors->has('price') ? 'has-error' : '' !!}">
    <label for="isbn">ISBN</label>
    <input type="text" class="form-control" name="no_isbn" value="{{ isset($model) ? $book->isbn->no_isbn : '' }}">
    {!! $errors->first('isbn', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {!! $errors->has('price') ? 'has-error' : '' !!}">
    <label for="photo">Gambar Produk (jpg, png) {{ isset($model) ? '*kosongi jika tidak ingin merubah' : '' }}</label>
    <input type="file" class="form-control" name="photo">
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}

    @if (isset($model) && $model->photo !== '')
    <div class="row">
        <div class="col-md-6">
            <p>Current photo:</p>
            <div class="thumbnail">
                <img src="{{ url('/img/' . $model->photo) }}" class="img-rounded">
            </div>
        </div>
        </div>
    </div>
    @endif

<button class="btn btn-primary">{{ isset($model) ? 'Update' : 'Simpan' }}</button>
