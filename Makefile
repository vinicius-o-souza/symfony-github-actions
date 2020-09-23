setup:	
	docker-compose up -d db app;
	docker-compose run --rm composer install;
	chmod +x app/configs.sh
	./app/configs.sh

up:
	docker-compose up -d db app;

down:
	docker-compose down;

shell:
	docker-compose exec app bash;
