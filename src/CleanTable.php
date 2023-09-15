<?php
namespace edrard\Zimbra;

use edrard\Log\MyLog;
use edrard\DbCreate\DB;
use Carbon\Carbon;


class CleanTable
{
    protected $db;
    protected $config;

    function __construct(DB $db,$config){
        $this->db = $db;
        $this->config = $config;
    }
    public function runProcess(){

        //delete from trends_uint where itemid=1839297 and clock<1694694378
        foreach($this->config['clene_tables'] as $table => $data){
            $queue = $this->db->table($table)->where($data['row'], '<', $this->calcTime($data['days']))->delete();
        }
        return;
    }
    private function calcTime($days){
        $dt = Carbon::now();
        $dt->subDays($days);
        return $dt->timestamp;
    }
}
