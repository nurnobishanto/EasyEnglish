<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />



    <!-- Share JS -->
{{--    <script src="{{ asset('js/share.js') }}"></script>--}}

    <link rel="icon" type="image/png" href="{{ asset('uploads/'.getSetting('site_favicon')) }}">
     {!! SEO::generate() !!}

    @laravelPWA
    <style>

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

    <!-- jQuery -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
        function incrementCount(id,model) {
            // Make an AJAX request to increment the count
            $.ajax({
                url: '{{route('incrementDownloadCount')}}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    model: model,
                },
                success: function(response) {
                    // Handle success if needed
                },
                error: function(error) {
                    console.error('Error incrementing count:', error);
                }
            });
        }
        $(document).ready(function() {
            $('#table').DataTable();
            $('#table1').DataTable();
            $('#table2').DataTable();

            $('#table4').DataTable();

            var table = $('#examListTable').DataTable({
                // Your DataTable options here
            });

            // Add filter select for status column
            table.column(5).data().unique().sort().each(function(value, index) {
                $('#status-filter').append('<option value="' + value + '">' + value + '</option>');
            });

            // Apply the filter on change
            $('#status-filter').on('change', function() {
                var selectedStatus = $(this).val();
                table.column(5).search(selectedStatus).draw();
            });
        });
    </script>
</body>


</html>
