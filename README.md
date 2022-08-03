# Troylab BK Task 

## INFo 
This task is done by using Laravel and Fillament as the Admin Panel Package  
To access the admin panel go to ```http://localhost:8000/admin```   
The default password for any user account ```password``` 

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




