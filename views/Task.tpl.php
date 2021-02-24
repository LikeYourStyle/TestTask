<form class="form-horizontal" name="taskInfo">
    <input type="hidden" id="taskId" data-ng-model="taskId">
    <legend>Редактирование задачи</legend>
    <div class="form-group">
        <label for="taskContent" class="col-sm-3">Текст задачи</label>
        <div class="col-sm-9">
            <input type="text" data-ng-model="taskContent" id="taskContent" class="form-control" required="required" maxlength="32">
        </div>
    </div>
    <div class="form-group">
        <label for="taskDone" class="col-sm-3">Выполнено</label>
        <div class="col-sm-9">
            <input type="checkbox" data-ng-model="taskDone" id="taskDone" class="form-control"
                   ng-checked="taskDone=='1'" maxlength="32">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button class="btn btn-default" data-ng-click="saveTask()">Сохранить</button>
        </div>
    </div>
</form>