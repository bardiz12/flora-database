# flora-database
Flora Database Project
------------------
This is the first project that i build using Vue for frontend.
i create this project for one of my agenda in Community Service Program (we called it Kuliah Kerja Nyata or KKN). the idea is to collect all Flora's data that exists in place. and the data is stored in MySQL Database.

# The collected flora's details are :
  - Danger Status
  - Family Name
  - Locale Name
  - Endemic
  - Flora Category

# Features:
  - Administrator Dashboard
  - Multiple Image upload
  - Single Page Application
  - Search page

# Instalation
1. clone this repository 
    ```
    git clone https://github.com/bardiz12/flora-database
2. Install/Update Laravel and all it's Library
    ```
    composer update
3. Install Vue.js and other frontend Library
    ```
    npm install --save
4. edit __.env__ environment setting for database section
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=YOUR_DATABSE_NAME
    DB_USERNAME=YOUR_DATABASE_USERNAME
    DB_PASSWORD=YOUR_DATABASE_PASSWORD
5. run Laravel's Migration and seeder
    ```bash
    #write the database migration
    php artisan migrate:fresh
    
    #seed database content
    php aritsan db:seed
6. Run the server
    ```bash
    #run the php builtin server
    php artisan serve
    
    #compile the JS file
    npm run prod
    
7. Admin
    admin access : http://your_url/admin
    ```
    Username : admin@gondang.id
    Password : 12345678
# Screenshot
![floras1](https://user-images.githubusercontent.com/25524265/68070341-b0d6b800-fd9f-11e9-8a56-9db63c11d135.jpg)

![screencapture-flora-gondang-id-browse-2019-11-02-18_36_47](https://user-images.githubusercontent.com/25524265/68070350-bfbd6a80-fd9f-11e9-919d-bc274ccc3e7d.png)

![screencapture-flora-gondang-id-browse-Lauraceae-Cinnamomum-burmannii-2019-11-02-18_38_36](https://user-images.githubusercontent.com/25524265/68070381-00b57f00-fda0-11e9-979c-535d764ab7e8.png)

![screencapture-flora-gondang-id-search-2019-11-02-18_39_12](https://user-images.githubusercontent.com/25524265/68070430-aff25600-fda0-11e9-8b62-049d4df6b686.png)

# Live Demo
[Live Demo](http://flora.gondang.id/)
    
