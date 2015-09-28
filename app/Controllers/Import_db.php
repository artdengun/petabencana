<?php
namespace Controllers;
use Resources, Models;

class Import_db extends Resources\Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->db = new Resources\Database;
	}
	
    public function index()
    {
        echo "hello world :D!!!";
    }

    public function get_csv()
    {
    	$file = fopen("http://localhost/petabencana/public/assets/data/bencana-banjir-clean.csv","r");
		    
		while(! feof($file))
		{
		  	$rows = fgetcsv($file);
		  	$temp_date = date_format(date_create($rows[2]), 'Y-m-d');
		  	$disaster_time = explode(" ", $rows[3]);
		  	
		  	$temp_disaster_time = (substr_count(str_replace('.', ':', $disaster_time[0]), ':') == 2 ? $disaster_time[0] : str_replace('.', ':', $disaster_time[0]).":00" );
		  	$temp_disaster_time = ( substr_count($temp_disaster_time, ':') == 1 ? "00:00:00" : $temp_disaster_time );
		  	$time_zone = (isset($disaster_time[1]) ? $disaster_time[1] : "" );

			
		  	echo $rows[1]
		  		." --- ".$temp_date
		  		." --- ".$temp_disaster_time
		  		." --- ".$time_zone
		  		." --- ".$rows[4]
		  		." --- ".$rows[5]
		  		." --- ".$rows[6]
		  		."<br/>";
		  	

		  	/*$query = $this->db->insert('bencana', 
		  			array(
		  				'jenis' => $rows[1], 
		  				'tanggal' => $temp_date,
		  				'jam'	  => $temp_disaster_time,
		  				'zona_waktu' => $time_zone,
		  				'langitude' => $rows[4],
		  				'latitude' => $rows[5],
		  				'lokasi' => $rows[6],
		  				'korban' => $rows[7],
		  				'kerugian' => $rows[8],
		  				'keterangan' => $rows[9]
		  			)
		  		); 
			
			ob_flush();
		  	flush();
		  	echo "lagi ngimport....<br/>";*/
		}
		
		echo "berhasil diimport";
		  	
		fclose($file);
    }
}
