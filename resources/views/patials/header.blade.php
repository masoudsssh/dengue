<head>
<title><?php echo "$headerstr" ?></title>
<meta charset="utf-8">
<meta name="Description" content="<?php echo "$descstr" ?>" />
<!-- Favicon --> 
<link rel="shortcut icon" href="images/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/font-awesome.css" type="text/css" />      
<link rel="stylesheet" media="screen" href="css/responsive-layouts.css" type="text/css" />  
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50ad60d000a9ef4a"></script>
</head>

<body>

<div id="fb-root"></div>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=hesterwong" async="async"></script>
<div class="site_wrapper">
<div class="boxed_wrapper">
    <div class="container_full">
        <div class="one">
    		<div id="logo"><a href="/"><img src="images/logo-kbd.png" alt="Komuniti Bebas Denggi" border="0"></a>
            </div><!-- end logo -->
			<div class="one_fourth2 span40"><input name="yourname" class="input_bg" type="text" id="name" placeholder="search bebas denggi"></div>
			
			<div class="one_fourth span30" id="user-info" style="display:none">
				<img src="images/profile-photo.png" class="circle">
				<a href="/profile"><span class="boldtext" id="user-name">your name</span></a>
			</div>

			<div class="one_last span40">
				<!-- <a href="#"><i class="fa fa-cog fa-2x"></i></a> -->
				<span style="margin-right: 12px;" ng-controller="commonController">
					<a href="/logout" class="btn green-haze btn-circle btn-sm header-link-logout" style="text-decoration:none !important; display:none" >
						Logout
					</a>

					<a class="btn green-haze btn-circle btn-sm header-link" ng-click="openLoginModal()" style="text-decoration:none !important" >
						Log In
					</a>
					<span class="header-link"> | </span>
					<a class="btn green-haze btn-circle btn-sm header-link" ng-click="openSignupModal()" style="text-decoration:none !important">Sign up</a>
				</span>
				<!-- <a href="#"><i class="fa fa-sign-out fa-2x"></i></a> -->
			</div>
         </div><!-- end top section -->
<div class="one bg_lightgrey">
<div class="container">
<div class="one_fifth bg_darkred text_white col_height side">your denggue alert</div>
<div class="bg_lightred col_height"><span class="text_big">100</span> <span class="text_white">cases in <a href="#" class="white">Subang Jaya</a></span>
<span class="one_last"><a href="#" class="white"><i class="fa fa-cog icon-white"></i>customize your alert</a></span></div>
</div> <!-- end container -->






