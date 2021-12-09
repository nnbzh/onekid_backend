clear:
	docker exec -it onekid_backend_laravel.test_1 php artisan optimize
	docker exec -it onekid_backend_laravel.test_1 php artisan cache:clear
	docker exec -it onekid_backend_laravel.test_1 php artisan config:clear
