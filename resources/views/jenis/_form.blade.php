<div class="form-group {!! $errors->has('jenis_buku') ? 'has-error' : '' !!}">
    <label for="jenis_buku">Jenis buku</label>
    <input type="text" class="form-control" name="jenis_buku" value="{{ isset($model) ? $jenis->jenis_buku : '' }}">
    {!! $errors->first('jenis_buku', '<p class="help-block">:message</p>') !!}
</div>

<button class="btn btn-primary">{{ isset($model) ? 'Update' : 'Simpan' }}</button>