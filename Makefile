.PHONY: init
init:
	docker compose up -d

.PHONY: migrate
	docker exec -i iputone_mysql8 mysql -u root --password=yWcMY9GcwA972YiXEQCpTqid < db.sql

.PHONY: dev
dev:
	docker compose up -d