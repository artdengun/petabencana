<?php

namespace Controllers;

use Resources, Models;
use Phastlight;
// require '/var/www/html/petabencana/panada/vendor/autoload.php';

class Async_test extends Resources\Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->simplehtmldom = Resources\Import::vendor('simplehtmldom/simple_html_dom');
        Resources\Import::composer();
    }

    public function index()
    {
         $this->output('stats/main');
    }

    public function test_amp_1()
    {
		echo "before run()\n";

		\Amp\run(function() {
		    \Amp\repeat(function(){
                echo "tick\n";
            }, $msInterval = 1000);
		    \Amp\once("\Amp\stop", $msDelay = 5000);
		});

		echo "after run()\n";
    }

    public function test_react_1()
    {
        $loop = \React\EventLoop\Factory::create();

        $loop->addTimer(
            1,
            function () {
                echo 'timer' . PHP_EOL;
            }
        );

        $loop->nextTick(
            function ($loop) {
                echo 'next-tick #1' . PHP_EOL;

                $loop->nextTick(
                    function () {
                        echo 'next-tick #2' . PHP_EOL;
                    }
                );
            }
        );

        $loop->futureTick(
            function ($loop) {
                echo 'future-tick #1' . PHP_EOL;

                $loop->futureTick(
                    function () {
                        echo 'future-tick #2' . PHP_EOL;
                    }
                );
            }
        );

        $loop->run();
    }

    public function test_react_2()
    {
        $deferred = new \React\Promise\Deferred();
        $promise = $deferred->promise()
                        -> then(
                            function ($value)
                            {
                                sleep(5);
                                echo "hhaha 1".$value;
                            
                            })
                        -> then(
                            function ($value)
                            {
                                sleep(3);
                                echo "hhaha 2".$value;
                            
                            })
                        -> then(
                            function ($value)
                            {
                                echo "hhaha 3".$value;
                            
                            });

        $deferred->resolve('abc');
    }

    public function test_react_3()
    {
        $loop = \React\EventLoop\Factory::create();
        $filesystem = \React\Filesystem\Filesystem::create($loop);
    }

    public function test_readfile()
    {
        $time_start = microtime(true);

        echo "reading file is started....<br/>";

        $result = file_get_contents('./assets/data/access.log');
        echo str_word_count($result);

        echo "<br/>";

        $result = file_get_contents('./assets/data/error.log');
        echo str_word_count($result);

        echo "<br/>reading file is finish....<br/>";


        $time_end = microtime(true);
        $time = $time_end - $time_start;

        echo "Execution time: $time seconds<br/>";

    }

    public function test_readfile_eio()
    {
        $time_start = microtime(true);

        echo "reading file is started....<br/>";

        $file_open_cb = function ($data, $result)
        {
            eio_read($result, 10485760, 0, EIO_PRI_DEFAULT, function($data, $result){
                echo str_word_count($result)."<br/>";
                eio_close($data);
            }, $result);
        };

        $filename = './assets/data/access.log';
        eio_open($filename, 
                    EIO_O_RDWR, NULL, 
                    EIO_PRI_DEFAULT, 
                    $file_open_cb, 
                    $filename);

        $filename = './assets/data/error.log';
        eio_open($filename, 
                    EIO_O_RDWR, NULL, 
                    EIO_PRI_DEFAULT, 
                    $file_open_cb, 
                    $filename);

        echo "reading file is finish....<br/>";
        
        eio_event_loop();
        
        $time_end = microtime(true);
        $time = $time_end - $time_start;

        echo "Execution time: $time seconds<br/>";
    }
}
