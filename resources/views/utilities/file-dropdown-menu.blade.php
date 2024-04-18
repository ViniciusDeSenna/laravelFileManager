<div class="dropdown no-arrow">
    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
        <div class="dropdown-header">File Functions:</div>
        <a class="dropdown-item" onclick="makeFavorite({{$file->id}})">Favorite</a>
        <a class="dropdown-item" onclick="downloadFile({{$file->id}})">Download</a>
        <a class="dropdown-item" onclick="">Rename</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" >Delete</a>
    </div>
</div>
