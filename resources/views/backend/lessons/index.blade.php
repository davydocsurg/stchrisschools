@extends('layouts.master')

@section('title')
    Manage Lessons
@endsection

<style>
    @media screen and (max-width:360px) {
        .card-tools {
            margin-top: 1.2rem !important;
        }
    }

</style>

@section('page_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lessons</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('lessons.create') }}" class="btn btn-outline-success">
                            Create Lessons <i class="fas fa-book"></i>
                        </a>
                        {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teachers</li> --}}
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header row">
                    <div class=" col-md-6 col-sm-12">
                        <a class="btn btn-info" onclick="refreshPage()">
                            Refresh <i class="spinner-border spinner-border-sm mb-1 " id="refresh"
                                style="display: none"></i>
                        </a>
                    </div>

                    <div class="card-tools col-md-6 col-sm-12">
                        <div class="input-group input-group-sm  float-right" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    @if ($lessons->count() > 0)
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Class</th>
                                    <th>Title</th>
                                    <th>Document/Video</th>
                                    <th>Description</th>
                                    {{-- <th>Created At</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @foreach ($lessons as $lesson)
                                <tbody>
                                    <tr>
                                        <td>{{ $lesson->id }}</td>
                                        <td>
                                            <span class="badge badge-info badge-sm">
                                                {{ $lesson->class_lesson->class_name }}
                                            </span>
                                        </td>

                                        <td>{{ $lesson->lesson_title }}</td>
                                        <td>
                                            @if ($lesson->lesson_video)
                                                <div class="col-lg-8 col-sm-12 col-md-12">
                                                    <video class="vid-width shadow-lg" width="320" controls v-scrollAnime>
                                                        {{-- {{ dd($lesson->lesson_video) }} --}}
                                                        <source
                                                            src="{{ url('storage/lessons/videos/' . $lesson->lesson_video) }}"
                                                            type="video/mp4" />

                                                        <source
                                                            src="{{ url('storage/lessons/videos/' . $lesson->lesson_video) }}"
                                                            type="video/ogg" />
                                                    </video>
                                                </div>
                                                {{-- </td> --}}
                                            @else
                                                {{-- <td> --}}
                                                <span class="badge badge-dark badge-sm">
                                                    No Video Uploaded
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ substr($lesson->lesson_description, 0, 100) }}...
                                        </td>

                                        {{-- <td>{{ $lesson->created_at }}</td> --}}

                                        <td>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a href="{{ route('lessons.show', $lesson->id) }}"
                                                        class="btn btn-outline-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>

                                                <div class="col-md-4">
                                                    <a href="{{ route('lessons.edit', $lesson->id) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>

                                                <div class="col-md-4">
                                                    <button class="btn btn-outline-danger btn-sm delModBtn" id="delModBtn"
                                                        data-url="{{ route('lessons.destroy', $lesson->id) }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                                @include('backend.modals.delete',['name' => 'lesson'])

                            @endforeach

                        @else
                            <div class="p-5 text-center">
                                <h6 class="display-4 text-dark ">
                                    No Lessons found
                                </h6>

                                <a href="{{ route('lessons.create') }}" class="btn btn-outline-success">
                                    Create Lessons <i class="fas fa-book"></i>
                                </a>
                            </div>

                    @endif
                    </table>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    {{ $lessons->links() }}
                </div>
                <!-- /.card-footer -->

            </div>
            <!-- /.card -->
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // var sources = document.querySelectorAll('source');
        // var source_errors = 0;
        // for (var i = 0; i < sources.length; i++) {
        //     sources[i].addEventListener('error', function(e) {
        //         if (++source_errors >= sources.length)
        //             fallBack();
        //     });
        // }

        // function fallBack() {
        //     document.body.removeChild(document.querySelector('video'));
        //     document.body.appendChild(document.createTextNode('No video with supported media and MIME type found'));
        // }

        $(function() {
            $(".delModBtn").on("click", function(e) {
                e.preventDefault();
                $("#deleteModal").modal("show");
                var url = $(this).attr('data-url');
                $("#deleteForm").attr("action", url);
            })


        })

    </script>
@endpush
