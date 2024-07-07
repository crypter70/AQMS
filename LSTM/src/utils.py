import yaml
import joblib
import pandas as pd
import json

CONFIG_DIR = "../config/config.yaml"

def load_config() -> dict: 
    try:
        with open(CONFIG_DIR, "r") as file:
            config = yaml.safe_load(file)
    except FileNotFoundError as fe:
        raise RuntimeError("Parameters file not found in path.")
    return config

def dump_data_pickle(data, file_path: str) -> None:
    joblib.dump(data, file_path)
    
def dump_data_csv(data: pd.DataFrame, data_dir: str):
    data.to_csv(data_dir, index=False)

def load_data_pickle(file_path: str):
    return joblib.load(file_path)


# PREPROCESSING
def read_raw_data(config: dict, data_dir: str) -> pd.DataFrame:
    df = pd.read_csv(data_dir, encoding='utf-8')
    df = df[[config['data_source']['data_column']]]
    
    data_to_remove = config['data_source']['data_to_remove']
    raw_data = df.drop(data_to_remove)

    return raw_data

def extract_features(json_str, config: dict):
    data_dict = json.loads(json_str)
    
    id_sensor = data_dict[config['data_mapping']['id_sensor']]
    datetime = data_dict[config['data_mapping']['dateTime']][config['data_mapping']['date']] + ' ' + data_dict[config['data_mapping']['dateTime']][config['data_mapping']['time']]
    
    pm1 = data_dict[config['data_mapping']['sensor']][config['data_mapping']['ZH03B']][config['data_mapping']['pm1']]
    pm25 = data_dict[config['data_mapping']['sensor']][config['data_mapping']['ZH03B']][config['data_mapping']['pm25']]
    pm10 = data_dict[config['data_mapping']['sensor']][config['data_mapping']['ZH03B']][config['data_mapping']['pm10']]
    co = data_dict[config['data_mapping']['sensor']][config['data_mapping']['MQ7']][config['data_mapping']['co']]
    temperature = data_dict[config['data_mapping']['sensor']][config['data_mapping']['DHT22']][config['data_mapping']['temperature']]
    humidity = data_dict[config['data_mapping']['sensor']][config['data_mapping']['DHT22']][config['data_mapping']['humidity']]
    pressure = data_dict[config['data_mapping']['sensor']][config['data_mapping']['BME280']][config['data_mapping']['pressure']]
    
    return id_sensor, datetime, pm1, pm25, pm10, co, temperature, humidity, pressure

def clean_features(config: dict, data: pd.DataFrame):
    
    # drop kolom "MESSAGE", ubah tipe data datetime menjadi datetime, ubah tipe data id_sensor menjadi int
    data = data.drop(columns=config['data_source']['data_column'])
    data[config['data_source']['datetime_feature']] = pd.to_datetime(data[config['data_source']['datetime_feature']])
    data[config['data_source']['id_sensor']] = data[config['data_source']['id_sensor']].astype(int)

    return data



print('utils OK')



