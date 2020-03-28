<div class="card">
    <script src="{{url('/').'/js/jquery-3.4.1.min.js'}}">
    </script>
    <script>

      function edit(elem) //кагда редактируем привязано к каждому елементу см. хтмл
      {
        var sec = '{{csrf_token()}}'; //црсры токен для защиты
        var id = $(elem).parent().parent().attr('id'); // получаем айдишник задачи
        var taskName = $(elem).parent().parent().children('.text').html(); //получаем имя
        var taskContent = $(elem).parent().parent().children('.TaskTest').html(); //и контент задачи
        console.log(taskName); //лог
        console.log(taskContent);
        $('.name').val(taskName); // задаем имя и контент 
        $('.description').val(taskContent);
        $('.type').val(id); // передаем айдишник дальше в скритом поле
        $('.modal').modal('toggle') // вкдючаем всплывашку 
      }

      function onCheck (elem) //когда нажимаем на чекбокс тоже привязано к каждому елементу
      {
        var sec = '{{csrf_token()}}'; // токен
        //console.log(elem);
        var id = $(elem).parent().parent().attr('id'); //получаем айдишник
        $(elem).parent().parent().fadeOut(1000); //еффект выцветания 
        var data = {id:id,_token:sec}; //формируем данные для бекенда
        //console.log($.param(data));
        var data = $.param(data); //кодируем в джсон
        $.post('{{url('/deleteTask')}}',data); //отправляем
      }

      $(document).ready(function() { //документ готов 
        $('.createTask').click(function(){ // если нажали по кнопке сохранить в модалке (сама модалка открываеться по кнопке без JS)
          var type = $('.type').val(); //получаем значение скрытого поля
          if (!type) // и если не равно нулю
          { // значит модалка вызвана апгрейдом задачи а не созданием
            console.log('update task'); //лог 
            var name = $('.name').val(); //получаем имя 
            var description = $('.description').val(); //контент задачи
            var sec = '{{csrf_token()}}'; //токен
            var data = {name:name,id:id,description:description,_token:sec}; //формируем данные для бекенда
            var data = $.param(data); //кожируем в JSON
            $.post('{{url('/updateTask')}}',data,function(){ //отправляем
              location.reload(); //когда отправили перезагружаем страницу
            });
            $('.modal').modal('toggle') //выключаем всплывашку (до перезагрузки страницы ибо асинхрон)
          }
          else //если не определено значит нужно создать задачу
          {
            var name = $('.name').val(); //получаем имя 
            var description = $('.description').val(); //и контент задачи
            var sec = '{{csrf_token()}}'; //токен
            var data = {name:name,description:description,_token:sec}; //формируем данные
            var data = $.param(data); // кодируем в JSON
            $.post('{{url('/createTask')}}',data,function(){ // отправляем
              location.reload(); // после того как отправили перезагружаем
            });
            $('.modal').modal('toggle') //вырубаем модалку
          }
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
    <div class="card-body drag">
      <ul class="todo-list ui-sortable" data-widget="todo-list" count="{{count($tasks)}}">
        @if (count($tasks) >= 1) <!-- если задач больше одной-->
          @foreach ($tasks as $task) <!-- проходим по каждой --> 
          <li id="{{$task->id}}" class="draggable"> <!-- Присваемваем айдищник из бд -->
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
              <span class="text">{{$task->name}}</span> <!-- присваиваем имя задачи из бд -->
                              <!-- todo text -->
                              <span class="TaskTest">{{$task->description}}</span> <!-- так же и с описанием -->
              <!-- General tools such as edit or delete-->
              <div class="tools">
                 <i class="fas fa-edit" onclick="edit(this)"></i>
                  <i class="fas fa-trash-o"></i>
              </div>
           </li>
          @endforeach <!-- конец перебора -->
        @else <!-- а если нет задач пишем тчо нет задач  -->
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
          <input class="type" type="textbox" hidden>
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