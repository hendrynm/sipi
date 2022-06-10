<div class="form-group">
    <label for="puskesmasForm">Puskesmas</label>
    <select id="puskesmasForm" required class="form-control custom-select" data-show-subtext="true"
            data-live-search="true" name="puskesmasForm">
        @foreach($puskesmas as $pus)
            <option value="{{$pus->id_puskesmas}}" {{$pus->id_puskesmas == (int)$puskesmasForm? 'selected': ''}}>{{$pus->nama_puskesmas}}</option>
        @endforeach
    </select>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('select[name="puskesmasForm"]').selectpicker();
            $('select[name="kabupatenForm"]').on('change', function() {
                $('select[name="puskesmasForm"]').empty();
                var cityID = $(this).val();
                if(cityID) {
                    $.ajax({
                        url: '/data-ajax/puskesmas/' + cityID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="puskesmasForm"]').empty();
                            $('select[id="puskesmasForm"]').append('<option></option>');
                            $.each(data, function(key, value) {
                                $('select[name="puskesmasForm"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                            $('select[name="puskesmasForm"]').selectpicker('refresh');
                        }
                    });
                }else{
                    $('select[name="puskesmasForm"]').empty();
                }
            });
        });
    </script>
@endpush
