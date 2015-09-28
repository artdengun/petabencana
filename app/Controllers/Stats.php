<?php
namespace Controllers;
use Resources, Models;

class Stats extends Resources\Controller
{
    public function index()
    {
        $data['title'] = 'Peta Bencana - Statistik';

        $this->output('home', $data);
    }
}
