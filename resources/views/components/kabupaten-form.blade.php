<div class="form-group">
    <label for="kabupatenForm">Kabupaten</label>
    <select required class="form-control" name="kabupatenForm">
        @foreach($kabupatens as $kab)
            <option value="{{$kab->id_kabupaten}}" {{$kab->id_kabupaten == (int)$kabupatenForm? 'selected': ''}}>{{$kab->nama_kabupaten}}</option>
        @endforeach
    </select>
</div>
