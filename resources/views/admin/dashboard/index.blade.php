@extends('admin.layouts.app')
@section('title', ' - Admin | Dashboard')
@section('style')
    <link rel="stylesheet" href="{{ asset('public/assets/datatables/jquery.dataTables.min.css') }}">
    <style>
        .large-font {
            font-size: 24px;
            /* Adjust the font size as needed */
        }

        .box {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .box .item {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
    </style>
@endsection
@section('content')

    <section class="content">

        <div class="row">

            <p>sdfsdfsdfsdfsdfsdf</p>
        </div>


    </section>
@endsection

@section('script')
    <script src="{{ asset('public/assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/dashboard/index.js') }}"></script>
@endsection
