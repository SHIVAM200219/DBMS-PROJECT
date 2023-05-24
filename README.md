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
 
<b> <h3> ER Model used: </h3> </b>
 
 
 
 <img width="677" alt="image" src="https://user-images.githubusercontent.com/95133586/235427654-0bdff8e1-e593-4a4c-a733-6e9e999ef07d.png">
 
 
 
 <h3> MySQL user specification to access the website - </h3>
 
$servername = "localhost"; <br>
$port_no = 3306; <br>
$username = "dbms";<br>
$password = "project";<br>
$myDB = "research";

<h3>Pagewise Specificatons: </h3> <br>
<h4>
1. <b> Home </b> :-  </h4>
   <h5> Preview </h5> <br> <img width="600" height= '500' alt="Home" src="https://github.com/SHIVAM200219/DBMS-PROJECT/assets/95133586/3ebb7201-78c4-46a4-acf8-2dc4aa24bd17"><br>
    Overview <br>
            (a) Descriptions - Why Data Science ? And How IITG & MFSDSAI meets the requirements. <br>
            (b) A spline plot to show Citations Per Year Counts for our Core Faculty. <br>
            (c) How Data Science and Artificial Intelligence is gaining more popularity as compared to other domains 
                of Engineering. <br>
<h3>
2. <b> Professors </b> :- Contains Informations of all Professors <br> </h3>
    <h5> Preview : <br></h5> <img width="800" height= '500' alt="Professors" src="https://github.com/SHIVAM200219/DBMS-PROJECT/assets/95133586/6c63dbea-b694-4435-91ba-14be967d6f03">
    <br> Overview <br>
            (a) One can visit Faculty Portfolio Website by clicking on respective name. <br>
            (b) One can send email, make Phone Call by clicking respective links. <br>
            (c) One can know the research areas of respective Professor. <br>
<h3>
3. <b> Research </b> :- Contains Research Paper related informations <br></h3><br>
Preview :<br> <img width="800" height= '500' alt="Research" src="https://github.com/SHIVAM200219/DBMS-PROJECT/assets/95133586/9a68eeda-5dbd-4675-9a58-2c49c64491ea">

 <br> Overview : <br>
            (a) One can search for any of the following fields :
                (i) Professor Name (ii) Research Domain (iii) Year Published (iv) Research Paper <br>
                *You can apply multiple fields at a time to get intersection of all the individual results.* <br>
            (b) One can select type of plotting for data visualization of No. of Research Papers per Professor & No. 
                of research Papers per Domain. <br>
            (c) A checkbox named Only MFSDSAI, can be ticked to get only those papers which were published under    
                MFSDSAI. <br>
            (d) You will get a Tabular results as well as a plotting. Tabular results contain following fields : 
                (i) Professor Name (ii) Title of Research Paper (iii) Citation Counts (iv) Authors (v) Publication 
                    Date (vi) Publisher (vii) Conference/Journal (viii) Domain <br>
            (e) In Tabular results, Professor Name contain a link to Professor Portfolio Website & Title of Research 
                Paper contain a link to respective Research Paper. <br>

<h3 > 4. <b> Query </b> :- Contains Research Informations related to Faculty, Year and Domain <br> </h3>
Preview :<br> <img width="800" height= '500' alt="Query" src="https://github.com/SHIVAM200219/DBMS-PROJECT/assets/95133586/fbbc5f28-812f-474b-bdd3-a6c0c7c600b6">

<br> Overview : <br>
            (a) One can search for a faculty, will get following results: <br>
                (i) A bar plot of Citation Count per Year. <br>
                (ii) A doughnut Plot of all Co-author worked with that faculty. <br>
                (iii) Most Citated Paper with Citation Counts, Most active domain, Publishers, Domain of first and 
                    last papers of that faculty. <br>
            (b)  One can search for a year, will get following results: <br>
                (i) A bar plot of Paper Count in each domain. <br>
                (ii) Most explored domain in that year and Publishers of that year. <br>
            (c) One can search for a domain, will get following results:<br>
                (i) A bar plot of Paper Count in each year. <br>
                (ii) Most explored domain in that domain and Publishers of that domain. <br>

<b> <h3> 5. Analysis :- </b> Contains few analysis of Mehta Family School of Data Science and Artificial Intelligence <br> </h3>
Preview :<br> <img width="800" height= '500' alt="Analysis" src="https://github.com/SHIVAM200219/DBMS-PROJECT/assets/95133586/883ca057-5cc5-4256-aeab-39554fc89015">

<br>
Overview :<br>
            (a) A bar plot of paper counts in different Research Areas.  <br>
            (b) A bar plot of paper counts of each Professors. <br>
            (c) A bar plot of Citation Counts of each professors (lifetime and since 2018). <br>
            (d) A pie plot of Distribution of Domains of Research Papers. <br>
            (e) A bar plot of paper counts of frequent Publishers. <br>


