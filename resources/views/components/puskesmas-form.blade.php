<div class="form-group">
    <label for="puskesmasForm">Puskesmas</label>
    <select id="puskesmasForm" required class="form-control" name="puskesmasForm">
        @foreach($puskesmas as $pus)
            <option value="{{$pus->id_puskesmas}}" {{$pus->id_puskesmas == (int)$puskesmasForm? 'selected': ''}}>{{$pus->nama_puskesmas}}</option>
        @endforeach
    </select>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('select[name="kabupatenForm"]').on('change', function() {
                var cityID = $(this).val();
                if(cityID) {
                    $.ajax({
                        url: '/data-ajax/puskesmas/' + cityID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="puskesmasForm"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="puskesmasForm"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="puskesmasForm"]').empty();
                }
            });
        });
    </script>
@endpush
