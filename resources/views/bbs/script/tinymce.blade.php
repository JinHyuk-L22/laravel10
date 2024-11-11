<script type="text/javascript" src="{{ asset('/assets/script/tinymce/tinymce.min.js') }}" charset="utf-8"></script>
<script>
    $(function(){
        const tinymce_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/common/tinyUpload');

            xhr.upload.onprogress = (e) => {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = () => {
                if (xhr.status === 403) {
                    reject({message: 'HTTP Error: ' + xhr.status, remove: true});
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    reject('HTTP Error: ' + xhr.status);
                    return;
                }

                const json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    reject('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                resolve(json.location);
            };

            xhr.onerror = () => {
                reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            formData.append('_token', $('meta[name=csrf-token]').attr('content'));

            xhr.send(formData);
        });

        tinymce.init({
            promotion: false,
            selector: '.tinymce', // 에디터 사용 클래스
            language: 'ko_KR',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            image_class_list: [
                {title: 'img-responsive', value: 'img-responsive'},
            ],
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            images_upload_handler: tinymce_image_upload_handler,
            file_picker_callback: function (cb, value, meta) {
                let input = document.createElement('input');

                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function () {
                    const file = this.files[0];
                    const reader = new FileReader();

                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        const id = 'blobid' + moment().valueOf();
                        let blobCache = tinymce.activeEditor.editorUpload.blobCache;

                        const base64 = reader.result.split(',')[1];
                        const blobInfo = blobCache.create(id, file, base64);

                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), {title: file.name});
                    };
                };

                input.click();
            },
            setup: function(editor) {

            }
        });

    })
</script>