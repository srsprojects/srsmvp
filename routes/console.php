<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('findmysdump', function() {

    // 1st: use mysqldump location from `which` command.
    $mysqldump = `which mysqldump`;
    if (is_executable($mysqldump)) return $mysqldump;
  
    // 2nd: try to detect the path using `which` for `mysql` command.
    $mysqldump = dirname(`which mysql`) . "/mysqldump";
    if (is_executable($mysqldump)) return $mysqldump;
  
    // 3rd: detect the path from the available paths.
    // you can add additional paths you come across, in future, here.
    $available = array(
      '/usr/bin/mysqldump', // Linux
      '/usr/local/mysql/bin/mysqldump', //Mac OS X
      '/usr/local/bin/mysqldump', //Linux
      '/usr/mysql/bin/mysqldump' //Linux
     );
    foreach($available as $apath) {
      if (is_executable($apath)) $this->comment($apath);
    }
    // 4th: auto detection has failed!
    // lets, throw an exception, and ask the user to provide the path instead, manually.
    $message  = "Path to \"mysqldump\" binary could not be detected!\n";
    $message .= "Please, specify it inside the configuration file provided!";
    throw new RuntimeException($message);
  })->purpose('Find mysqldump path');