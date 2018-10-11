help:
	echo "help "
chmod:
	@docker exec -i new.php bash -c "chmod 777 -R storage/ database/ app/ resources/ public/ vendor/"
art:
	@docker exec -i new.php php artisan $(c)
	@make chmod
dps:
	@docker ps --format "table {{.ID}}\t{{.Ports}}\t{{.Names}}"
up:
	@docker-compose up -d --build
	@make dps
	@make chmod
update:
	@docker exec -i new.php bash composer update
down:
	@docker stop $(shell docker ps -a -q)
