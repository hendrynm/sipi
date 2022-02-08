<div id="kabupaten-form-ajax" class="form-group">
    <label for="kabupaten">Kabupaten</label>
    <select id="kabupaten" required class="form-control custom-select" data-show-subtext="true" data-live-search="true" name="kabupaten">
        <option disabled selected>Pilih Kabupaten</option>
    </select>
</div>

@push('scripts')
    <script>
        $(function() {
            $('select[id="kabupaten"]').selectpicker();
        });

        $(document).ready(function() {
            $('select[id="kabupaten"]').selectpicker();
            $('select[id="kabupaten"]').empty();
            $.ajax({
                url: '/data-ajax/get-kabupaten/' + {{Session::get('id_kabupaten')}},
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log(data);
                    $('select[id="kabupaten"]').empty();
                    $('select[id="kabupaten"]').append('<option></option>');
                    $.each(data, function(key, value) {
                        $('select[id="kabupaten"]').append('<option data-tokens="'+ key +'" value="'+ value +'">'+ key +'</option>');
                    });
                    $('select[id="kabupaten"]').selectpicker('refresh');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('select[id="puskesmas"]').selectpicker();
            $('select[id="kabupaten"]').on('change', function() {
                $('select[id="puskesmas"]').empty();
                var cityID = $(this).val();
                if(cityID) {
                    $.ajax({
                        url: '/data-ajax/puskesmas/' + cityID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            console.log(data);
                            $('select[id="puskesmas"]').empty();
                            $('select[id="puskesmas"]').append('<option></option>');
                            $.each(data, function(key, value) {
                                $('select[id="puskesmas"]').append('<option data-tokens="'+ key +'" value="'+ value +'">'+ key +'</option>');
                            });
                            $('select[id="puskesmas"]').selectpicker('refresh');
                        }
                    });
                }else{
                    $('select[id="puskesmas"]').empty();
                }
            });
        });
    </script>

@endpush
