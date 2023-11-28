import requests
from bs4 import BeautifulSoup
import os

# Define the base URL of the website to scrape
base_url = "https://bay251123.com"

# Create the folder for HTML files if it doesn't exist
html_folder = "html_files"
os.makedirs(html_folder, exist_ok=True)

# Function to save HTML content to a file
def save_html_to_file(url, content):
    filename = url.split("/")[-1] + ".html"
    with open(os.path.join(html_folder, filename), "w", encoding="utf-8") as file:
        file.write(content)

# Function to scrape a page and save its HTML
def scrape_and_save_page(url):
    response = requests.get(url)
    if response.status_code == 200:
        content = response.text
        save_html_to_file(url, content)

if __name__ == "__main__":
    # List of URLs to scrape (add more URLs as needed)
    urls_to_scrape = [
        base_url,
        base_url + "/page2",
        base_url + "/page3",
        # Add more URLs here
    ]

    for url in urls_to_scrape:
        scrape_and_save_page(url)

    print("HTML pages saved to the 'html_files' folder.")
