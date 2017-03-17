# social-media
An API to a social-media

GET Feed

curl -i http://localhost/social-media/feed/ID_USER

GET Friends

curl -i http://localhost/social-media/friends/ID_USER

POST New Status

curl -X POST -H "Content-Type: application/json" \
-d '{"user":"ID_USER","post":"NEW_STATUS"}' \
-i http://localhost/social-media/post
