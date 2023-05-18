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
1. Home :-  Overview
            (a) Descriptions - Why Data Science ? And How IITG & MFSDSAI meets the requirements.
            (b) A spline plot to show Citations Per Year Counts for our Core Faculty.
            (c) How Data Science and Artificial Intelligence is gaining more popularity as compared to other domains 
                of Engineering.

2. Professors :- Contains Informations of all Professors
            (a) One can visit Faculty Portfolio Website by clicking on respective name.
            (b) One can send email, make Phone Call by clicking respective links.
            (c) One can know the research areas of respective Professor.

3. Research :- Contains Research Paper related informations
            (a) One can search for any of the following fields :
                (i) Professor Name (ii) Research Domain (iii) Year Published (iv) Research Paper
                *You can apply multiple fields at a time to get intersection of all the individual results.
            (b) One can select type of plotting for data visualization of No. of Research Papers per Professor & No. 
                of research Papers per Domain.
            (c) A checkbox named Only MFSDSAI, can be ticked to get only those papers which were published under    
                MFSDSAI.
            (d) You will get a Tabular results as well as a plotting. Tabular results contain following fields :
                (i) Professor Name (ii) Title of Research Paper (iii) Citation Counts (iv) Authors (v) Publication 
                    Date (vi) Publisher (vii) Conference/Journal (viii) Domain
            (e) In Tabular results, Professor Name contain a link to Professor Portfolio Website & Title of Research 
                Paper contain a link to respective Research Paper.

4. Query :- Contains Research Informations related to Faculty, Year and Domain
            (a) One can search for a faculty, will get following results:
                (i) A bar plot of Citation Count per Year.
                (ii) A doughnut Plot of all Co-author worked with that faculty.
                (iii) Most Citated Paper with Citation Counts, Most active domain, Publishers, Domain of first and 
                    last papers of that faculty.

            (b)  One can search for a year, will get following results:
                (i) A bar plot of Paper Count in each domain.
                (ii) Most explored domain in that year and Publishers of that year.

            (c) One can search for a domain, will get following results:
                (i) A bar plot of Paper Count in each year.
                (ii) Most explored domain in that domain and Publishers of that domain.

5. Analysis :- Contains few analysis of Mehta Family School of Data Science and Artificial Intelligence
            (a) A bar plot of paper counts in different Research Areas. 
            (b) A bar plot of paper counts of each Professors. 
            (c) A bar plot of Citation Counts of each professors (lifetime and since 2018). 
            (d) A pie plot of Distribution of Domains of Research Papers. 
            (e) A bar plot of paper counts of frequent Publishers. 


