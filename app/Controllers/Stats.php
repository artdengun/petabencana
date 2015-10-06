 <?php
namespace Controllers;
use Resources, Models;

class Stats extends Resources\Controller
{
    public function index()
    {
         $this->output('stats/main');
    }
}
