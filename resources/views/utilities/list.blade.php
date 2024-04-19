<!-- Folders -->
@if(isset($folders))
    <div class="list-group">
        @foreach($folders as $item)
            <a href="{{ route('folder.view', [$item->id]) }}" class="list-group-item list-group-item-action">
                <i class="fa fa-folder-open mr-2 text-primary"></i> {{$item->name}}
            </a>
        @endforeach
    </div>
@endif

<div class="m-5"></div>

<!-- Files -->
@if(isset($files))
    <div class="list-group">
        @foreach($files as $file)
            <div class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="#">
                        <div>
                            <i class="fas fa-file mr-2 text-primary"></i>{{$file->name}}
                        </div>
                    </a>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                            <div class="dropdown-header">File Functions:</div>
                            <a class="dropdown-item" onclick="makeFavorite({{$file->id}})">Favorite</a>
                            <a class="dropdown-item" >Download</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" >Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
