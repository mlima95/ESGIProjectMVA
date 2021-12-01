from django.urls import path

from . import views

urlpatterns = [
    path('', views.createKeyWord, name='createKeyWord'),
    path('findVideo', views.findVideo, name='findVideo'),
]
