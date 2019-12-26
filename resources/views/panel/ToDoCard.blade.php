<div class="card">
    <script src="{{url('/').'/js/jquery-3.4.1.min.js'}}">
    </script>
    <script>
      function onCheck (elem)
      {
        var sec = '{{csrf_token()}}';
        //console.log(elem);
        var id = $(elem).parent().parent().attr('id');
        $(elem).parent().parent().fadeOut(1000);
        var data = {id:id,_token:sec};
        console.log($.param(data));
        var data = $.param(data);
        $.post('{{url('/deleteTask')}}',data);
      }

      $(document).ready(function() {
        $('.createTask').click(function(){
          var name = $('.name').val();
          var description = $('.description').val();
          var sec = '{{csrf_token()}}';
          var data = {name:name,description:description,_token:sec};
          var data = $.param(data);
          $.post('{{url('/createTask')}}',data,function(){
            location.reload();
          });
          $('.modal').modal('toggle')
        });
      });
    </script>
    <div class="card-header">
      <h3 class="card-title">Планировщик задач</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal">
          <i class="fas fa-plus addTask"></i>        
        </button>
        </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <ul class="todo-list ui-sortable" data-widget="todo-list">
        @if (count($tasks) >= 1)
          @foreach ($tasks as $task)
          <li id={{$task->id}}>
              <!-- drag handle -->
              <span class="handle ui-sortable-handle">
                  <i class="fas fa-ellipsis-v"></i>
                  <i class="fas fa-ellipsis-v"></i>
              </span>
              <!-- checkbox -->
              <div class="icheck-primary d-inline ml-2">
                  <input type="checkbox" value="" name="todo1" id="todoCheck1" onclick="onCheck(this)">
                  <label for="todoCheck1"></label>
              </div>
              <!-- todo text -->
              <span class="text">{{$task->name}}</span>
                              <!-- todo text -->
                              <span>{{$task->description}}</span>
              <!-- General tools such as edit or delete-->
              <div class="tools">
                 <i class="fas fa-edit"></i>
                  <i class="fas fa-trash-o"></i>
              </div>
           </li>
          @endforeach
        @else
  Здесь нет записей!
        @endif
      </ul>
    </div>
    <!-- /.card-footer -->
  </div>


  <div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">        
          <h4 class="modal-title">Создать задачу</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <h5>Имя задачи: </h5>
          <input class="name" type="textbox">
          <h5>Детали задачи: </h5>
          <textarea class="description" cols="40" rows="3"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
          <button type="button" class="btn btn-primary createTask">Сохранить изменения</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->