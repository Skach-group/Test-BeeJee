<?php defined('APPPATH') OR exit('No direct script access allowed');?>

<div class="container-fluid">
	<div class="container">	
		<div class="row pt-4 w-100">
			<div class="col-12 text-center page-title"><h1><?php print 'ФОРМА РЕДАКТИРОВАНИЯ ЗАДАЧИ' ;?></h1></div>
			<div class="p-1 mb-2 w-100" style="border-bottom:1px solid #dadada;"></div>
			<form class="w-100 p-3" name="form_edittask" method="post" action="/save-edit-task/<?php print $task['id'] ;?>" style="border:3px double #dadada;border-radius:10px;">
				<div class="col-12 pb-3">
					<button class="btn btn-success btn-sm m-1" type="submit"><?php print "СОХРАНИТЬ" ;?></button>				
					<a class="btn btn-danger btn-sm m-1" type="button" href="<?php print '/' ;?>">ВЕРНУТЬСЯ К СПИСКУ ЗАДАЧ</a>								
				</div>			
				<div class="form-group">
					<label><span style="color:red;">*</span> <?php print 'Имя Пользователя' ;?></label>
					<input type="text" value="<?php print $task['user_name'] ;?>" class="form-control" name="user_name" placeholder="Пожалуйста, укажите Ваше полное имя." required />
				</div>
				<div class="form-group">
					<label><span style="color:red;">*</span> <?php print 'E-mail Пользователя' ;?></label>
					<input type="email" value="<?php print $task['user_email'] ;?>" class="form-control" name="user_email" placeholder="Пожалуйста, укажите Ваш контактный E-mail" required />
				</div>
				<div class="form-group">
					<label><span style="color:red;">*</span> <?php print 'Текст задачи' ;?></label>
					<input type="text" value="<?php print $task['text_task'] ;?>" class="form-control editor" name="text_task" />
				</div>
				<div class="col-12">
					<?php if($task['status_task'] == 0) :?>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="status_task" value="0" required checked >
							<label class="form-check-label" for="status_task">ЗАДАЧА НЕ ВЫПОЛНЕНА</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="status_task" value="1" required >
							<label class="form-check-label" for="status_task">ЗАДАЧА ВЫПОЛНЕНА</label>
						</div>
					<?php else : ?>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="status_task" value="0" required  >
							<label class="form-check-label" for="status_task">ЗАДАЧА НЕ ВЫПОЛНЕНА</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="status_task" value="1" required checked >
							<label class="form-check-label" for="status_task">ЗАДАЧА ВЫПОЛНЕНА</label>
						</div>
					<?php endif ;?>
				</div>				
			</form>		
		</div>
	</div>
</div>	