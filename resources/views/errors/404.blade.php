@extends('control_panel.layouts.header')
<body>
      <div class="container">
        <section class="">
            <div class="error-page">
                {{-- <h2 class="headline text-yellow"> 404</h2> --}}
                <div class="text-center">
                    <img class="img-responsive" width="300" src="{{ asset('img/Error_404_PNG.png') }}" alt="not found"/>
                    <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                    <p>
                        We could not find the page you were looking for.
                        Meanwhile, you may <a href="#" onclick="window.close()">return to dashboard</a> or try using the search form.
                    </p>
                </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
        </section>
      </div>
</body>
