Laravel Multi Language function implement
===========================================


[screen.png](screensheet/screen.png)


-Requirement</br>
</br>
</br>
PHP > 7.0</br>
MySQL 5.3</br>
</br>
</br>

-Quick install</br>
---------------------------</br>
1. Extract the archive from the CMS to the desired directory</br>
2. Give the write permission to the following directories: storage, bootstrap / cache</br>
3. Perform the basic configuration of the CMS using the .env file (copy .env.example and rename it) in the root directory (see the full description of the parameters in configs.txt):</br>
   1. Assign APP_URL, must match the URL on which the site will run</br>
   2. Enter the connection data to MySQL (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).</br> The database must be previously created.</br>
4. Fill in the database using one of the following options:</br>
   a. using a dump, for example from another server</br>
   b. go to the directory with the unpacked CMS and run the command "php artisan migrate" (initializes empty tables)</br>
5. Configure the web server. The public directory of the project is "public /"</br>
6. Go to the directory with the unpacked CMS and run the command "php artisan optimize"</br>


-Configs</br>
---------------------------</br>
// .env //</br>
APP_ENV: environment, on the production server use the value of production</br>
APP_KEY: secret application key, used for encryption (to generate the key you need to go to the directory with the unpacked CMS and execute the command "php artisan key: generate")</br>
APP_DEBUG: enable / disable debugging</br>
APP_URL: public address on which the application is running</br>

DB_CONNECTION: database driver, leave mysql</br>
DB_HOST: the address of the database server</br>
DB_PORT: Database Server Port</br>
DB_DATABASE: database name</br>
DB_USERNAME: database user</br>
DB_PASSWORD: database user password</br>

