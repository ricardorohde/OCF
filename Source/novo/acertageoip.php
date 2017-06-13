<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/sessao.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bd.php");
include($_SERVER['DOCUMENT_ROOT']."/geoipcity.inc");
?>
<?php

		$gi = geoip_open($_SERVER['DOCUMENT_ROOT']."/geoip/GeoLiteCity.dat",GEOIP_STANDARD);
        $db = new BD();
        $db2 = new BD();

        $sql = sprintf ("select sequencia,ip,datahora,cidade from log_usuario where cidade is null
and datahora >= '2008-01-01 00:00' and ip is not null order by sequencia");

        $db->Query($sql);
//        $db->Next();
		
        while($db->Next()) {
    	      echo ($db->getValue("sequencia")." ".$db->getValue("ip")." ".$db->getValue("cidade"));

              $geoip = geoip_record_by_addr($gi,$db->getValue("ip"));

			  $sql = sprintf("update log_usuario
			  				set cidade='%s',
								estado='%s',
								pais='%s'
							where
							sequencia=%d",
							$geoip->city,
							RetornaEstado($geoip->country_code,$geoip->region),
							$geoip->country_name,
				            $db->getValue("sequencia"));
	           $db2->Exec($sql);
			}
		   
        $db->Close();
        $db2->Close();

		geoip_close($gi);

function RetornaEstado($pais,$regiao) {
        require_once($_SERVER['DOCUMENT_ROOT']."/geoipregionvars.php");

     	return $GEOIP_REGION_NAME[$pais][$regiao];

	}

?>