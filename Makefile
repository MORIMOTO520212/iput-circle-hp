.PHONY dev
dev:
	docker compose up -d
	docker exec -i wordpress mysql -h localhost -u root -p yWcMY9GcwA972YiXEQCpTqid < db.sql
	