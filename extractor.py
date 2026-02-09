import requests
from bs4 import BeautifulSoup
import json
import re
import unicodedata

BASE_URL = "https://www.himnosycanticosdelevangelio.org"
HIMNOS_URL = BASE_URL + "/himnos/orden-alfabetico/"

HEADERS = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36"
}

def normalize_first_letter(text):
    text = unicodedata.normalize("NFD", text)
    text = "".join(ch for ch in text if unicodedata.category(ch) != "Mn")
    for ch in text:
        if ch.isalpha():
            return ch.upper()
    return ""

def get_himnos_por_letra():
    resp = requests.get(HIMNOS_URL, headers=HEADERS)
    soup = BeautifulSoup(resp.text, "html.parser")
    himnos = []
    for a in soup.select("h3 a"):
        text = a.get_text(strip=True)
        match = re.match(r"(\d{1,3})\s*[\u2013-]\s*(.+)", text)
        if not match:
            continue
        numero = int(match.group(1))
        titulo = match.group(2).strip()
        letra = normalize_first_letter(titulo)
        href = a.get("href")
        if href and href.startswith(BASE_URL) and letra:
            himnos.append({"numero": numero, "titulo": titulo, "url": href, "letra": letra})
    agrupados = {}
    for h in himnos:
        agrupados.setdefault(h["letra"], []).append(h)
    return agrupados

def extract_himno(url):
    resp = requests.get(url, headers=HEADERS)
    soup = BeautifulSoup(resp.text, "html.parser")
    numero = soup.find("h2", class_="elementor-heading-title")
    titulo = soup.find("h1", class_="elementor-heading-title")
    estrofas_div = soup.find("div", class_="elementor-text-editor")
    estrofas_html = estrofas_div.decode_contents() if estrofas_div else None
    estrofas_texto = estrofas_div.get_text("\n", strip=True) if estrofas_div else None
    datos = {}
    for dato in soup.select("div.elementor-widget-container > p"):
        if ":" in dato.text:
            k, v = dato.text.split(":", 1)
            datos[k.strip().lower()] = v.strip()
    informacion = {}
    for table in soup.find_all("table"):
        for row in table.find_all("tr"):
            cells = row.find_all(["th", "td"])
            if len(cells) >= 2:
                clave = cells[0].get_text(" ", strip=True)
                valor = cells[1].get_text(" ", strip=True)
                if clave and valor:
                    informacion[clave.lower()] = valor
    return {
        "numero": numero.text.strip() if numero else None,
        "titulo": titulo.text.strip() if titulo else None,
        "estrofas_html": estrofas_html,
        "estrofas_texto": estrofas_texto,
        "informacion": informacion,
        **datos,
        "url": url
    }

def main():
    himnos_por_letra = get_himnos_por_letra()
    todos = []
    for letra in sorted(himnos_por_letra.keys()):
        lista = himnos_por_letra[letra]
        print(f"Se encontraron {len(lista)} himnos de la letra {letra}")
        himnos_detalle = []
        for h in lista:
            url = h["url"]
            try:
                himno = extract_himno(url)
                himno["letra"] = letra
                himnos_detalle.append(himno)
                todos.append(himno)
                print(f"Extraido: {himno['titulo']}")
            except Exception as e:
                print(f"Error en {url}: {e}")
        with open(f"himnos_letra_{letra.lower()}.json", "w", encoding="utf-8") as f:
            json.dump(himnos_detalle, f, ensure_ascii=False, indent=2)
    with open("himnos_todos.json", "w", encoding="utf-8") as f:
        json.dump(todos, f, ensure_ascii=False, indent=2)

if __name__ == "__main__":
    main()