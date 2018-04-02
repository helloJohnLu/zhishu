@include('layouts._head')

@include('layouts._nav')

<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">
        @yield('content')

        @include('layouts._sidebar')
    </div>    </div><!-- /.row -->
</div><!-- /.container -->

@include('layouts._footer')
