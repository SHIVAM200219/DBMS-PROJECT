<h1> Mehta Family School of DS&AI Research Portal. </h1>

 A portal that allows one to explore the research activities of the faculties at MFSDS&AI, IIT Guwahati.
 
 <h3> Dataset: </h3>
 
 1."prof_data.csv" : Contains faculties data.
 
 2."research_data.csv": Contain research papers data written by faculty member during 2018-2023.
 
 3."domain_data.csv": Contain unique keys to identify domains (research areas).
 
 4."coauthors.csv" : MFDSAI faculty members co-authors data.
 
 5."citations_year.csv": MFDSAI faculty members lifetime citations count year wise.
 
 6."relation_pid_to_rid.csv": Mapping of faculty id to their research papers ids'. 
 
 7."research_paper_domain_label.csv": Mapping of each research papers id to its corresponding research ares code (domain).
 
<b> <h4> ER Model used: </h4> </b>
 
 
 
 <img width="677" alt="image" src="https://user-images.githubusercontent.com/95133586/235427654-0bdff8e1-e593-4a4c-a733-6e9e999ef07d.png">
 
 
 
 <h3> MySQL user specification to access the website - </h3>
 
$servername = "localhost"; <br>
$port_no = 3306; <br>
$username = "dbms";<br>
$password = "project";<br>
$myDB = "research";

