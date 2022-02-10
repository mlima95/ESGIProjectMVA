api: ## Launch the api
	cd api-plateform && docker-compose up -d
front: ## Launch the front
	cd front && docker-compose up -d
youtubeMS: ## Launch the youtube finder micro-service
	cd youtube_search-MS && docker-compose up -d
ytDownloader: ## Launch the youtube downloader micro-service
	cd youtube_downloader && docker-compose up -d
up: ## Launch all the services (api, front, microservices)
	make api
	make front
	make youtubeMS
	make ytDownloader

## —— Others 🛠️️ ———————————————————————————————————————————————————————————————
help: ## Liste des commandes
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
