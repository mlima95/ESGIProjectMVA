api: ## Launch the api
	cd api-plateform && docker-compose up -d
front: ## Launch the front
	cd front && docker-compose up -d
youtubeMS: ## Launch the youtube finder micro-service
	cd youtube_search-MS && docker-compose up -d
ytDownloader: ## Launch the youtube downloader micro-service
	cd youtube_downloader && docker-compose up -d
planificator: ## Launch the youtube downloader micro-service
	cd planificator-MS && docker-compose up -d

api-hard: ## Rebuild and launch the api
	cd api-plateform && docker-compose up -d --build
front-hard: ## Rebuild and launch the front
	cd front && docker-compose up -d --build
youtubeMS-hard: ## Rebuild and launch the youtube finder micro-service
	cd youtube_search-MS && docker-compose up -d --build
ytDownloader-hard: ## Rebuild and launch the youtube downloader micro-service
	cd youtube_downloader && docker-compose up -d --build
planificator-hard: ## Rebuild and launch the youtube downloader micro-service
	cd planificator-MS && docker-compose up -d --build

up: ## Launch all the services (api, front, microservices)
	make api
	make front
	make youtubeMS
	make planificator
	make ytDownloader

up-hard: ##  Rebuild and Launch all the services (api, front, microservices)
	make api-hard
	make front-hard
	make youtubeMS-hard
	make planificator-hard
	make ytDownloader-hard

## —— Others 🛠️️ ———————————————————————————————————————————————————————————————
help: ## Liste des commandes
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'