<div class="form-group {!! $errors->has('nama_identity') ? 'has-error' : '' !!}">
    <label for="nama_identity">Identitas buku</label>
    <input type="text" class="form-control" name="nama_identity" value="{{ isset($model) ? $identitas->nama_identity : '' }}">
    {!! $errors->first('nama_identity', '<p class="help-block">:message</p>') !!}
</div>

<button class="btn btn-primary">{{ isset($model) ? 'Update' : 'Simpan' }}</button>