<script src="{{ asset('vendor/livewire-ace/ace.js') }}"></script>
@foreach($extensions as $extension)
    <script src="{{ asset('vendor/livewire-ace/ext-' . $extension . 'js') }}"></script>
@endforeach
<script>
    function EditorData() {
        return {
            data: {},
            init(element, wire, lw) {
                if (!ace) {
                    console.error('Ace editor is not available in window.');
                    return;
                }

                const editor = ace.edit(element);
                editor.session.setValue(lw.value);
                lw.mode = lw.mode || '{{ $mode }}';
                @if($theme !== null)
                    editor.setTheme('ace/theme/{{ $theme }}');
                @endif
                editor.session.setMode('ace/mode/' + lw.mode);

                editor.session.on('change', () => {
                    lw.value = editor.getValue();
                    wire.dispatch('updateValue', lw.value);
                });

                lw.on('changeMode', () => {
                    console.log(lw.mode);
                    editor.session.setMode('ace/mode/' + lw.mode);
                });

                lw.on('changeTheme', () => {
                    console.log(lw.theme);
                });
            }
        }
    }
</script>