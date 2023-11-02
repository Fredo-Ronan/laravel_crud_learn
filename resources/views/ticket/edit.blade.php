@extends('dashboard')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Ticket</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Ticket</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('ticket.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Class</label>
                                    <input type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class', $ticket->class) }}">
                                    @error('class')
                                    <div class="invalid-feedback">x
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $ticket->price) }}">
                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-bold">Movie</label>
                                    <select name="movie" class="form-control @error('movie') is-invalid @enderror">
                                        <option value="" disabled>Pilih Movie</option>
                                        @forelse($movie as $item)
                                        @if($item->title == $ticket->movie->title)
                                        <option value="{{ $item->title }}" selected>{{ $item->title }}</option>
                                        @else
                                        <option value="{{ $item->title }}">{{ $item->title }}</option>
                                        @endif
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('movie')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection