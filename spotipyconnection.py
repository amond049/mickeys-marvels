import spotipy
from spotipy.oauth2 import SpotifyOAuth

scope = "user-read-recently-played"
sp = spotipy.Spotify(auth_manager=SpotifyOAuth(client_id="b808a468fde844f1997ed084717952dc", client_secret="49883ce67d9748bc9fdad8ed1f402a96", redirect_uri="http://example.com", scope=scope))


results = sp.current_user_recently_played(limit=21)
file = open("records.txt", "w")
# Printing the 10 most recent tracks I listened to
for i in range(0, 20, 1):
    # Top most index is the song that I just listened to
    file.write(results['items'][i]['track']['name'] + "`")
    file.write(results['items'][i]['track']['album']['images'][0]['url'] + "`")
    file.write(results['items'][i]['track']['external_urls']['spotify'] + "`")

    value = len(results['items'][i]['track']['album']['artists'])
    artists = ""
    for j in range(value):
        artists += results['items'][i]['track']['album']['artists'][j]['name'] + ":"

    
    artists = artists.split(":")

    individual_artist = ""
    for i in range(len(artists) - 1):
        if i != len(artists) - 2:
            individual_artist += artists[i] + ", "
        else:
            individual_artist += artists[i]


    file.write(individual_artist + "\n")



