#!/bin/false
## idea only, implementation will be in glorious php

class Item:
    name : str
    image : str
    description : str

class Collection(Item):
    content: List[Item]
    def list_content(page:int=0) -> List[Item]:
        pass

class Album(Collection): pass
class Season(Collection): pass
class Artist(Collection): pass
class Artist(Collection): pass

class Resource(Item):
    sha1 : str
    release_date : int
    

class Movie(Resource): pass
class Song(Resource): pass
