<div class="form-group">
    <label for="tahunForm">Tahun</label>
    <select required class="form-control" name="tahunForm">
        <option value="{{date('Y') - 2}}" {{$tahunForm == date('Y') - 2 ? 'selected' : '' }}>{{date('Y') - 2}}</option>
        <option value="{{date('Y') - 1}}" {{$tahunForm == date('Y') - 1 ? 'selected' : '' }}>{{date('Y') - 1}}</option>
        <option value="{{date('Y')}}" {{$tahunForm == date('Y') ? 'selected' : '' }}>{{date('Y')}}</option>
    </select>
</div>
