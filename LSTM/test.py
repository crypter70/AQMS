import requests
import json

# Back-end data.
URL_API = 'http://127.0.0.1:6000/predict'
HEADERS = {'Content-Type': 'application/json'}

def get_data():
    example_data = [1, 2, 3, 4, 5] 
    return {"data": example_data}

def send_post_request(data):
    response = requests.post(URL_API, data=json.dumps(data), headers=HEADERS)

    if response.status_code == 200:
        print("Data sinyal berhasil dikirim!")
    else:
        print(f"Terjadi kesalahan: {response.status_code}\n{response.text}")

if __name__ == "__main__":
    send_post_request(get_data())