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

    protected function flusher($val)
    {
        echo $val."--";
        flush();
        ob_flush();
        usleep(500);
    }
}
