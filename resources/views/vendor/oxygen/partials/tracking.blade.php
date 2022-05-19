@if (strpos(request()->server('HTTP_HOST'), 'live-domain.com') !== false)
    {{-- Add GA and other tracking codes here. These will get inserted to the header --}}

    {{--<script>--}}
        {{--(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){--}}
            {{--(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),--}}
                {{--m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)--}}
        {{--})(window,document,'script','//www.google-analytics.com/analytics.js','ga');--}}

        {{--ga('create', 'UA-00000000-1', 'auto');--}}
        {{--ga('require', 'displayfeatures');--}}
        {{--ga('send', 'pageview');--}}

    {{--</script>--}}
@endif