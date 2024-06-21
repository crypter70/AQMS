# gunakan python base image
FROM python:3.10

# ubah direktori
WORKDIR /code

# tambahkan file requirements ke image
COPY ./requirements.txt /code/requirements.txt

# install python libraries
RUN pip install --no-cache-dir --upgrade -r /code/requirements.txt

# tambahkan file ke image
# COPY . /code/app/
COPY ml_api.py /code/
COPY lstm_model.pth /code/

# running api
CMD ["fastapi", "run", "ml_api.py", "--port", "80"]

