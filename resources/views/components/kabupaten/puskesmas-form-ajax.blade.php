<div id="puskesmas-form-ajax" class="form-group">
    <label for="puskesmas">Nama Puskesmas :</label>
    <select class="form-control custom-select" id="puskesmas" name="puskesmas" data-show-subtext="true" data-live-search="true">
        <option selected disabled>Pilih Pukesmas</option>
    </select>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('select[id="puskesmas"]').selectpicker();
            $.ajax({
                url: '/data-ajax/puskesmas/' + {{Session::get('id_kabupaten')}},
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log(data);
                    $('select[id="puskesmas"]').append('<option></option>');
                    $.each(data, function(key, value) {
                        $('select[id="puskesmas"]').append('<option data-tokens="'+ key +'" value="'+ value +'">'+ key +'</option>');
                    });
                    $('select[id="puskesmas"]').selectpicker('refresh');
                    @if($defaultPuskesmas != null)
                    $('select[id="puskesmas"]').selectpicker('val', {{$defaultPuskesmas}});
                    $('select[id="puskesmas"]').selectpicker('refresh');
                    @endif

                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('select[id="kampung"]').selectpicker();
            $('select[id="puskesmas"]').on('change', function() {
                $('select[id="kampung"]').empty();
                var cityID = $(this).val();
                if(cityID) {
                    $.ajax({
                        url: '/data-ajax/kampung/' + cityID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            console.log(data);
                            $('select[id="kampung"]').empty();
                            $('select[id="kampung"]').append('<option></option>');
                            $.each(data, function(key, value) {
                                $('select[id="kampung"]').append('<option data-tokens="'+ key +'" value="'+ value +'">'+ key +'</option>');
                            });
                            $('select[id="kampung"]').selectpicker('refresh');
                        }
                    });
                }else{
                    $('select[id="kampung"]').empty();
                }
            });
        });
    </script>

@endpush
