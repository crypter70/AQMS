# gunakan python base image
FROM python:3.10

# ubah direktori
WORKDIR /code

# tambahkan file requirements ke image
COPY ./requirements.txt /code/requirements.txt

# install python libraries
RUN pip install --no-cache-dir --upgrade -r /code/requirements.txt

# tambahkan file ke image
COPY src/api.py ../src/
COPY models/ ../models/

# running api
CMD ["fastapi", "run", "../src/api.py", "--port", "80"]

