<script>
    $(document).ready(function() {

        //delete
        $('.delete').click(function(e) {
            var that = $(this)
            e.preventDefault();
            var n = new Noty({
                text: "@lang('site.confirm_delete')",
                type: "warning",
                killer: true,
                modal: true,
                theme: "semanticui",
                layout: 'center',
                buttons: [
                    Noty.button("@lang('site.yes')",
                        'btn btn-success mr-2',
                        function() {
                            that.closest('form').submit();
                        }),
                    Noty.button("@lang('site.no')",
                        'btn btn-danger mr-2',
                        function() {
                            n.close();
                        })
                ]
            });
            n.show();
        }); //end of delete

    }); //end of ready

</script>

{{-- disable --}}
<script>
    $(document).ready(function() {

        $('.disable').click(function(e) {
            var that = $(this)
            e.preventDefault();
            var n = new Noty({
                text: "@lang('site.confirm_client_disable')",
                type: "warning",
                killer: true,
                modal: true,
                theme: "semanticui",
                layout: 'center',
                buttons: [
                    Noty.button("@lang('site.yes')",
                        'btn btn-success mr-2',
                        function() {
                            that.closest('form').submit();
                        }),
                    Noty.button("@lang('site.no')",
                        'btn btn-danger mr-2',
                        function() {
                            n.close();
                        })
                ]
            });
            n.show();
        });

    }); //end of ready

</script>

{{-- enable --}}
<script>
    $(document).ready(function() {

        $('.enable').click(function(e) {
            var that = $(this)
            e.preventDefault();
            var n = new Noty({
                text: "@lang('site.confirm_client_enable')",
                type: "warning",
                killer: true,
                modal: true,
                theme: "semanticui",
                layout: 'center',
                buttons: [
                    Noty.button("@lang('site.yes')",
                        'btn btn-success mr-2',
                        function() {
                            that.closest('form').submit();
                        }),
                    Noty.button("@lang('site.no')",
                        'btn btn-danger mr-2',
                        function() {
                            n.close();
                        })
                ]
            });
            n.show();
        });

    }); //end of ready

</script>

{{-- archive --}}
<script>
    $(document).ready(function() {

        $('.archive').click(function(e) {
            var that = $(this)
            e.preventDefault();
            var n = new Noty({
                text: "@lang('site.confirm_archive')",
                type: "warning",
                killer: true,
                modal: true,
                theme: "semanticui",
                layout: 'center',
                buttons: [
                    Noty.button("@lang('site.yes')",
                        'btn btn-success mr-2',
                        function() {
                            that.closest('form').submit();
                        }),
                    Noty.button("@lang('site.no')",
                        'btn btn-danger mr-2',
                        function() {
                            n.close();
                        })
                ]
            });
            n.show();
        });

    }); //end of ready

</script>

{{-- unarchive --}}
<script>
    $(document).ready(function() {

        $('.unarchive').click(function(e) {
            var that = $(this)
            e.preventDefault();
            var n = new Noty({
                text: "@lang('site.confirm_unarchive')",
                type: "warning",
                killer: true,
                modal: true,
                theme: "semanticui",
                layout: 'center',
                buttons: [
                    Noty.button("@lang('site.yes')",
                        'btn btn-success mr-2',
                        function() {
                            that.closest('form').submit();
                        }),
                    Noty.button("@lang('site.no')",
                        'btn btn-danger mr-2',
                        function() {
                            n.close();
                        })
                ]
            });
            n.show();
        });

    }); //end of ready

</script>

@if (session('success'))

    <script>
        new Noty({
            type: 'success',
            theme: 'metroui',
            layout: 'topRight',
            text: "<i class='fas fa-check-circle'></i> {{ session('success') }}",
            timeout: 2000,
            killer: true
        }).show();

    </script>

@endif


@if (session('error'))

    <script>
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: "<i class='fas fa-exclamation-circle'></i> {{ session('error') }}",
            timeout: 5000,
            killer: true
        }).show();

    </script>

@endif
