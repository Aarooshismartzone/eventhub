<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.head')

</head>

<body style="font-family: 'montserrat', sans-serif;">

    <!-- navbar mobile view -->

    @include('layouts.partials.header')

    <!-- end of navbar mobile view -->

    <div class="d-flex align-items-start">
        @include('layouts.partials.sidebar')

        
        
        <div class="tab-content" id="v-pills-tabContent">

            <!-- top bar on system view -->

            @include('layouts.partials.header-desktop')

            <!-- End of top bar on system view -->

            <div class="tab-pane fade show active tab-btm-inner" >
                @yield('content')
            </div>
            
        </div>
    </div>

    @stack('js')
    @include('layouts.partials.footer-scripts')
</body>

</html>
<!-- end document-->
