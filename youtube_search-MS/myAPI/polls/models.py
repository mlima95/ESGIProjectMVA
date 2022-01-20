from djongo import models

class Search(models.Model):
    id=models.ObjectIdField()
    key_word = models.TextField()
    objects=models.DjongoManager