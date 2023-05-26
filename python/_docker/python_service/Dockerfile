FROM ghcr.io/osgeo/gdal:ubuntu-small-3.7.0

ENV PYTHONUNBUFFERED 1

EXPOSE 8123

RUN apt-get update && \
    apt-get install -y python3-pip && \
    apt-get clean && rm -rf /var/lib/apt/lists/*


COPY . /var/www/python_service

WORKDIR /var/www/python_service

RUN pip install --upgrade pip
RUN pip install --no-cache-dir -r ./_docker/python_service/requirements.txt
RUN pip install --upgrade yandexcloud