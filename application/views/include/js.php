<script>
    function callAjaxUser(ddName, urlData, boolMult) {
        ddName.select2({
            allowClear: true,
            placeholder: 'Pilih..',
            minimumInputLength: 1,
            multiple: boolMult,
            ajax: {
                url: urlData,
                type: 'GET',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.initial,
                                text: item.initial
                            }
                        })
                    };
                },
                cache: true
            }
        });
    }
</script>