<?php
$dataPoints6 = array();
$exclude = array(5,15,20,22,27,28,34);
		  for ($i = 1; $i < 38 ; $i++){
		  if ( !in_array($i, $exclude) ){
          $stmt6 = $conn6->query("SELECT dname AS 'label' ,SUM(SUBSTRING(rdomain_label,$i,1)) AS 'y' 
		  FROM research.research_paper_domain_label R ,research.domain_data P 
		  WHERE P.did = $i");
          while ($row = $stmt6->fetch(PDO::FETCH_ASSOC)) {
			array_push($dataPoints6 ,$row);
               }
			}}
        ?>
