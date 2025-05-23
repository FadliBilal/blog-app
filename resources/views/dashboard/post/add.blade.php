@extends('dashboard.master')
@section('title', 'New Post')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.home") }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.posts.index") }}">All Posts</a></li>
                        <li class="breadcrumb-item active">New Post</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">New Post</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                @foreach ($errors->all() as $error)
                                <p class="m-0">{{ $error }}</p>
                                @endforeach
                            </div>
                            @endif
                            @if (session("success"))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                <p class="m-0">{{ session("success") }}</p>
                            </div>
                            @endif
                            <form action="{{ route("dashboard.posts.store") }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8 mx-auto">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter slug" value="{{ old('slug') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea class="form-control" id="content" name="content" placeholder="Write content">{{ old('content') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mx-auto">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select class="form-control" name="category" id="category" style="width: 100%;">
                                                <option disabled selected>Pilih Kategori</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old("category") == $category->id ? "selected" : "" }}>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </select>                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="tags">Tags</label>
                                            <div class="select2-purple">
                                                <select multiple="multiple" data-placeholder="Select tag" data-dropdown-css-class="select2-purple" class="form-control" name="tags[]" id="tags" style="width: 100%;">
                                                    @foreach ($tags as $tag)
                                                    <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="align-items-center d-flex form-group justify-content-between">
                                            <label for="featured">Featured</label>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="featured" id="featured" value="1"/>
                                                <label for="featured"></label>
                                            </div>
                                        </div>
                                        <div class="align-items-center d-flex form-group justify-content-between">
                                            <label for="comment">Enable Comment</label>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="comment" id="comment" value="1" checked/>
                                                <label for="comment"></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="1">Publish</option>
                                                <option value="0">Draft</option>
                                            </select>                                            
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Publish</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section("style")
<link rel="stylesheet" href="{{ asset("assets/dashboard/plugins/select2/css/select2.min.css") }}"/>
<link rel="stylesheet" href="{{ asset("assets/dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}"/>
@endsection

@section("script")
<script src="{{ asset("assets/dashboard/plugins/sweetalert2/sweetalert2.all.js") }}"></script>
<script src="{{ asset("assets/dashboard/plugins/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("assets/dashboard/plugins/speakingurl/speakingurl.min.js") }}"></script>
<script src="{{ asset("assets/dashboard/plugins/slugify/slugify.min.js") }}"></script>
<script>
    $(document).ready(function() {
        $('#title').on("input", () => {
            $('#slug').val($.slugify($('#title').val()));
        });
        $('#category').select2({
            theme: 'bootstrap4'
        });

        $('#tags').select2({
            tags: true,
        });
        $("#content").summernote({
            placeholder: 'Write content...',
            height: 170,
        });
    });
</script>
@endsection
