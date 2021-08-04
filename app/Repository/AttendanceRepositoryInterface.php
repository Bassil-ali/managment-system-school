<?php


namespace App\Repository;


interface AttendanceRepositoryInterface
{
    public function index();

    public function Attendance_tomo($id);

    public function show($id);

    public function store($request);

    public function update($request);

    public function destroy($request);
}
