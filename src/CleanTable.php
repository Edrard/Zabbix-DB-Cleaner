<?php
namespace edrard\Zimbra;

use edrard\Log\MyLog;
use edrard\Log\Timer;
use edrard\DbCreate\DB;
use Carbon\Carbon;


class CleanTable
{
    protected $db;
    protected $config;

    function __construct(DB $db,$config){
        $this->db = $db;
        $this->config = $config;
        MyLog::info('Cleaning process initialized' ,array());
    }
    public function runProcess(){
        try{
            foreach($this->config['clene_tables'] as $table => $data){
                MyLog::info('Starting cleaning for table: ' . $table ,$data);
                Timer::startTime($table);
                $queue = $this->db->table($table)->where($data['row'], '<', $this->calcTime($data['days']))->delete();
                MyLog::info('Cleansing for table ' .$table . ' is finished in: ' .Timer::getTime($table). ' seconds' ,array());
            }
        } catch (\Exception $error) {
            MyLog::error('Error: ' . $error->getMessage() ,array());
        }
        return;
    }
    private function calcTime($days){
        $dt = Carbon::now();
        $dt->subDays($days);
        return $dt->timestamp;
    }
}
