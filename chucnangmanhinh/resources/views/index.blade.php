<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Admin-Index LaravelShop | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel='stylesheet' type='text/css' href="{{asset('public/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link rel='stylesheet' type='text/css' href="{{asset('public/css/style.css')}}"/>
<link rel='stylesheet' type='text/css' href="{{asset('public/css/style-responsive.css')}}"/>
<!-- font CSS -->
<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' >
<!-- font-awesome icons -->
<link rel='stylesheet' type='text/css' href="{{asset('public/css/font.css')}}" />
<link rel='stylesheet' type='text/css' href="{{asset('public/css/font-awesome.css')}}" > 
<link rel='stylesheet' type='text/css' href="{{asset('public/css/morris.css')}}" />
<!-- calendar -->
<link rel='stylesheet' type='text/css' href="{{asset('public/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<script src="{{asset('public/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/js/raphael-min.js')}}"></script>
<script src="{{asset('public/js/morris.js')}}"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/')}}" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{'public/img/2.png'}}">
                <span class="username">
                    <?php
                        $user_name = session()->get('user_name');
                        echo $user_name;
                    ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL('/')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{URL::to('/show-user')}}">
                        <i class="fa fa-book"></i>
                        <span>Quản lý tài khoản</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/show-user')}}">Tất cả người dùng</a></li>
                    </ul>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-user')}}">Thêm tài khoản</a></li>
                    </ul>
                </li>	
				<li class="sub-menu">
                    <a href="{{URL::to('/show-product')}}">
                        <i class="fa fa-book"></i>
                        <span>Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Thêm Sản Phẩm</a></li>
						<li><a href="{{URL::to('/show-product')}}">Liệt kê sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="{{URL::to('/show-customer')}}">
                        <i class="fa fa-book"></i>
                        <span>Khách hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-customer')}}">Thêm Khách hàng</a></li>
						<li><a href="{{URL::to('/show-customer')}}">Danh sách khách hàng</a></li>
                    </ul>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('content')
    </section>	
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/js/bootstrap.js')}}"></script>
<script src="{{asset('public/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/js/scripts.js')}}"></script>
<script src="{{asset('public/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/js/jquery.scrollTo.js')}}"></script>
{{-- text-editer --}}
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
{{-- validation-kiểm tra đã nhập chưa --}}
<script src="{{asset('public/js/jquery.form-validator.min.js')}}"></script>
{{-- validation-kiểm tra đã nhập chưa --}}
<script type="text/javascript">
    $.validate({});
</script>
{{-- text-editer --}}
<script>
  ClassicEditor
      .create( document.querySelector( '#text-editor' ) )
      .catch( error => {
          console.error( error );
      } );
</script>
<!-- morris JavaScript -->	
<script>
    function reviewIMG(input){
        var file = $('.img_review').get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $("#showIMG").attr("src",reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
