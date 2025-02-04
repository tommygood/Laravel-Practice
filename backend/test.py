import requests

url = "http://198.19.249.33:8000/api/products"  # Replace with your API URL

response = requests.post(url)

# Print CORS headers
cors_headers = {k: v for k, v in response.headers.items() if "access-control" in k.lower()}
print(response.headers)

