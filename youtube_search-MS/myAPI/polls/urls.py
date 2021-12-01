from django.urls import path

from . import views

urlpatterns = [
    path('createKeyWord', views.createKeyWord, name='createKeyWord'),
    path('findVideo', views.findVideo, name='findVideo'),
]
