from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

import time
from time import sleep
import pandas as pd
import math
from random import randint

from selenium.common.exceptions import NoSuchElementException


options = webdriver.ChromeOptions()
options.add_argument('log-level=3')
options.add_argument('--ignore-certificate-errors-spki-list')
options.add_argument('--ignore-ssl-errors')
# options.add_argument('--headless')
options.add_argument('--disable-gpu')
s = Service('D:\Sem 4\DA215 DBMS Lab\Project\chromedriver.exe')
driver = webdriver.Chrome(service=s,  options=options)
driver.maximize_window()


def webpagecompleteloaded(driver):
    return driver.execute_script("return document.readyState") == "complete"


def check_exists_by_xpath(xpath):
    try:
        driver.find_element(By.XPATH, xpath)
    except NoSuchElementException:
        return False
    return True


prof_data = pd.read_csv("prof_data.csv")

prof_df = pd.DataFrame(columns=['PID', 'Name', 'Department', 'Domain', 'Coauthors', 'All citations', 'Citations since 2018',
                       'All h-index', 'h-index since 2018', 'All i10-index', 'i10-index since 2018', 'Citations per year'])
paper_df = pd.DataFrame(columns=['RPID', 'Title', 'Citations', 'Year', 'Authors', 'Publication date',
                        'Journal', 'Conference', 'Volume', 'Description', 'Issue', 'Pages', 'Publisher', 'Link'])
prof_number = 1
for i in range(len(prof_data)):
    prof_id = []
    prof_name = []
    prof_dept = []
    prof_domain = []
    prof_coauthors = []
    prof_all_citations = []
    prof_citations_since_2018 = []
    prof_all_h_index = []
    prof_h_index_since_2018 = []
    prof_all_i10_index = []
    prof_i10_index_since_2018 = []
    prof_year_citations = {}
    prof_year_wise_citations = []

    ptitle = []
    pcitations = []
    pyear = []
    rpid = []
    pauthors = []
    pdate = []
    pjournal = []
    pconference = []
    pvolume = []
    pdescription = []
    pissues = []
    ppages = []
    ppublisher = []
    plink = []

    paper_dict = {'Authors': pauthors, 'Publication date': pdate, 'Journal': pjournal, 'Conference': pconference, 'Volume': pvolume,
                  'Description': pdescription, 'Issue': pissues, 'Pages': ppages, 'Publisher': ppublisher}
    url = prof_data.iloc[i, 2]

    # driver.get(
    #     'https://scholar.google.com/citations?hl=en&user=YwT89XIAAAAJ&view_op=list_works&sortby=pubdate')
    driver.get(url)
    while (webpagecompleteloaded(driver) == False):
        time.sleep(1)
        print("waiting for page to load")
    prof_id.append(i + 1)
    name = driver.find_element(By.XPATH, '//*[@id="gsc_prf_in"]')
    prof_name.append(name.text)
    dept = driver.find_element(By.XPATH, '//*[@id="gsc_prf_i"]/div[2]')
    prof_dept.append(dept.text)
    print("prof_name:", name.text)
    print("prof_dept:", dept.text)
    domain = []
    domain_elements = driver.find_elements(
        By.XPATH, '//*[@id="gsc_prf_int"]/a')
    for element in domain_elements:
        domain.append(element.text)
    prof_domain.append(domain)
    citation = driver.find_element(
        By.XPATH, '//*[@id="gsc_rsb_st"]/tbody/tr[1]/td[2]').get_attribute('innerHTML')
    citation_2018 = driver.find_element(
        By.XPATH, '//*[@id="gsc_rsb_st"]/tbody/tr[1]/td[3]').get_attribute('innerHTML')
    if (citation == ''):
        citation = 0
    else:
        citation = int(citation)
    print("prof_all_citation:", citation)
    prof_all_citations.append(citation)
    if (citation_2018 == ''):
        citation_2018 = 0
    else:
        citation_2018 = int(citation_2018)
    print("prof_citations_since_2018:", citation_2018)
    prof_citations_since_2018.append(citation_2018)
    hin = driver.find_element(
        By.XPATH, '//*[@id="gsc_rsb_st"]/tbody/tr[2]/td[2]').get_attribute('innerHTML')
    hin_2018 = driver.find_element(
        By.XPATH, '//*[@id="gsc_rsb_st"]/tbody/tr[2]/td[3]').get_attribute('innerHTML')
    prof_all_h_index.append(hin)
    prof_h_index_since_2018.append(hin_2018)

    i10 = driver.find_element(
        By.XPATH, '//*[@id="gsc_rsb_st"]/tbody/tr[3]/td[2]').get_attribute('innerHTML')
    i10_2018 = driver.find_element(
        By.XPATH, '//*[@id="gsc_rsb_st"]/tbody/tr[3]/td[3]').get_attribute('innerHTML')
    prof_all_i10_index.append(i10)
    prof_i10_index_since_2018.append(i10_2018)

    year = []
    cit = []
    # Getting years
    divs = driver.find_elements(
        By.XPATH, '//*[@id="gsc_rsb_cit"]/div/div[3]/div')
    for i in divs[0].find_elements(By.XPATH, './/span'):
        year.append(i.get_attribute('innerHTML'))

    # Getting year wise citations
    divs = driver.find_elements(
        By.XPATH, '//*[@id="gsc_rsb_cit"]/div/div[3]/div')
    for i in divs[0].find_elements(By.XPATH, './/a'):
        cit.append(i.get_attribute('text'))

    for i in range(len(year)):
        prof_year_citations[year[i]] = cit[1]
    print("prof_year_citations:", prof_year_citations)
    prof_year_wise_citations.append(prof_year_citations)

    ul = driver.find_elements(By.XPATH, '//*[@id="gsc_rsb_co"]/ul/li')
    for li in ul:
        div = li.find_element(By.XPATH, 'div')
        coauthor_name = div.find_element(By.XPATH, 'span[2]/a').text
        coauthor_affiliation = div.find_element(
            By.XPATH, 'span[2]/span[1]').text
        prof_coauthors.append([coauthor_name, coauthor_affiliation])

    # Clicking on YEAR button to sort the papers
    year_btn = driver.find_element(By.XPATH, '//*[@id="gsc_a_trh"]/th[3]')
    year_btn.click()
    time.sleep(2)
    while (check_exists_by_xpath('//*[@id="gsc_bpf_more"]/span')):
        rows = driver.find_elements(By.XPATH, '//*[@id="gsc_a_b"]/tr')
        flag1 = len(rows)
        button_show_more = driver.find_element(
            By.XPATH, '//*[@id="gsc_bpf_more"]/span')
        driver.execute_script(
            "arguments[0].scrollIntoView();", button_show_more)
        button_show_more.click()
        time.sleep(2)
        rows = driver.find_elements(By.XPATH, '//*[@id="gsc_a_b"]/tr')
        flag2 = len(rows)
        if (flag1 == flag2):
            break
        time.sleep(1)
    print('Clicked on see more button till the end.')
    rows = driver.find_elements(By.XPATH, '//*[@id="gsc_a_b"]/tr')
    paper_index = 1
    for row in rows:
        year = row.find_element(By.XPATH, 'td[3]')
        year_string = year.text
        if (year_string == ''):
            year_string = '0'
        # print('Looping through each research paper of a professor:')
        if (int(year_string) < 2018 and int(year_string) != 0):
            break
        print("Research paper number:", paper_index)
        paper_index = paper_index + 1
        print('Year:', year_string)
        pyear.append(year_string)
        citation = row.find_element(By.XPATH, 'td[2]')
        citation_string = citation.text
        if (citation_string == ''):
            citation_string = '0'
        print('Citation:', citation_string)
        pcitations.append(citation_string)
        title_link = row.find_element(By.XPATH, 'td[1]/a')
        href = title_link.get_attribute('href')
        plink.append(href)
        rpid.append(prof_number)
        driver.execute_script("window.open('%s', '_blank')" % href)
        time.sleep(2)
        if (len(driver.window_handles) < 2):
            print('no new window')
        else:
            driver.switch_to.window(driver.window_handles[1])
            wait = WebDriverWait(driver, 30)
            element = wait.until(EC.presence_of_element_located(
                (By.ID, 'gs_bdy_ccl')))

            title = driver.find_element(By.XPATH, '//*[@id="gsc_oci_title"]')
            ptitle.append(title.text)
            print('Title:', title.text)
            content = driver.find_elements(
                By.CLASS_NAME, 'gs_scl')
            authors_flag = 0
            date_flag = 0
            journal_flag = 0
            conference_flag = 0
            volume_flag = 0
            description_flag = 0
            issue_flag = 0
            pages_flag = 0
            publisher_flag = 0

            for c in content:
                field = c.find_element(By.CLASS_NAME, 'gsc_oci_field')
                value = c.find_element(By.CLASS_NAME, 'gsc_oci_value')
                if (field.text in paper_dict):
                    paper_dict[field.text].append(value.text)
                    # print(field.text, ":", value.text)
                if (field.text == 'Authors'):
                    authors_flag = 1
                if (field.text == 'Publication date'):
                    date_flag = 1
                if (field.text == 'Journal'):
                    journal_flag = 1
                if (field.text == 'Conference'):
                    conference_flag = 1
                if (field.text == 'Volume'):
                    volume_flag = 1
                if (field.text == 'Description'):
                    description_flag = 1
                if (field.text == 'Issue'):
                    issue_flag = 1
                if (field.text == 'Pages'):
                    pages_flag = 1
                if (field.text == 'Publisher'):
                    publisher_flag = 1
            if (authors_flag == 0):
                paper_dict['Authors'].append('NA')
            if (date_flag == 0):
                paper_dict['Publication date'].append('NA')
            if (journal_flag == 0):
                paper_dict['Journal'].append('NA')
            if (conference_flag == 0):
                paper_dict['Conference'].append('NA')
            if (volume_flag == 0):
                paper_dict['Volume'].append('NA')
            if (description_flag == 0):
                paper_dict['Description'].append('NA')
            if (issue_flag == 0):
                paper_dict['Issue'].append('NA')
            if (pages_flag == 0):
                paper_dict['Pages'].append('NA')
            if (publisher_flag == 0):
                paper_dict['Publisher'].append('NA')
            print('Done with this research paper. Moving to next')
            driver.close()
            driver.switch_to.window(driver.window_handles[0])
        # break
    print('Total research papers since 2018:', paper_index)
    prof_number = prof_number + 1
    print('Done with this professor. Moving to next')
    print('-----------------------------------------------------------------')
    prof_dft = pd.DataFrame(list(zip(prof_id, prof_name, prof_dept, prof_domain, prof_coauthors, prof_all_citations, prof_citations_since_2018, prof_all_h_index, prof_h_index_since_2018, prof_all_i10_index, prof_i10_index_since_2018, prof_year_wise_citations)),
                            columns=['PID', 'Name', 'Department', 'Domain', 'Coauthors', 'All citations', 'Citations since 2018', 'All h-index', 'h-index since 2018', 'All i10-index', 'i10-index since 2018', 'Citations per year'])
    paper_dft = pd.DataFrame(list(zip(rpid, ptitle, pcitations, pyear, pauthors, pdate, pjournal, pconference, pvolume, pdescription, pissues, ppages, ppublisher, plink)), columns=[
                             'RPID', 'Title', 'Citations', 'Year', 'Authors', 'Publication date', 'Journal', 'Conference', 'Volume', 'Description', 'Issue', 'Pages', 'Publisher', 'Link'])
    prof_df = pd.concat([prof_df, prof_dft], ignore_index=True)
    paper_df = pd.concat([paper_df, paper_dft], ignore_index=True)
    prof_df.to_csv('prof.csv', index=False)
    paper_df.to_csv('paper.csv', index=False)
    # break

    # prof_df = pd.read_csv('prof.csv')
    # paper_df = pd.read_csv('paper.csv')
    # prof_df['Index'] = range(1, len(prof_df) + 1)
    # first_column = prof_df.pop('Index')
    # prof_df.insert(0, 'Index', first_column)
    # prof_df.to_csv('prof.csv', index=False)
    # paper_df['Index'] = range(1, len(paper_df) + 1)
    # first_column = paper_df.pop('Index')
    # paper_df.insert(0, 'Index', first_column)
    # paper_df.to_csv('paper.csv', index=False)
print(prof_df)

print('Below is paper_df')
print(paper_df)
driver.quit()
