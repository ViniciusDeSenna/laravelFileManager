<!-- Folders -->
@if(isset($folders))
    <div class="row">
        @foreach($folders as $item)
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <a class="text-decoration-none" href="{{route('folder.view', [$item->id])}}">
                    <div class="card mb-4 border-bottom-primary shadow-sm">
                        <div class="card-body">
                            <span class="icon text-blue-50"><i class="fa fa-folder-open"></i></span>
                            {{$item->name}}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endif
<div class="m-5"></div>
<!-- Files -->
@if(isset($files))
    <div class="row">
        @foreach($files as $file)
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-4">
                <a class="text-decoration-none" href="#">
                    <div class="card shadow-sm">
                        <div class="card-img-top mt-3" style="height: 10em; overflow: hidden;">
                            <img src="@if($file->type == ('image/jpeg' || 'image/png')) {{$file->path}} @else {{asset('assets/TextLogo.png')}} @endif" class="img-fluid" alt="..." style="height: 100%; width: 100%; object-fit: contain;">
                        </div>
                        <div class="card-body py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{$file->name}}</h6>
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
                </a>
            </div>
        @endforeach
    </div>
@endif
