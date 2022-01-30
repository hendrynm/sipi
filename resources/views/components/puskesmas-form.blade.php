<div class="form-group">
    <label for="puskesmasForm">Puskesmas</label>
    <select required class="form-control" name="puskesmasForm">
        @foreach($puskesmas as $pus)
            <option value="{{$pus->id_puskesmas}}" {{$pus->id_puskesmas == (int)$puskesmasForm? 'selected': ''}}>{{$pus->nama_puskesmas}}</option>
        @endforeach
    </select>
</div>
