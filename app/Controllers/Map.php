<?php
namespace Controllers;
use Resources, Models;

class Map extends Resources\Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->db = new Resources\Database;
        $this->bencana = new Models\Bencana;
        $this->simplehtmldom = Resources\Import::vendor('simplehtmldom/simple_html_dom');
        
    }

    public function index()
    {
        $this->output('map/main');
    }

    public function init_map_process()
    {
        $results = $this->bencana->get_initial_data();
        
        header('Content-type: text/html; charset=utf-8');
        
        $this->flusher('{"start":"1"}');
        
        for( $i = 0 ; $i < count($results); $i++ )
        {
            $this->flusher('{"no":"'.$i
                                .'", "jenis":"'.$results[$i]->jenis
                                .'", "tanggal":"'.$results[$i]->tanggal
                                .'", "langitude":"'.$results[$i]->langitude
                                .'", "latitude":"'.$results[$i]->latitude
                                .'", "jam":"'.$results[$i]->jam
                                .'", "zona_waktu":"'.$results[$i]->zona_waktu
                                .'", "lokasi":"'.$results[$i]->lokasi
                                .'", "korban":"'.$results[$i]->korban
                                .'", "kerugian":"'.$results[$i]->kerugian
                                .'", "keterangan":"'.$results[$i]->keterangan
                                .'"}');
        }

        $this->flusher('{"end":"1"}');
    }

    public function search_disaster_process()
    {

        $post_data = $_POST;
        $results = $this->bencana->search_disaster($post_data);
        
        header('Content-type: text/html; charset=utf-8');
        
        $this->flusher('{"start":"1"}');
        
        for( $i = 0 ; $i < count($results); $i++ )
        {
            $this->flusher('{"no":"'.$i
                                .'", "jenis":"'.$results[$i]->jenis
                                .'", "tanggal":"'.$results[$i]->tanggal
                                .'", "langitude":"'.$results[$i]->langitude
                                .'", "latitude":"'.$results[$i]->latitude
                                .'", "jam":"'.$results[$i]->jam
                                .'", "zona_waktu":"'.$results[$i]->zona_waktu
                                .'", "lokasi":"'.$results[$i]->lokasi
                                .'", "korban":"'.$results[$i]->korban
                                .'", "kerugian":"'.$results[$i]->kerugian
                                .'", "keterangan":"'.$results[$i]->keterangan
                                .'"}');
        }

        $this->flusher('{"end":"1"}');

    }

    public function realtime()
    {
        $this->output('map/realtime');
    }

    public function realtime_map_process()
    {
        // $html = file_get_html('http://localhost/petabencana/public/assets/data/gempa-bumi-bmkg.html');
        $html = file_get_html('http://www.bmkg.go.id/BMKG_Pusat/Gempabumi_-_Tsunami/Gempabumi/Gempabumi_Terkini.bmkg');

        $e = $html->find('table.ft11 tr');
        header('Content-type: text/html; charset=utf-8');

        $this->flusher('{"start":"1"}');
        
        foreach ($e as $item)
        {
            if ($this->simplehtmldom->load($item)->find('td', 1) != ""){
                $row = "{";
                $row .= '"waktu":"'.$this->simplehtmldom->load($item)->find('td', 1)->innertext.'",';
                $row .= '"latitude":"'.$this->simplehtmldom->load($item)->find('td', 2)->innertext.'",';
                $row .= '"langitude":"'.$this->simplehtmldom->load($item)->find('td', 3)->innertext.'",';
                $row .= '"magnitude":"'.$this->simplehtmldom->load($item)->find('td', 4)->innertext.'",';
                $row .= '"kedalaman":"'.$this->simplehtmldom->load($item)->find('td', 5)->innertext.'",';
                $row .= '"lokasi":"'.htmlentities($this->simplehtmldom->load($item)->find('td', 6)->innertext).'"';
                $row .= "}";
                $this->flusher($row);  
            } 
        }

        $this->flusher('{"end":"1"}');
    }

    protected function flusher($val)
    {
        echo $val."--";
        flush();
        ob_flush();
        usleep(500);
    }
}
