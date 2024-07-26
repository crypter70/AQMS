import numpy as np
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from sklearn.preprocessing import StandardScaler
import pandas as pd

import torch
import torch.nn as nn
from typing import List, Dict

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
    data_1: List[float]  
    data_2: List[float]  
    data_3: List[float]  
    data_4: List[float]  
    data_5: List[float]  
    data_6: List[float]  
    data_7: List[float]  
    data_8: List[float]  
    data_9: List[float]  
    data_10: List[float]  
    data_11: List[float]  
    data_12: List[float]  

class PredictionResponse(BaseModel):
    predicted_values: Dict[str, List[float]]
    # predicted_values: float
    # predicted_values: Dict[str, float]

models = {}
scalers = {}
model_paths = {
    0: ('sensor_1_pm1', '../models/sensor_data_1_pm1_lstm_model.pth'),
    1: ('sensor_1_pm25', '../models/sensor_data_1_pm25_lstm_model.pth'),
    2: ('sensor_1_pm10', '../models/sensor_data_1_pm10_lstm_model.pth'),
    3: ('sensor_1_co', '../models/sensor_data_1_co_lstm_model.pth'),
    4: ('sensor_2_pm1', '../models/sensor_data_2_pm1_lstm_model.pth'),
    5: ('sensor_2_pm25', '../models/sensor_data_2_pm25_lstm_model.pth'),
    6: ('sensor_2_pm10', '../models/sensor_data_2_pm10_lstm_model.pth'),
    7: ('sensor_2_co', '../models/sensor_data_2_co_lstm_model.pth'),
    8: ('sensor_3_pm1', '../models/sensor_data_3_pm1_lstm_model.pth'),
    9: ('sensor_3_pm25', '../models/sensor_data_3_pm25_lstm_model.pth'),
    10: ('sensor_3_pm10', '../models/sensor_data_3_pm10_lstm_model.pth'),
    11: ('sensor_3_co', '../models/sensor_data_3_co_lstm_model.pth'),
}

# load model dan scaler
for model_id, (name, path) in model_paths.items():
    model = LSTMModel(input_size=1, hidden_size=64, num_layers=2).to(device)
    model.load_state_dict(torch.load(path, map_location=device))
    model.eval()
    models[model_id] = model
    scalers[model_id] = StandardScaler()

@app.get("/")
def home():
    return {"ml_api_check": "OK"}

@app.get("/data")
async def get_data():
    example_data = [1, 2, 3, 4, 5]
    return {"data": example_data}

@app.post("/predict", response_model=PredictionResponse)
async def predict(aqms_data: PredictionRequest):
    try:
        datas = [aqms_data.data_1, aqms_data.data_2, aqms_data.data_3, aqms_data.data_4,
                 aqms_data.data_5, aqms_data.data_6, aqms_data.data_7, aqms_data.data_8,
                 aqms_data.data_9, aqms_data.data_10, aqms_data.data_11, aqms_data.data_12]
        predictions = {}

        for i, data in enumerate(datas):
            scaled_data = preprocessing(scalers[i], data)

            # disable komputasi gradien 
            with torch.no_grad():

                # pindahkan data ke CPU atau GPU
                scaled_data = scaled_data.to(device)

                # lakukan prediksi, detach dari komputasi, pindahkan data ke CPU, convert ke numpy array, dan inverse scaling hasil prediksi
                predicted_value = models[i](scaled_data).detach().cpu().numpy()
                predicted_value = scalers[i].inverse_transform(predicted_value.reshape(-1, 1))
                predicted_value_array = np.array(predicted_value)
                average_values = np.mean(predicted_value_array.reshape(-1, 24), axis=1)


                name = model_paths[i][0]
                # predictions[f"predicted_value_{name}"] = predicted_value[:24]
                predictions[f"predicted_value_{name}"] = average_values

        # return {"predicted_values": predictions}
        return {"predicted_values": predictions}

    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))

def preprocessing(scaler, data):

    # ubah array data menjadi 2D (0, 0), scaling data, dan convert data ke tipe tensor
    new_data = np.reshape(data, (-1, 1))
    scaled_new_data = scaler.fit_transform(new_data)
    scaled_new_data = torch.tensor(scaled_new_data, dtype=torch.float32)
    return scaled_new_data

if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="0.0.0.0", port=8000)