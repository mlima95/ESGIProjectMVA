import json
from django.http import HttpResponse


def response_data(result, message): 
    response_data = {}
    response_data['status'] = result
    response_data['message'] = message
    return response_data