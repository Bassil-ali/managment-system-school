@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    قائمه الغياب لهذا القسم
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
قائمه الغياب لهذا القسم
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
<div class="col-md-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">
            <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                data-page-length="50" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th class="alert-success">#</th>
                                        <th class="alert-success">{{ trans('Students_trans.name') }}</th>
                                        <th class="alert-success">{{ trans('Students_trans.email') }}</th>
                                        <th class="alert-success">{{ trans('Students_trans.gender') }}</th>
                                        <th class="alert-success">{{ trans('Students_trans.Grade') }}</th>
                                        <th class="alert-success">{{ trans('Students_trans.classrooms') }}</th>
                                        <th class="alert-success">{{ trans('Students_trans.section') }}</th>
                                        <th class="alert-success">Time</th>
                                        <th class="alert-success">{{ trans('Students_trans.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->gender->Name }}</td>
                                            <td>{{ $student->grade->Name }}</td>
                                            <td>{{ $student->classroom->Name_Class }}</td>
                                            <td>{{ $student->section->Name_Section }}</td>
                                            <td>{{ $student->created_at }}</td>
                                            <td>

                                                @if(isset($student->attendance()->where('attendence_date',date('Y-m-d'))->first()->student_id))

                                                <label
                                                    class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                    <input name="attendences[{{ $student->id }}]" disabled
                                                        {{ $student->attendance()->first()->attendence_status == 1 ? 'checked' : '' }}
                                                        class="leading-tight" type="radio" value="presence">
                                                    <span class="text-success">حضور</span>
                                                </label>

                                                <label class="ml-4 block text-gray-500 font-semibold">
                                                    <input name="attendences[{{ $student->id }}]" disabled
                                                        {{ $student->attendance()->first()->attendence_status == 0 ? 'checked' : '' }}
                                                        class="leading-tight" type="radio" value="absent">
                                                    <span class="text-danger">غياب</span>
                                                </label>

                                            </td>
                        </div>
                        @endif
                        @endforeach
                        </tbody>
                        </table>
                        <!-- row closed -->
                    @endsection
                    @section('js')
                        @toastr_js
                        @toastr_render
                    @endsection
