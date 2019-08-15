@push('js-plugin')
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

<script>
$(document).ready(function(){
    $('.lfm').filemanager('file');
});
</script>
@endpush