{*
	--------------------------------------------------------------------------------------------------------------
	iDevAffiliate HTML Front-End Template
	--------------------------------------------------------------------------------------------------------------
	Theme Name: Admin Panel
	--------------------------------------------------------------------------------------------------------------
*}
<div class="footer"  style="background-color: {$header_background};">
<div class="copyrite">
<a href="http://www.idevdirect.com{$affiliate_account}" target="_blank">{$footer_tag}</a>  |  {$footer_copyright} {php} echo date("Y"); {/php} <a href="{$siteurl}" target="_blank">{$sitename}</a> - {$footer_rights}

{if isset($contact_link)}  |  <a href="mailto:{$alternate_email_address}">{$header_emailLink}</a>{/if}

</div>
</div>

	

	{literal}
    
    <script>
	
    	$(document).ready(function(){
				$('nav ul li').click(function(){
					if($(this).hasClass('active')){
						$(this).removeClass('active');
						return;	
					}
					$('nav ul li').removeClass('active');
					$(this).addClass('active');
				});
					
					
					
					
				var textvd = $('.page-header.title h1').text();
				var textvds = $('.page-heading-sec h1').text();
				$('.subtitle_bd').append(textvd);
				$('.subtitle_bd').append(textvds);	
				
				
			$('.submenu li a.active').parent().parent().parent().addClass('active');
				
			});
			
			
    </script>
	<script>
    /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
    $(document).ready(function(){
        
        $( window ).resize(function() {
          
          if($( window ).width() > '1200'){
              $('#mySidenav').css('width', '25%');
              }
         if($( window ).width() < '1185'){
              $('#mySidenav').css('width', '0');
              }  
        });
        
    });
    function openNav() {
        document.getElementById("mySidenav").style.width = "300px";
        document.getElementById("main").style.marginLeft = "300px";
    }
    
    /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    

	{/literal}
    
</body>
</html>