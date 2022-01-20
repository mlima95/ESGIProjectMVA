FROM python:3
ENV PYTHONDONTWRITEBYTECODE=1
ENV PYTHONUNBUFFERED=1
WORKDIR ./app
ADD . /app
RUN python -m venv env
RUN pip install -r requirements.txt
COPY . /app/
