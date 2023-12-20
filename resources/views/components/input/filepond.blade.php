<div
    wire:ignore
    x-data="{ filePond: null }"
    x-init="
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.setOptions({
            allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
            credits: false,
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },
                revert: (uniqueFileId, load, error) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', uniqueFileId, load)
                },
            },
        });

        filePond = FilePond.create($refs.input, {
            acceptedFileTypes: [{{ $attributes['accepted'] }}],
            labelFileTypeNotAllowed: 'Wrong file type',
            fileValidateTypeLabelExpectedTypes: '{{ $attributes['invalidTypeError'] }}',
        });

        @this.on('notify-uploaded', (uploads) => {
            filePond.removeFiles();
        });
    "
>
    <input type="file" x-ref="input">
</div>
