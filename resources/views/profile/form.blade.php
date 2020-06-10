<div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="text">Name</label>
            <input type="text" name="name" autocomplete="off">
            @error('name')<p style="color:red;">{{$message}}</p> @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="form-group col-md-4">
            <label for="file">File</label>
            <input type="file" name="image" class="form-control" value="{{old('file') ?? '/uploads/'.$profile->image}}">
            @error('image')<p style="color:red;">{{$message}}</p> @enderror
        </div>
    </div>
</div>
@csrf
