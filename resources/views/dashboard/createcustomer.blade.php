@extends('layout.dashboard.master')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Customers</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        @if($errors->any())
            <div class="container alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="container">
                    <form action="{{ route('customer.store') }}" method="POST">
                        @csrf
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" id="firstname" name="firstname" class="form-control"
                                        placeholder="First name" />
                                    <label class="form-label" for="firstname">First name</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input type="text" id="lastname" name="lastname" class="form-control"
                                        placeholder="Last name" />
                                    <label class="form-label" for="lastname">Last name</label>
                                </div>
                            </div>
                        </div>

                        <!-- Text input -->
                        <div class="form-floating mb-3">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" />
                            <label class="form-label" for="email">Email</label>
                        </div>

                        <!-- Text input -->
                        <div class="form-floating mb-3">
                            <input type="text" id="phone_number" name="phone_number" class="form-control"
                                placeholder="Phone Number" />
                            <label class="form-label" for="phone_number">Phone Number</label>
                        </div>

                        <!-- Email input -->
                        <div class="form-floating mb-3">
                            <input type="date" id="birthdate" name="birthdate" class="form-control"
                                placeholder="Birth Date" />
                            <label class="form-label" for="birthdate">Birth Date</label>
                        </div>

                        <!-- Message input -->
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="notes" name="notes" placeholder="Notes" rows="8"></textarea>
                            <label class="form-label" for="notes">Notes</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">Add</button>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
