<!doctype html>
<html lang="en" class="no-js" ng-app="dengueApp">

<?php
$headerstr = "Komuniti Bebas Denggi";
$descstr = "Komuniti Bebas Denggi";
?>

@include('patials.header')

<div class="container">

	@include('patials.left')

	<div class="center">
				
		<span class="" ng-view>
		</span>

	</div>
	
	@include('patials.right')

</div> <!-- end container_full -->


@include('patials.footer')
