from polls.models import Search
from rest_framework import serializers


class SearchSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Search
        fields = ['key_word']