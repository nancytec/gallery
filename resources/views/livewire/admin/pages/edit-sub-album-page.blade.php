
<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('albums.all')}}">Albums</a></li>
                        <li class="breadcrumb-item"><a href="{{route('album.edit', $album->album->id)}}">{{$album->album->title}}</a></li>
                        <li class="breadcrumb-item"><a href="{{route('sub-albums.all', $album->album->id)}}">Albums</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- SELECT2 EXAMPLE -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update album</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <x-alert />
                    <form wire:submit.prevent="save">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" wire:model.lazy="title" class="form-control {{$errors->has('title')? 'is-invalid' : '' }}" placeholder="Title of the album">
                                    @error('title') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea wire:model.lazy="details" class="form-control {{$errors->has('details')? 'is-invalid' : '' }}" placeholder="Describe this video"></textarea>
                                    @error('details') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            @if($contentStatus)
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Content type: {{$content}}</label>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            @else
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Content</label>
                                        <select wire:model.lazy="content" class="form-control {{$errors->has('content')? 'is-invalid' : '' }}" >
                                            <option value="">Select album content</option>
                                            <option value="Albums">Albums</option>
                                            <option value="Pictures">Pictures</option>
                                        </select>
                                        @error('content') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            @endif

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Cover Image <sup>max 400kb</sup></label>
                                    <input type="file" wire:model="image" class="form-control {{$errors->has('image')? 'is-invalid' : '' }}">
                                    @if($image)
                                        <img src="{{$image->temporaryUrl()}}" class="img-fluid" />
                                    @else
                                        <img src="{{$old_image}}" class="img-fluid" />
                                    @endif
                                    @error('image') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                    <small wire:loading wire:target="image" class="form-text text-muted"><i class="fa fa-spin"><i class="fa fa-spinner"></i></i>&nbsp;&nbsp; Loading preview...</small>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <!-- /.row -->


                        <button wire:loading.remove wire:target="save" type="submit" class="btn btn-primary">Save album</button>
                        <button disabled wire:loading wire:target="save" type="submit" class="btn btn-primary"> Processing  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> </button>
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Contact <a href="#">the system administrator if </a> you're not sure of what to do.
                </div>
                <!-- /.card -->

            </div>
            <!-- /.container-fluid -->

            @if($content == 'Pictures')
                @livewire('add-picture-to-sub-album', ['album_id' => $album_id])
            @endif

            @if($content == 'Albums')
                @livewire('add-album-to-sub-album', ['id' => $album_id])
            @endif

    </section>
    <!-- /.content -->

</div>

