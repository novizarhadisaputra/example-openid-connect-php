### HIS V2 (BETA TEST)

## App Stack
* PHP: 8.ˆ
* Postgres:latest
* Laravel:10
* Composer:latest
* Docker (Optional)

## Normal Setup
> <b>Perhatian: </b>
>* Pastikan di komputer / server sudah diinstall PHP:8.ˆ, composer:latest dan driver Mysql:5
>* Pastikan lokasi terminal sudah berada di folder project, kemudian masukkan perintah dibawah ini ke terminal / CMD
<ol>
  <li>composer install</li>
  <li>php artisan key:generate</li>
  <li>php artisan migrate --seed --path="where/your/specific/migration"</li>
</ol>

## Docker Setup
> <b>Perhatian: </b>
> Pastikan di komputer / server sudah diinstall docker dengan versi yang paling terbaru.
> Di file `.env` ganti nilai `DB_HOST=localhost` menjadi `DB_HOST=database`
<ol>
  <li>docker-compose up -d </li>
  <li>docker-compose exec app composer install atau juga bisa menggunakan docker-compose run app composer install </li>
  <li>docker-compose exec app php artisan key:generate </li>
  <li>docker-compose exec app php artisan migrate --seed --path="where/your/specific/migration</li>
  <li>docker-compose restart </li>
</ol>