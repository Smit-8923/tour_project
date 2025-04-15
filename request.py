import requests
from bs4 import BeautifulSoup

query = "site:linkedin.com/in AND Founder AND Ahmedabad"
url = f"https://www.google.com/search?q={query}"

headers = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64)"
}

response = requests.get(url, headers=headers)
soup = BeautifulSoup(response.text, "html.parser")

for result in soup.find_all('div', class_='tF2Cxc'):
    title = result.find('h3').text
    link = result.find('a')['href']
    print(f"{title}\n{link}\n")
