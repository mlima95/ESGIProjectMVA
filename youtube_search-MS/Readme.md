# Start Project

###### Create virtual environement

Run on your terminal

1. ```python3 -m venv env```
2. ```source env/bin/activate```

###### Install dependencies

1. pip install -r requirements.txt

###### Start mongoDB 

1. Run mongoDB on your computer 

###### Run Project

Go in mysite myAPI. Run migration and start server local 

1. ```python manage.py migrate```
2. ```python manage.py runserver```

## Test API

Two endpoint exist on this API :

1. http://localhost:8000/youtube/createKeyWord
    - POST method. Required params 'q' on body
2. http://0.0.0.0:8000/youtube/findVideo 
    - GET method. required params 'q' and 'keyApi'
    
## Info

KeyApi is in mysite/mysite/settings.py 



