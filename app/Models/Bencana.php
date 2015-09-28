<?php
namespace Models;
use Resources;

class Bencana {
    
    public function __construct()
    {
    	$this->db = new Resources\Database;
    }

    public function get_initial_data()
    {
    	$results = $this->db->results('SELECT * FROM  bencana order by tanggal desc limit 0, 20');

    	return $results;
    }

    public function search_disaster($temp_POST)
    {
    	$_POST = $temp_POST;

    	$criteria = " where 1 ";

        // mengatur paging hasil pencarian
        // mengatur kriteria berdasarkan tanggal
        if (isset($_POST['start-range']) && isset($_POST['end-range']))
        {
            $criteria .= ' and date(tanggal) >= date("'.$_POST['start-range'].'") and date(tanggal) <= date("'.$_POST['end-range'].'") ';
        }

        // mengatur kriteria berdasarkan kategori
        if (isset($_POST['jenis_bencana']))
        {
            $jenis_bencana = "(";
            $idx = 1;
            foreach ($_POST['jenis_bencana'] as $bencana)
            {
                $temp_bencana = ucwords(str_replace("_", " ", $bencana));

                $jenis_bencana .= '"'.$temp_bencana.'"';

                if ($idx < count($_POST['jenis_bencana']))
                {
                    $jenis_bencana .= ', ';
                }

                $idx ++;
            }
            
            $jenis_bencana .= ")";
                                                                                 
            $criteria .= " and jenis in ".$jenis_bencana;
        }

        // mengatur kriteria berdasarkan keyword
        if (isset($_POST['keywords']))
        {
            $criteria .= ' and lokasi like "%'.$_POST['keywords'].'%"';
        }

        // mengatur limit data;
        $limit = "";
        if (isset($_POST['limit_data']))
        {
            $limit = " LIMIT 0, ".$_POST['limit_data'];
        }

        // mengatur query utama
        // menampilkan hasil pencarian kedalam berupa json
        $query = 'SELECT * FROM  bencana '.$criteria.' order by tanggal desc '.$limit;

        $results = $this->db->results($query);

        return $results;
    }
}
