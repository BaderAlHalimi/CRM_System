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
                        <h1 class="m-0">Trashed Customers</h1>
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
                            <th scope="col">deleted at</th>
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
                                <td>{{ $ctm->deleted_at }}</td>
                                <td>
                                    <a href="{{ route('customer.restore', ['customer' => $ctm->id]) }}"
                                        class="btn btn-outline-primary"><i class="fa-solid fa-rotate-left"></i></a>
                                    <form style="display: inline-block"
                                        action="{{ route('customer.forcedelete', ['customer' => $ctm->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
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
