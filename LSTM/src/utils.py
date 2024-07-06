import yaml
import joblib

CONFIG_DIR = "../config/config.yaml"

def load_config() -> dict: 
    try:
        with open(CONFIG_DIR, "r") as file:
            config = yaml.safe_load(file)
    except FileNotFoundError as fe:
        raise RuntimeError("Parameters file not found in path.")
    return config


print('utils OK')



