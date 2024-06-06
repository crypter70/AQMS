import numpy as np
from flask import Flask, request, jsonify
import torch
import torch.nn as nn
from sklearn.preprocessing import StandardScaler, MinMaxScaler

class LSTMModel(nn.Module):

    def __init__(self, input_size, hidden_size, num_layers): 
        super(LSTMModel, self).__init__()
        self.lstm = nn.LSTM(input_size, hidden_size, num_layers, batch_first=True)
        self.linear = nn.Linear(hidden_size, 1)
 
    def forward(self, x): 
        out, _ = self.lstm(x)
        out = self.linear(out)
        return out
    

app = Flask(__name__)

if torch.backends.mps.is_available():
    device = torch.device("mps")
else:
    device = torch.device("cpu")

print(device)


model = LSTMModel(input_size=1, hidden_size=64, num_layers=2).to(device)
model.load_state_dict(torch.load('lstm_model.pth'))
model.eval()

scaler = StandardScaler()

# new_data = np.reshape(new_data, (-1,1))
# scaled_new_data = scaler.fit_transform(new_data)
# scaled_new_data = torch.tensor(scaled_new_data, dtype=torch.float32)


@app.route("/")
def hello_world():
    return "<p>Hello, World!</p>"

@app.route('/predict', methods=['POST'])
def predict():
    # Get JSON data from request
    data = request.get_json()
    
    # Convert data to tensor
    sequence = np.array(data['sequence'])
    sequence = sequence.reshape(1, -1, 1)  # Reshape to (batch_size, time_step, input_dim)
    sequence = scaler.fit_transform(sequence)
    sequence_tensor = torch.tensor(sequence, dtype=torch.float32).to(device)
    
    # Make prediction
    with torch.no_grad():
        prediction = model(sequence_tensor)
    
    # Convert prediction to list and return as JSON
    predicted_value = prediction.cpu().numpy().tolist()
    return jsonify({'predicted_value': predicted_value[0][0]})

# def predict(model, data):
    
#     model.eval()
#     with torch.no_grad():
#         data = data.to(device)
        
#         predicted_value = model(data).detach().cpu().numpy()
#         predicted_value = scaler.inverse_transform(predicted_value.reshape(-1,1))  
    
#     return predicted_value[0].item()

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=4500)



