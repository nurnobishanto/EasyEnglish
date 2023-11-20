<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QEBPYXHLBB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-QEBPYXHLBB');
</script>

    <!-- Links of CSS files -->
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/aos.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/meanmenu.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/remixicon.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/odometer.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/progresscircle.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/navbar.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/footer.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/responsive.css">
    <!-- CSS -->

    <link href=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/dataTables.bootstrap.min.css
        rel=stylesheet>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- jQuery -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <!-- Share JS -->
    <script src="{{ asset('js/share.js') }}"></script>




    <link rel="icon" type="image/png" href="{{ asset('uploads/'.getSetting('site_favicon')) }}">
     {!! SEO::generate() !!}
    <style>
        .paginate_button  {
            padding: 5px;
            background-color: rgb(255, 230, 0);
            color: white!important;
            margin: 2px;
        }
        .contactForm {
            max-width: 1050px;
            margin: auto;
        }

        .contactForm .form-group {
            margin-bottom: 25px;
        }

        .contactForm .form-cookies-consent a {
            color: var(--main-color);
        }


        a {
            text-decoration: none;
        }

        .coming-soon-content {
            max-width: 650px;
            background-color: var(--white-color);
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            padding: 25px !important;
            -webkit-box-shadow: 0 0 1.25rem rgba(108, 118, 134, 0.1);
            box-shadow: 0 0 1.25rem rgba(108, 118, 134, 0.1);
            margin: 0 auto 0 0;
        }
        .navbar-light .navbar-nav .nav-link{
            color:black;
            font-size:17px;
            font-weight:600;
        }
        .navbar-light .navbar-nav .nav-link:hover{
             color: var(--main-color);
         }
         .navbar-nav .active .nav-link{
             color: var(--main-color);
         }
    </style>
		<!-- Meta Pixel Code -->
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '717079566520087');
	  fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	  src="https://www.facebook.com/tr?id=717079566520087&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Meta Pixel Code -->
</head>

<body>

    @include('include.navbar')
    @yield('content')
    @include('include.footer')

    <!-- Start Go Top Area -->
    <div class="go-top">
        <i class="ri-arrow-up-s-line"></i>
    </div>
    <!-- End Go Top Area -->

    <script>

        $(document).ready(function() {
            $('#table').DataTable();
        });
        $(document).ready(function() {
            $('#table1').DataTable();
        });
        $(document).ready(function() {
            $('#table2').DataTable();
        });
        $(document).ready(function() {
            $('#table3').DataTable();
        });
        $(document).ready(function() {
            $('#table4').DataTable();
        });
    </script>

    <!-- Links of JS files -->
    <script data-cfasync="false" src=""></script>

    <script src="{{ asset('website') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('website') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('website') }}/assets/js/jquery.meanmenu.js"></script>
    <script src="{{ asset('website') }}/assets/js/owl.carousel.min.js"></script>
    <script src="{{ asset('website') }}/assets/js/jquery.appear.js"></script>
    <script src="{{ asset('website') }}/assets/js/odometer.min.js"></script>
    <script src="{{ asset('website') }}/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('website') }}/assets/js/TweenMax.min.js"></script>
    <script src="{{ asset('website') }}/assets/js/aos.js"></script>
    <script src="{{ asset('website') }}/assets/js/progresscircle.min.js"></script>
    <script src="{{ asset('website') }}/assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="{{ asset('website') }}/assets/js/form-validator.min.js"></script>
    <script src="{{ asset('website') }}/assets/js/contact-form-script.js"></script>
    <script src="{{ asset('website') }}/assets/js/wow.min.js"></script>
    <script src="{{ asset('website') }}/assets/js/main.js"></script>

    <script src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js></script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js></script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap.min.js></script>


</body>


</html>
