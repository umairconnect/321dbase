@push('js')
<script>
    // Bootstrap Notify function
    function bootstrapNotify(notifyType, notifyText) {
        var content = {};

        content.message = notifyText;

        var notify = $.notify(content, {
            type: notifyType,
            allow_dismiss: true,
            spacing: 10,
            timer: 2000,
            placement: {
                from: 'top',
                align: 'right'
            },
            offset: {
                x: 30,
                y: 30
            },
            delay: 1000,
            z_index: 10000,
            animate: {
                enter: 'animate__animated animate__bounce',
                exit: 'animate__animated animate__bounce'
            }
        });
    }

    // Success Notify
    @if ($message = Session::get('success'))
        bootstrapNotify('success', '{{ $message }}')
    @endif

    // Error Notify
    @if ($message = Session::get('error'))
        bootstrapNotify('danger', '{{ $message }}')
    @endif

    // Warning Notify
    @if ($message = Session::get('warning'))
        bootstrapNotify('warning', '{{ $message }}')
    @endif

    // Info Notify
    @if ($message = Session::get('info'))
        bootstrapNotify('info', '{{ $message }}')
    @endif

    // Primary Notify
    @if ($message = Session::get('primary'))
        bootstrapNotify('primary', '{{ $message }}')
    @endif

    // Dark Notify
    @if ($message = Session::get('dark'))
        bootstrapNotify('dark', '{{ $message }}')
    @endif
</script>
@endpush