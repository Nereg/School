<div class="card">
    <div class="card-header">
      <h3 class="card-title">Планировщик задач</h3>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <ul class="todo-list ui-sortable" data-widget="todo-list">
        @foreach ($tasks as $task)
            <li>
                <!-- drag handle -->
                <span class="handle ui-sortable-handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                </span>
                <!-- checkbox -->
                <div class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
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
      </ul>
    </div>
    <!-- /.card-footer -->
  </div>