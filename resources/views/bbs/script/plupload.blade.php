<link type="text/css" rel="stylesheet" href="{{ asset('/assets/script/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css')}}" />
<script type="text/javascript" src="{{ asset('/assets/script/plupload/2.3.6/plupload.full.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/script/plupload/2.3.6/i18n/ko.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/script/plupload/2.3.6/jquery.plupload.queue/jquery.plupload.queue.min.js') }}"></script>

<script>
    $(function(){
        $('#plupload').pluploadQueue({
            runtimes : 'html5,flash',
            flash_swf_url : '/script/Moxie.swf',
            silverlight_xap_url : '/script/Moxie.xap',
            url : '{{ route('file.upload', ['path' => $bbs_name, 'imsi' => $imsi]) }}',
            dragdrop: true,
            headers: {
                Accept: 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            filters : {
                max_file_size : '20mb'
            },
            init: {
                PostInit: function(up) {
                    $(up.getOption('container')).find('.plupload_button.plupload_start').hide();
                },
                Error: function (up, err) {
                    if (err.code === plupload.HTTP_ERROR) {
                        up.stop();
                        alert('파일 업로드 에러 - ' + err.message);
                    }
                },
                FileUploaded: function (up, file, info) {
                    var data = JSON.parse(info.response);

                    if (data.stored_path !== undefined) {
                        var file_index = $('#' + file.id).index();
                        $('#plupload').append('<input type="hidden" name="plupload_' + file_index + '_stored_path" value="' + data.stored_path + '" />');
                    }

                }
            }
        });

    })
</script>