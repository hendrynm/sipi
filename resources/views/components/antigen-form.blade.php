<div class="form-group">
    <label for="antigenForm">Kabupaten</label>
    <select required class="form-control" name="antigenForm">
        @foreach($antigens as $anti)
            <option value="{{$anti->id_antigen}}" {{$anti->id_antigen == (int)$antigenForm? 'selected': ''}}>{{$anti->nama_antigen}}</option>
        @endforeach
    </select>
</div>
