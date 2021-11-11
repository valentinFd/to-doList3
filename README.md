### Instructions
1. Clone the project.
```
git clone https://github.com/valentinFd/to-doList3.git
```
2. Go to the project folder using ```cd``` on your cmd or terminal.
3. Run ```composer install```.
4. Copy the contents of ```.env.example``` to ```.env``` file in project's root directory.
5. Create an empty MySQL database.
6. Open the ```.env``` file and change ```DB_DATABASE```, ```DB_USERNAME```, and ```DB_PASSWORD``` to yours.
7. Run ```php artisan key:generate```.
8. Run ```php artisan migrate```.
9. (Optional) Run ```php artisan db:seed --class=UserSeeder```.
10. Run ```php artisan serve```.
11. Go to [localhost:8000](http://localhost:8000/).
