{{-- {{dd($headingData,'43243')}} --}}
<div class="task-board">
    @if(isset($headingData))
        @foreach($headingData as $key => $row)
        <div class="status-card">
            <div class="card-header">
                <span class="card-header-text">{{$row->name}}</span>
            </div>
            <ul class="sortable ui-sortable" id="sort{{++$key}}" data-task-grid-id="{{$row->id}}">
                @foreach($data as $item)
                    @if($type == "department" && $row->id == $item->department_id)
                        <li class="text-row ui-sortable-handle" data-task-grid-type="department" data-task-id="{{$item->id}}">
                            {{$item->name}}
                            <p class="kb-user-avartar"><img src="{{!empty($item->assignUser->avartar)? $item->assignUser->avartar: config('const')['AVARTAR_DEFAULT']}}" alt=""></p>
                            <p>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                                    aria-valuenow="{{!empty($item->taskProcess->last())? $item->taskProcess->last()->complete: 0}}" aria-valuemin="0" aria-valuemax="100" style="width:{{!empty($item->taskProcess->last())? $item->taskProcess->last()->complete: 0}}%">
                                      {{!empty($item->taskProcess->last())? $item->taskProcess->last()->complete: 0}} %
                                    </div>
                                  </div>
                            </p>
                        </li>
                    @endif
                    @if($type == "categories" && $row->id == $item->task_category_id)
                        <li class="text-row ui-sortable-handle" data-task-grid-type="categories" data-task-id="{{$item->id}}">
                            {{$item->name}}
                            <p class="kb-user-avartar"><img src="{{!empty($item->assignUser->avartar)? $item->assignUser->avartar: config('const')['AVARTAR_DEFAULT']}}" alt=""></p>
                            <p>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                                    aria-valuenow="{{!empty($item->taskProcess->last())? $item->taskProcess->last()->complete: 0}}" aria-valuemin="0" aria-valuemax="100" style="width:{{!empty($item->taskProcess->last())? $item->taskProcess->last()->complete: 0}}%">
                                      {{!empty($item->taskProcess->last())? $item->taskProcess->last()->complete: 0}} %
                                    </div>
                                  </div>
                            </p>
                        </li>
                    @endif
                    @if($type == "phrase" && $row->id == $item->task_phrase_id)
                        <li class="text-row ui-sortable-handle" data-task-grid-type="phrase" data-task-id="{{$item->id}}">
                            {{$item->name}}
                            <p class="kb-user-avartar"><img src="{{!empty($item->assignUser->avartar)? $item->assignUser->avartar: config('const')['AVARTAR_DEFAULT']}}" alt=""></p>
                            <p>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                                    aria-valuenow="{{!empty($item->taskProcess->last())? $item->taskProcess->last()->complete: 0}}" aria-valuemin="0" aria-valuemax="100" style="width:{{!empty($item->taskProcess->last())? $item->taskProcess->last()->complete: 0}}%">
                                      {{!empty($item->taskProcess->last())? $item->taskProcess->last()->complete: 0}} %
                                    </div>
                                </div>
                            </p>
                        </li>
                    @endif
                    @if($type == "status" && $row->id == $item->status_id)
                        <li class="text-row ui-sortable-handle" data-task-grid-type="status" data-task-id="{{$item->id}}">
                            {{$item->name}}
                            <p class="kb-user-avartar"><img src="{{!empty($item->assignUser->avartar)? $item->assignUser->avartar: config('const')['AVARTAR_DEFAULT']}}" alt=""></p>
                            <p>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                                    aria-valuenow="{{!empty($item->taskProcess->last())? $item->taskProcess->last()->complete: 0}}" aria-valuemin="0" aria-valuemax="100" style="width:{{!empty($item->taskProcess->last())? $item->taskProcess->last()->complete: 0}}%">
                                      {{!empty($item->taskProcess->last())? $item->taskProcess->last()->complete: 0}} %
                                    </div>
                                  </div>
                            </p>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        @endforeach
    @endif
</div>