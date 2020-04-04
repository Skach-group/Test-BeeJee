<?php defined('APPPATH') OR exit('No direct script access allowed');?>

<div class="container-fluid">
	<div class="container">	
		<div class="row pt-4 w-100">
			<div class="col-12 text-right pb-2 m-0">
				<?php if(isset($data['user_status']) && $data['user_status'] == 'SuperAdmin') :?>
					<a class="btn btn-danger btn-sm m-1" type="button" href="<?php print '/user-logout' ;?>">АДМИН, ВЫХОДИ</a>
				<?php else :?>
					<a class="btn btn-success btn-sm m-1" type="button" href="<?php print '/get-form-authorization' ;?>">АДМИН, ЗАХОДИ</a>
				<?php endif ;?>
			</div>
			<div class="col-12 text-center page-title"><h1><?php print 'СПИСОК ЗАДАЧ' ;?></h1></div>
			<!--noindex-->
			<div data-nosnippet id="add-tesk" class="col-12 mb-2">
				<div class="form-row text-center my-2 p-0">
					<div class="col-12 col-md-3 ml-auto">
						<a class="btn btn-primary btn-sm" rel="nofollow" data-toggle="collapse" href="#addTask" role="button" type="button" aria-expanded="false" aria-controls="addTask">
							<?php print 'ДОБАВИТЬ НОВУЮ ЗАДАЧУ' ;?>
						</a>
					</div>
				</div>
				<div class="collapse" id="addTask" data-parent="#add-tesk">
					<div class="card card-body" style="background-color:#f5f5f5;border:1px solid #dadada;">
						<div class="text-right">
							<button class="btn btn-danger btn-sm clear-form" type="button" data-toggle="collapse" data-target="#addTask" aria-expanded="false" aria-controls="addTask">X</button>
						</div>
						<form name="form_addtask" method="post" action="/add-new-task" >
							<div class="form-group">
								<label><span style="color:red;">*</span> <?php print 'Имя Пользователя' ;?></label>
								<input type="text" class="form-control" name="user_name" placeholder="Пожалуйста, укажите Ваше полное имя." required />
							</div>
							<div class="form-group">
								<label><span style="color:red;">*</span> <?php print 'E-mail Пользователя' ;?></label>
								<input type="email" class="form-control" name="user_email" placeholder="Пожалуйста, укажите Ваш контактный E-mail" required />
							</div>
							<div class="form-group">
								<label class="label-text-task"><span style="color:red;">*</span> <?php print 'Текст задачи' ;?></label>
								<input type="text" class="form-control editor" name="text_task" />
							</div>
							<div class="btn-add-task text-right">
								<button class="btn btn-danger btn-sm m-1" type="reset"><?php print 'ОЧИСТИТЬ ПОЛЯ' ;?></button>								
								<button class="btn btn-success btn-sm m-1 add-task-button" type="submit"><?php print "ДОБАВИТЬ ЗАДАЧУ" ;?></button>
							</div>							 
						</form>
					</div>
				</div>
			</div>
			<!--/noindex-->	
			<div class="p-1 mb-2 w-100" style="border-bottom:1px solid #dadada;"></div>			
			<div class="col-12 select-order p-2 mb-3">
				<?php print $data['form_select'] ;?>
			</div>
			<?php foreach($data['taskslist'] as $item) :?>
				<div class="col-12 mb-4 p-3 card-task-list" style="border:3px double #dadada;border-radius:10px;background:#fff;">
					<?php if(isset($data['user_status']) && $data['user_status'] == 'SuperAdmin') :?>
						<div class="col-12 p-0 m-0 text-right">
							<a class="btn btn-success btn-sm m-1" type="button" href="<?php print '/edit-task/'.$item['id'] ;?>">EDIT</a>
							<a class="btn btn-danger btn-sm m-1" type="button" href="<?php print '/delete-task/'.$item['id'] ;?>">DELETE</a>
						</div>
					<?php endif ;?>	
					<div class="col-12 text-center" style="border-bottom:1px solid #dadada;">
						<h2 style="font-size:1.3rem;"><?php print 'Задачу создал '.$item['user_name'] ;?></h2>
					</div>
					<div class="col-12">
						<h2 style="font-size:1.0rem;"><?php print $item['user_email'] ;?></h2>
					</div>
					<div class="col-12 font-italic p-2 m-0">
						<?php print html_entity_decode($item['text_task']) ;?>
					</div>
					<div class="col-12 text-right" style="border-top:1px solid #dadada;">
						<?php if($item['status_task'] == 0) :?>
							<?php print 'Статус: задача в процессе выполнения' ;?>
						<?php else :?>
							<?php print 'Статус: задача выполнена' ;?>
						<?php endif ;?>	
					</div>
					<?php if($item['params'] == 1) :?>
						<div class="col-12 text-right">
							<?php print 'Отредактировано администратором' ;?>
						</div>
					<?php endif ;?>
					<?php if(isset($data['user_status']) && $data['user_status'] == 'SuperAdmin') :?>
						<div class="col-12 p-0 m-0" style="font-size:0.8rem;">
							<?php if($item['status_task'] == 0) :?>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="status_task_<?php print $item['id'] ;?>" value="0" required checked />
									<label class="form-check-label" for="status_task">ЗАДАЧА НЕ ВЫПОЛНЕНА</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="status_task_<?php print $item['id'] ;?>" value="1" required />
									<label class="form-check-label" for="status_task">ЗАДАЧА ВЫПОЛНЕНА</label>
								</div>
							<?php else : ?>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="status_task_<?php print $item['id'] ;?>" value="0" required />
									<label class="form-check-label" for="status_task">ЗАДАЧА НЕ ВЫПОЛНЕНА</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="status_task_<?php print $item['id'] ;?>" value="1" required checked />
									<label class="form-check-label" for="status_task">ЗАДАЧА ВЫПОЛНЕНА</label>
								</div>
							<?php endif ;?>
						</div>
					<?php endif ;?>					
				</div>	
			<?php endforeach ;?>
			<?php if(isset($count_task) && !empty($count_task)) :?>
				<div class="col-12 text-center">
					<nav aria-label="pagination">
						<ul class="pagination pagination-sm justify-content-center">
							<?php for($k = 1; $k <= $count_task; $k++) :?>
								<li <?php print  $k == $num_page ? 'class="page-item active"' : 'class="page-item"' ?> >
									<a class="page-link" href="<?php print '/'.$k ?>">
										<?php print $k ?>
									</a>
								</li>						
							<?php endfor ;?>
						</ul>
					</nav>	
				</div>
			<?php endif ;?>	
		</div>
	</div>
</div>	