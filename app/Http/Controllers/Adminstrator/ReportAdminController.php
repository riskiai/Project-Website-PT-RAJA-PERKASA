<?php

namespace App\Http\Controllers\Adminstrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportAdminController extends Controller
{
    public function reportproyek() {
        return view('Adminstrator.report.reportdataproyek');
    }

    public function reportjasa() {
        return view('Adminstrator.report.reportdatajasa');
    }

    public function reportmitra() {
        return view('Adminstrator.report.reportdatamitra');
    }

    public function reporttestimoni() {
        return view('Adminstrator.report.reportdatatestimoni');
    }

    public function reportusers() {
        return view('Adminstrator.report.reportdatausers');
    }
}
