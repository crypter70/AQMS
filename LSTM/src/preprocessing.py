from utils import *

if __name__ == '__main__':

    # load configuration file
    config = load_config()

    # read data
    raw_dataset_path = '../' + config['data_source']['directory'] + config['data_source']['file_name']  
    raw_data = read_raw_data(config, raw_dataset_path)

    # extracting features
    raw_data[config['data_source']['columns']] = raw_data[config['data_source']['data_column']].apply(lambda x: extract_features(x, config)).apply(pd.Series)
    
    # cleaning features
    raw_data = clean_features(config, raw_data)

    data = {
        'sensor_data_1': raw_data[raw_data[config['data_source']['id_sensor']] == config['data_source']['sensor'][0]].reset_index(drop=True),
        'sensor_data_2': raw_data[raw_data[config['data_source']['id_sensor']] == config['data_source']['sensor'][1]].reset_index(drop=True),
        'sensor_data_3': raw_data[raw_data[config['data_source']['id_sensor']] == config['data_source']['sensor'][2]].reset_index(drop=True)
    }

    # resampling data
    data['sensor_data_1'] = data['sensor_data_1'].resample('h', on='datetime').mean()[config['data_source']['num_features']]
    data['sensor_data_2'] = data['sensor_data_2'].resample('h', on='datetime').mean()[config['data_source']['num_features']]
    data['sensor_data_3'] = data['sensor_data_3'].resample('h', on='datetime').mean()[config['data_source']['num_features']]

    # dump data
    data_path_pkl = '../' + config['train_test_data']['directory'] + config['train_test_data']['file_name_pkl']  
    data_path_csv = '../' + config['train_test_data']['directory'] + config['train_test_data']['file_name_csv']  

    dump_data_pickle(data, data_path_pkl)
    dump_data_csv(raw_data, data_path_csv)

    print('preprocessing OK')