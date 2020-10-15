<!doctype html>
<title>Site Maintenance</title>
<head>
    <link href="{{ asset('img/sja-logo.png') }}" rel=icon>
    <link rel="stylesheet" href="{{ asset('cms/bootstrap/css/bootstrap.min.css') }}">
</head>

<style>
  body { text-align: center; padding-top: 40px; overflow: hidden !important;}
  h1 { font-size: 40px; }
  body { font: 20px Helvetica , sans-serif !important; color: #333; }
  article { display: block;  width: auto; margin: 0 auto; }
  a { color: #dc8100; text-decoration: none; }
  a:hover { color: #333; text-decoration: none; }
</style>

<article>
    <div class="container p-5">
        <div class="row text-center ">  
            <div align="center" class="pt-5">
                <img class="img-responsive" src="{{asset('img/maintenance.png')}}" width="30%" alt="maintenance" />
            </div>            
            <div align="center">
                <div class="text-left" style="width: 600px">
                    <h1 class="pt-5">We&rsquo;ll be back soon! <img src="{{asset('img/sja-logo.png')}}" width="80" alt="sja-logo"></h1>
                    <p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you need to you can always 
                        <a href="mailto:info@sja-bataan.com">contact us</a>, otherwise we&rsquo;ll be back online shortly!</p>
                    <p>&mdash; SJAI </p>
                </div>
            </div>            
        </div>
     </div>
</article>

<script src="{{ asset('cms/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>