<?php

namespace Controllers;

use Resources, Models;
use Phastlight;
// require '/var/www/html/petabencana/panada/vendor/autoload.php';

class Stats extends Resources\Controller
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
}
