import pandas as pd

pname = ["ratnajit bhattacharjee", "Debanga Raj Neog",
         "Rhythm Grover", "Arghyadip Roy", "Neeraj Kumar Sharma", "M K Bhuyan", "Prabirkumar Saha", "Siddhartha Pratim Chakrabarty", "Ashok Sairam", "Arabin Kumar Dey", "Ashish Anand", "Biplab Bose", "Prof. Gaurav Trivedi", "Sanasam Ranbir Singh", "Hanumant Singh shekhawat", "Prithwijit Guha", "Dr. Souptick Chanda", "Devavrat Shah", "S Lakshmivarahan"]
plink = ["https://scholar.google.com/citations?user=MCD-HKQAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=a7LQA8cAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=0lsISW8AAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=YwT89XIAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=j7oyJ0MAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=o4yGgBQAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=VtgWODQAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=aBIWxbEAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=oDcr8MIAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=2XR7_CsAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=W7nidBQAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=h8W9rUMAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=FYI_9IwAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=Es12tcUAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=L7yWFlkAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=sEltKKoAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=7bOSPf4AAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=3qPiYJoAAAAJ&hl=en&oi=ao",
         "https://scholar.google.com/citations?user=SverXLoAAAAJ&hl=en&oi=ao"]
pid = list(range(1, len(pname) + 1))

print(len(pname))
print(len(plink))
print(len(pid))
prof_data = pd.DataFrame(list(zip(pid, pname, plink)),
                         columns=["PID", "pname", "plink"])

print(prof_data)
print(len(prof_data))
prof_data.to_csv("D:\Sem 4\DA215 DBMS Lab\Project\prof_data.csv", index=False)
