<div class="form-group">
    <label for="kabupatenForm">Kabupaten</label>
    <select id="kabupatenForm" required class="form-control custom-select" data-show-subtext="true" data-live-search="true" name="kabupatenForm">
        @foreach($kabupatens as $kab)
            <option value="{{$kab->id_kabupaten}}" {{$kab->id_kabupaten == (int)$kabupatenForm? 'selected': ''}}>{{$kab->nama_kabupaten}}</option>
        @endforeach
    </select>
</div>

@push('scripts')
    <script>
        $(function() {
            $('select[id="kabupatenForm"]').append('<option></option>');
            $('select[id="kabupatenForm"]').selectpicker();
            $('select[id="kabupatenForm"]').selectpicker('refresh');
        });
    </script>
@endpush
