FROM python:3.10

ENV PYTHONUNBUFFERED 1

EXPOSE 8123

RUN apt-get update && \
    apt-get install -y gdal-bin libgdal-dev && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/python_service

COPY . /var/www/python_service

RUN pip install --upgrade pip
RUN pip install --no-cache-dir -r ./_docker/python_service/requirements.txt