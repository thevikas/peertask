<?php
class TestLogger extends CLogger
{
    public function log($message,$level='info',$category='application')
    {
        if($level != 'error')
            return;
        global $dontthrowlogger,$last_log;
        $last_log = $message;
        if(!isset($dontthrowlogger) || !$dontthrowlogger)
        {
            throw new CExceptionLogError($message);
        }
    }
}

