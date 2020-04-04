<?php defined('APPPATH') OR exit('No direct script access allowed');?>

<div class="container-fluid">   
	<div class="container p-5">
		<div class="row">
		<div class="col-12 text-right mb-3">
			<a class="btn btn-success btn-sm m-1" type="button" href="<?php print '/' ;?>">ВЕРНУТЬСЯ К СПИСКУ ЗАДАЧ</a>
		</div>
		<div class="col-12 text-center page-title"><h1><?php print 'ФОРМА АВТОРИЗАЦИИ' ;?></h1></div>
			<div class="col-12 p-3" id="page_form_content" style="border-radius:10px;border:3px double #dadada !important;">
				<?php if(isset($data['error_authorization']) && !empty($data['error_authorization'])) :?>
					<div class="col-12 text-center" style="color:red;"><b><?php print $data['error_authorization'] ;?></b></div>
				<?php endif ;?>	
				<form name="form_login" method="post" action="<?php echo '/user-authorization' ;?>">
					 <div class="form-group">
						 <label><span style="color:red;">*</span> <?php print 'Укажите Ваш E-mail' ;?></label>
						 <input type="text" class="form-control" name="username" required />
					 </div>
					 <div class="form-group">
						 <label><span style="color:red;">*</span> <?php print 'Укажите Ваш пароль' ;?></label>
						 <input type="password" class="form-control" name="password" required />			 
					 </div>	 
					<div class="col-12 text-right">				
						<button class="btn btn-success btn-sm" type="submit"><?php print 'ОТПРАВИТЬ' ;?></button>
					</div>				
				</form>					
			</div>		 
		</div>	
	</div>	    
    <div class="clearfix"></div>
</div>	