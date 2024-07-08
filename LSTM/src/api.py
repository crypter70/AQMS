import numpy as np
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from sklearn.preprocessing import StandardScaler, MinMaxScaler

import torch
import torch.nn as nn
from typing import List

app = FastAPI()

# aktivasi device implementasi model, mps untuk GPU Mac OS, dan cuda untuk GPU Windows OS
if torch.backends.mps.is_available():
    device = torch.device("mps")
elif torch.cuda.is_available():
    device = torch.device("cuda")
else:
    device = torch.device("cpu")

# deklarasi kelas LSTM untuk model LSTM
class LSTMModel(nn.Module):
    def __init__(self, input_size, hidden_size, num_layers): 
        super(LSTMModel, self).__init__()
        self.lstm = nn.LSTM(input_size, hidden_size, num_layers, batch_first=True)
        self.linear = nn.Linear(hidden_size, 1)
 
    def forward(self, x): 
        out, _ = self.lstm(x)
        out = self.linear(out)
        return out

class PredictionRequest(BaseModel):
    data: List[float]  

class PredictionResponse(BaseModel):
    # predicted_value: List[float]
    predicted_value: float

# deklarasi model dengan parameter dan load model LSTM pada file lokal
model = LSTMModel(input_size=1, hidden_size=64, num_layers=2).to(device)
# model.load_state_dict(torch.load('app/lstm_model.pth', map_location=device))
model.load_state_dict(torch.load('lstm_model.pth', map_location=device))

# ubah ke mode evaluasi
model.eval()

scaler = StandardScaler()


@app.get("/")
def home():
    return {"ml_api_check": "OK"}


@app.get("/data")
async def get_data():
    example_data = [1, 2, 3, 4, 5] 
    return {"data": example_data}

# method untuk prediksi
# @app.post("/predict")
@app.post("/predict", response_model=PredictionResponse)
async def predict(aqms_data: PredictionRequest):
    try:
        data = preprocessing(aqms_data.data)

        # disable komputasi gradien 
        with torch.no_grad():

            # pindahkan data ke CPU atau GPU
            data = data.to(device)
            
            # lakukan prediksi, detach dari komputasi, pindahkan data ke CPU, convert ke numpy array, dan inverse scaling hasil prediksi
            predicted_value = model(data).detach().cpu().numpy()
            predicted_value = scaler.inverse_transform(predicted_value.reshape(-1,1))  
        
        # return hasil prediksi untuk 1 data atau 1 hari
        return {"predicted_value": predicted_value[0].item()}

        # return hasil prediksi untuk 7 data atau 7 hari
        # return {"predicted_value": predicted_value[:7]}
    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))

# prosedur untuk praproses input data
def preprocessing(data):

    # ubah array data menjadi 2D (0, 0), scaling data, dan convert data ke tipe tensor
    new_data = np.reshape(data, (-1,1))
    scaled_new_data = scaler.fit_transform(new_data)
    scaled_new_data = torch.tensor(scaled_new_data, dtype=torch.float32)

    return scaled_new_data

if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="0.0.0.0", port=8000)
    uvicorn.run(app)