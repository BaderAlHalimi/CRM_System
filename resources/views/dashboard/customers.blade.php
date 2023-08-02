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
                        <h1 class="m-0">Customers</h1>
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
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="ml-auto mr-2">
                        <form class="col-4" style="display: inline-block" action="{{ route('customer.sort') }}"
                            method="post">
                            @csrf
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-10 mb-3">
                                    <select class="form-select form-select-lg" name="sort_method" id="">
                                        <option selected>Select sort method</option>
                                        <option value="1">A-Z</option>
                                        <option value="2">Z-A</option>
                                        <option value="3">Ascending date</option>
                                        <option value="4">Descending date</option>
                                    </select>
                                </div>
                                <div class="col-2 mb-3">
                                    <button class="btn btn-warning py-2">sort</button>
                                </div>
                            </div>
                        </form>
                        <ol class="breadcrumb float-sm-right">
                            <a class="btn btn-primary" href="{{ route('customer.create') }}"><i
                                    class="fa-solid fa-plus"></i> Add Customer</a>
                            <a class="btn btn-dark ml-2" href="{{ route('customer.trash') }}"><i
                                    class="fa-solid fa-trash-can"></i> Trash</a>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">phone</th>
                            <th scope="col">birth date</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($customers as $ctm)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $ctm->firstname . ' ' . $ctm->lastname }}</td>
                                <td>{{ $ctm->email }}</td>
                                <td>{{ $ctm->phone_number }}</td>
                                <td>{{ $ctm->birthdate }}</td>
                                <td>
                                    <a href="{{ route('customer.edit', ['customer' => $ctm->id]) }}"
                                        class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form style="display: inline-block"
                                        action="{{ route('customer.destroy', ['customer' => $ctm->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i
                                                class="fa-solid fa-trash-can"></i></button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
