</div>
<!-- End body id div -->
<div id="footer">
	<footer>
		<nav class="navbar navbar-default nav-bottom">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#footerNav">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
		      </button>
		    </div>
		    <div class="collapse navbar-collapse" id="footerNav">
			    
			    <ul class="nav navbar-nav">
	    			<li><a href="#" id="music-btn">Listen to Tunes</a></li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
				 	<li <?PHP print (strpos($_SERVER['PHP_SELF'], '/mail_form.php')) ? "class='active'" : ""; ?> ><a href="mail_form.php" id="mail-btn"><span class="glyphicon glyphicon-user"></span> Get in Touch</a></li>
				</ul>

		    </div>
		  </div>
		</nav>

	
	</footer>
</div>
<!-- End footer div -->
</div> 
<!-- End full page div -->
</body>
</html>
