# Troylab BK Task 

### Installation 
```
composer install 
php artisan jwt:seceret
php artisan jwt:generate-certs
```


## API Endpoints Table 
| Endpoint | Body |
| -------- | ---- |
| POST: /api/auth/login | { "email": "", "password": "" } |
| GET : /api/students | {  } |
| POST: /api/students | { "name": "", "school_id": "",} |
| PUT: /api/students/{id} | { "name": "", "school_id": "" } |
| DELETE: /api/students/{id} | {  } |
| GET: /api/schools | {  } |




