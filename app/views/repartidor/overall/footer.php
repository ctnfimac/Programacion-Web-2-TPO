<?php

$footer = '
		</div>
		<!-- Sticky Footer -->
		<footer class="sticky-footer">
			<div class="container my-auto">
				<div class="copyright text-center my-auto">
				<span>Copyright © Programación Web II 2018</span>
				</div>
			</div>
		</footer>
		</div>
		<!-- /.content-wrapper -->
	</div>
	<!-- /#wrapper -->
	<script src="./public/js/jquery-3.3.1.min.js"></script>
	<script src="./public/js/bootstrap.min.js"></script>
	<!-- <script src="./public/js/popper.min.js"></script>-->
	<script type="text/javascript" src="./public/js/map.js"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=MY_KEY&callback=mapa.initMap">
    </script>
</body>
</html>
';
printf($footer);