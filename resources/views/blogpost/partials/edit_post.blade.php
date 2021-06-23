<form action="{{ route('blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    {{-- Post title --}}
    <div class="form-group">
      <label for="title">Post title</label>
      <input type="text"
                name="title"
                id="title"
                class="form-control"
                value="{{ $blog->title }}"
                placeholder="write post title here.."
                required />

        @if ($errors->has('title'))
            <small class="text-danger">{{ $errors->first('title') }}</small>
        @endif
    </div>
    {{-- End --}}

    {{-- Post body --}}
    <div class="form-group">
      <label for="body">Post body</label>
      <textarea class="form-control"
                name="body"
                id="body"
                rows="3"
                placeholder="write post body here.."
                required
                style="resize: none;">{{ $blog->body }}</textarea>

        @if ($errors->has('body'))
            <small class="text-danger">{{ $errors->first('body') }}</small>
        @endif
    </div>

    <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
        <label for="Image">Image</label>
        <input type="file"  accept="image/*" class="form-control-file required" name="file"  id="file">
        <span class="text-danger">{{ $errors->first('file') }}</span>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="Category">Category</label>
            <select class="form-control" id="Category" name="category">
                @foreach ($categorys as $category)
                <option value="{{ $category->id }}"
                    {{ $category->id == $blog->cat_id? 'selected' : '' }}>
                    {{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="Project">Projects</label>
            <select class="form-control" id="Category" name="project">
                @foreach ($projects as $project)
                <option value="{{ $project->id }}"
                    {{ $project->id == $blog->project_id ? 'selected' : '' }}>
                    {{ $project->title }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Update Post</button>
        <a href="{{ route('blogs.index') }}" class="btn btn-default">Back</a>
    </div>

</form>
