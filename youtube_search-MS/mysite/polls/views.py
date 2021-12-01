from polls.models import Search
from django.http import JsonResponse
import requests
import json
from mysite.settings import BASE_URL
from django.views.decorators.csrf import csrf_exempt
from polls.status_return import response_data


# Function execture for add Key_word in db
@csrf_exempt
def createKeyWord(request):

    # GET params in request 
    queryParams = request.POST

    # Check if request is POST request
    if request.method != 'POST':
        result = response_data('error', 'La mauvaise méthode est appelé')
        return JsonResponse(result)

    if('q' in queryParams):
        post=Search(key_word=queryParams.get('q'))
        post.save()  
        result = response_data('success', 'données inséré')
    else:
        result = response_data('error', "Il manque un paramètre lors de l'appel de la requête")

    return JsonResponse(result)


# Function exectue when validator select video
@csrf_exempt
def findVideo(request):

    # GET params in request
    queryParams = request.GET

    # Check if request is GET request
    if request.method != 'GET':
        result = response_data('error', 'La mauvaise méthode est appelé')
        return JsonResponse(result)

    # Verification required params 
    if('q' in queryParams and 'keyApi' in queryParams):

        # Get data by key_word
        query = Search.objects.filter(key_word=queryParams.get('q')).values('key_word')

        # Test if result request si not empty
        if query.count() > 0:
            entries = query.first()

            # Test if pageToken param is passed in request
            if 'pageToken' in queryParams:
                response_api = requests.get(BASE_URL + '&key=' + queryParams.get('keyApi') + '&q=' + entries['key_word'] + '&pageToken=' + queryParams.get('pageToken'))
            else:
                response_api = requests.get(BASE_URL + '&key=' + queryParams.get('keyApi') + '&q=' + entries['key_word'])
            
            # return data parsed JSON
            return JsonResponse(json.loads(response_api.text))
        else:
            result = response_data('success', "Aucun résultat pour cette rercheche")
    else:
        result = response_data('error', "Il manque un paramètre lors de l'appel de la requête")


    return JsonResponse(result)