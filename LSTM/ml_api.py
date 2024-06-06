import numpy as np
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from sklearn.preprocessing import StandardScaler, MinMaxScaler

import torch
import torch.nn as nn
from typing import List

app = FastAPI()

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

# deklarasi kelas Data
class Data(BaseModel):
    data: List[float]   

# aktivasi device implementasi model, mps untuk GPU Mac OS, dan cuda untuk GPU Windows OS
if torch.backends.mps.is_available():
    device = torch.device("mps")
elif torch.cuda.is_available():
    device = torch.device("cuda")
else:
    device = torch.device("cpu")

# deklarasi model dengan parameter dan laod model LSTM pada file lokal
model = LSTMModel(input_size=1, hidden_size=64, num_layers=2).to(device)
model.load_state_dict(torch.load('lstm_model.pth'))

# ubah ke mode evaluasi
model.eval()

scaler = StandardScaler()


@app.get("/")
def home():
    return {"ml_api_check": "OK"}

# method untuk prediksi
@app.post("/predict")
async def predict(aqms_data: Data):
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


