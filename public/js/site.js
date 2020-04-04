jQuery(document).ready(function(){	
		
	jQuery('html').on('change', 'select[name="task_order_by"]', function(){
		var task_order_by = jQuery('select[name="task_order_by"] option:selected').val();
		console.log(task_order_by);
		jQuery.ajax({
			type: "POST",
			url: "/ajax-task-order-by",
			data: {task_order_by:task_order_by},
			cache: false,
			success: function(responce){
					location.reload();	
				}
		});			
	});

	jQuery('.clear-form').on('click', function(){
		jQuery('form[name="form_addtask"]')[0].reset();
	});
	
	jQuery('.card-task-list').on('click', 'input[type="radio"]', function(){
		var status_task = jQuery(this).val();
		var input_name = jQuery(this).attr('name');
		var arr_name = input_name.split('_');
		var id_task = arr_name[2];
		console.log('Status '+status_task+' id '+id_task);
		jQuery.ajax({
			type: "POST",
			url: "/ajax-update-status-task",
			data: {id_task:id_task, status_task:status_task},
			cache: false,
			success: function(responce){
				if(responce == '1'){
					location.reload();
				}else{
					alert('Ошибка изменения статуса задачи !');
				}	
			}
		});			
	});

	jQuery('form[name="form_addtask"]').submit(function(){
		if(!jQuery(this).find('input[name="text_task"]').val()){
			alert('ВНИМАНИЕ, ОШИБКА! \n Поле "Текст задачи" обязательно к заполнению и не может быть пустым!');
			return false;
		}else{
			return true;
		}
	});
	
});	