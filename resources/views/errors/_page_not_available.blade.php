@extends('control_panel.layouts.header')
{{-- @section('content') --}}
<body>
    <div class="container overflow-hidden">
    <section class="content">
        <div class="error-page">
            <h3 class="headline text-yellow"> </h3>

            <div class="text-center">

                <img class="img-responsive" width="300" src="{{ asset('img/Error_404_PNG.png') }}" alt="not found"/>
                <h2><i class="fa fa-warning text-yellow"></i> {{ $title }}</h2>

                <p>
                    {{ $message }}.
                    Meanwhile, you may <a href="#" onclick="window.close()">return to dashboard</a>.
                </p>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    </div>
</body>
{{-- @endsection --}}
