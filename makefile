api:
	cd api-platform && docker-compose up -d
client:
	cd client && docker-compose up -d
youtubeMS:
	cd youtube_search-MS && docker-compose up -d

up:
	make api
	make client
	make youtubeMS
