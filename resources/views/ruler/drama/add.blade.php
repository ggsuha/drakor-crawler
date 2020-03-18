@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Add Drama</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Drama</li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <form method="POST" action="{{ route('admin.drama.add') }}">
                        @csrf
                        <div class="form-group">
                            <label class="small mb-1" for="link">Link</label>
                            <input class="form-control py-3" id="link" type="text" name="link" required autocomplete="link" autofocus />
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mt-3 mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
