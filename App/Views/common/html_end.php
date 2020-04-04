<?php defined('APPPATH') OR exit('No direct script access allowed');?>

<?php if(isset($message_to_user) && $message_to_user !== '') :?>
	<div id="message_to_user" <?php print $message_to_user !== '' ? 'class="modal-message-open"' : 'class="modal-message-hide"'  ;?>  >
		<div class="modal-message-dialog col-12">
			<div class="modal-message-header col-12">
				<a href="#close" title="EXIT" class="close" onClick="document.getElementById('message_to_user').style.display='none';return false;">&times;</a>
				<h4><?php print 'Сообщение для Пользователя' ;?></h4>		
			</div>
			<div class="form-row madal-message-content">
					<div class="madal-message-text col-8" style="font-size:1.0rem;">
						<?php print $message_to_user; ?>
					</div>
					<div class="img-message-content col-4">
						<img class="img-fluid" src="/images/call-centre.jpg" alt="" title="" />
					</div>
			</div>
			<div class="modal-message-footer col-12 font-italic">
				<?php print 'С искренним уважением, администрация сайта!' ;?>
			</div>	
		</div>
	</div>
<?php endif ;?>

		
  </body>
</html>

