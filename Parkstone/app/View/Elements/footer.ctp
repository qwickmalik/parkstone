
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-line">
            &#169; <?php echo "2014 - ".date('Y'); ?> <a href="http://www.qwickfusion.com">QwickFusion</a>. Developed for Parkstone Capital Limited. All rights reserved.

            </div>  

        <div class="modal_custom"><!-- Place at bottom of page --></div>
    </div>

</section>
<form>
    <input type="hidden" id="nowload" value="<?php echo $this->webroot.'img/ajax-loader.gif'; ?>" name="nowloader" >
</form>
<script lang="javascript">
//Tooltip
    $('[rel="tooltip"]').tooltip('toggle')
    $('[rel="tooltip"]').tooltip('hide');   
    
       $(document).ready(function ()
    {
        var nowload = $("#nowload").val(); 
    
	function ajaxindicatorstart(text)
	{
            
		if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
		jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="'+nowload+'"><div>'+text+'</div></div><div class="bg"></div></div>');
		}
		
		jQuery('#resultLoading').css({
			'width':'100%',
			'height':'100%',
			'position':'fixed',
			'z-index':'10000000',
			'top':'0',
			'left':'0',
			'right':'0',
			'bottom':'0',
			'margin':'auto'
		});	
		
		jQuery('#resultLoading .bg').css({
			'background':'#000000',
			'opacity':'0.7',
			'width':'100%',
			'height':'100%',
			'position':'absolute',
			'top':'0'
		});
		
		jQuery('#resultLoading>div:first').css({
			'width': '250px',
			'height':'75px',
			'text-align': 'center',
			'position': 'fixed',
			'top':'0',
			'left':'0',
			'right':'0',
			'bottom':'0',
			'margin':'auto',
			'font-size':'16px',
			'z-index':'10',
			'color':'#ffffff'
			
		});

	    jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeIn(300);
	    jQuery('body').css('cursor', 'wait');
	}

	function ajaxindicatorstop()
	{
	    jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeOut(300);
	    jQuery('body').css('cursor', 'default');
	}
	

	
  jQuery(document).ajaxStart(function () {
   		//show ajax indicator
		ajaxindicatorstart('loading data.. please wait..');
  }).ajaxStop(function () {
		//hide ajax indicator
		ajaxindicatorstop();
  });
  
  });
</script>
</body>
</html>
