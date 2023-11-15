<footer class="footer">
			    <div class="container-fluid">
				   <div class="row">
				       <div class="col-md-6">
					       <nav class="d-flex">
						      <ul class="m-0 p-0">
							     <li><a href="#">Inicio</a></li>
								 <li><a href="exit.php">Cerrar sesión</a></li>
							  <ul>
						   </nav>
					   </div>
				   </div>
				</div>
			 
			 </footer>
		</div>
</div>



<!----------html code compleate----------->








  
      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="js/jquery-3.3.1.slim.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery-3.3.1.min.js"></script>
  
  
  <script type="text/javascript">
        
		$(document).ready(function(){
		  $("#sidebar-collapse").on('click',function(){
		    $('#sidebar').toggleClass('active');
			$('#content').toggleClass('active');
		  });
		  
		   $(".more-button,.body-overlay").on('click',function(){
		     $('#sidebar,.body-overlay').toggleClass('show-nav');
		   });
		  
		});
		
</script>
  
  



  </body>
  
  </html>