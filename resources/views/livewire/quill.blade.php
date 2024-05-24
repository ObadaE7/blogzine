<div>
    <div wire:ignore id="toolbar-container-{{ $quillId }}">
        <span class="ql-formats">
            <select class="ql-font"></select>
            <select class="ql-size"></select>
        </span>
        <span class="ql-formats">
            <button class="ql-bold"></button>
            <button class="ql-italic"></button>
            <button class="ql-underline"></button>
            <button class="ql-strike"></button>
        </span>
        <span class="ql-formats">
            <select class="ql-color"></select>
            <select class="ql-background"></select>
        </span>
        <span class="ql-formats">
            <button class="ql-script" value="sub"></button>
            <button class="ql-script" value="super"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-header" value="1"></button>
            <button class="ql-header" value="2"></button>
            <button class="ql-blockquote"></button>
            <button class="ql-code-block"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
            <button class="ql-indent" value="-1"></button>
            <button class="ql-indent" value="+1"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-direction" value="rtl"></button>
            <select class="ql-align"></select>
        </span>
        <span class="ql-formats">
            <button class="ql-link"></button>
            <button class="ql-image"></button>
            <button class="ql-video"></button>
            <button class="ql-formula"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-clean"></button>
        </span>
    </div>

    <div id="{{ $quillId }}" wire:ignore></div>
</div>

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/lib/quill2/dist/quill.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/lib/quill2/formats/code-block/highlight.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/lib/quill2/formats/formula/katex.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset('assets/lib/quill2/formats/code-block/highlight.js') }}"></script>
    <script src="{{ asset('assets/lib/quill2/dist/quill.js') }}"></script>
    <script src="{{ asset('assets/lib/quill2/formats/formula/katex.js') }}"></script>

    <script>
        // init quill
        const quill = new Quill('#{{ $quillId }}', {
            modules: {
                toolbar: '#toolbar-container-{{ $quillId }}',
            },
            theme: 'snow',
            placeholder: 'Enter the content',
        });
        // binding the data
        quill.on('text-change', function() {
            let value = document.getElementsByClassName('ql-editor')[0].innerHTML;
            @this.set('value', value)
        })
        // clear the editor after create
        document.addEventListener('livewire:navigated', function() {
            Livewire.on('reset-quill-content', () => {
                quill.setText('');
            });
        });

        document.addEventListener('livewire:navigated', function() {
            Livewire.on('fill-quill-content', (content) => {
                quill.root.innerHTML = content;
            });
        });
    </script>
@endpush
