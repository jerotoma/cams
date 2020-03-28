<?php
if (!function_exists('AuditRegister')) {
    function AuditRegister($module,$activity,$data){

        $ip_address=\Request::ip();
        $page=url()->current();

        $log=new \App\Audit;
        $log->username=\Auth::user()->username;
        $log->module=$module;
        $log->activity=$activity;
        $log->page=$page;
        $log->data=$data;
        $log->ip_address=$ip_address;
        $log->activity_date=date("Y-m-d");
        $log->log_time=date("Y-m-d H:i");
        $log->save();
    }
    return true;

}