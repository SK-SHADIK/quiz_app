<h1 style="background:lightsalmon; color: #fff; text-align:center; font-size:40px; font-weight:500; border-radius: 10px; margin-top: 30px;">Quiz App</h1>

<h3 style="font-size:30px;">Requirements</h3>
<ul>
<li>PHP 8.0.6</li>
<li>Composer 2.3.5</li>
<li>psql (PostgreSQL) 14.5</li>
</ul><br><br>

<h3 style="font-size:30px;">Getting Started</h3>
<p>Clone the repo: </p>
<a style="border:2px solid lightsalmon; border-radius:10px; background:#000; padding: 10px;" href=""></a><br><br><br>

<p>After finisheing the clone update the composer in the appointments-praavahealth project</p>
<p style="font-size:14px; border:2px solid lightsalmon; border-radius:10px; background:#000; padding: 10px;" >composer update</p><br><br>

<p>Generate .env File</p>
<p style="font-size:14px; border:2px solid lightsalmon; border-radius:10px; background:#000; padding: 10px;">copy .env.example .env</p><br><br>

<p>Generate Key</p>
<p style="font-size:14px; border:2px solid lightsalmon; border-radius:10px; background:#000; padding: 10px;">php artisan key:generate</p><br><br>

<h3 style="font-size:30px;">Database</h3>
<p>Create Database And Create a Schema</p>
<p style="font-size:14px; border:2px solid lightsalmon; border-radius:10px; background:#000; padding: 10px;">quiz_app</p><br><br>

<h3 style="font-size:20px;">Setup Database</h3>
<p>Go to .env file and Edit values to match your database</p>
<p style="font-size:14px; border:2px solid lightsalmon; border-radius:10px; background:#000; padding: 10px;">DB_CONNECTION=Your DB Connection<br>
DB_HOST=Your DB Host<br>
DB_PORT=Your DB Port<br>
DB_DATABASE=Your Database Name<br>
DB_USERNAME=Your Username<br>
DB_PASSWORD=Your Password</p><br><br>

<h3>Running migrations</h3>
<p style="font-size:14px; border:2px solid lightsalmon; border-radius:10px; background:#000; padding: 10px;">php artisan migrate</p><br><br>

<p>Start the server for development:</p>
<p style="font-size:14px; border:2px solid lightsalmon; border-radius:10px; background:#000; padding: 10px;">php artisan serve</p><br><br>
