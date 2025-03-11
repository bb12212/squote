# Supabase Database Configuration Instructions

To fix the database connection issue with your Laravel application on Laravel Cloud, follow these steps:

## 1. Update the database.php file

Open the `config/database.php` file in your project and update the default connection to use PostgreSQL:

```php
'default' => env('DB_CONNECTION', 'pgsql'),
```

Change this line near the top of the file (around line 20). The original line probably has 'sqlite' as the fallback:

```php
'default' => env('DB_CONNECTION', 'sqlite'),
```

## 2. Verify Laravel Cloud Configuration

Make sure your `laravel-cloud.json` file has the correct Supabase PostgreSQL connection details:

```json
{
    "buildpack": "laravel",
    "web": {
        "document_root": "public"
    },
    "env": {
        "APP_ENV": "production",
        "APP_DEBUG": "true",
        "APP_KEY": "base64:Fep4XvTawtI5QQYvVZcsMWMvrvWbYpQhEAJUVqhg34s=",
        "LOG_CHANNEL": "stack",
        "DB_CONNECTION": "pgsql",
        "DB_HOST": "db.qdoccfwsthzarruwswvz.supabase.co",
        "DB_PORT": "5432",
        "DB_DATABASE": "postgres",
        "DB_USERNAME": "postgres",
        "DB_PASSWORD": "!372d8TtcW47AJ.",
        "SUPABASE_URL": "https://qdoccfwsthzarruwswvz.supabase.co",
        "SUPABASE_KEY": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFkb2NjZndzdGh6YXJydXdzd3Z6Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDEyNDQ3NDIsImV4cCI6MjA1NjgyMDc0Mn0.bt3AUq2GEunCIb4b-RylNutEMhcQpCERifPQ-qEAAVk",
        "SUPABASE_SECRET": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFkb2NjZndzdGh6YXJydXdzd3Z6Iiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImlhdCI6MTc0MTI0NDc0MiwiZXhwIjoyMDU2ODIwNzQyfQ.DMwpVOtjM-3pIBT-ANwZeMbAivz4kKmoPCGTJF4KZiU",
        "CACHE_DRIVER": "database",
        "SESSION_DRIVER": "database",
        "QUEUE_CONNECTION": "database"
    }
}
```

## 3. Run Migrations

After deploying the updated configuration, you'll need to run the migrations to set up the database tables. You can do this through the Laravel Cloud dashboard or by connecting to your application via SSH and running:

```bash
php artisan migrate --force
```

## 4. Verify Database Connection

To verify that your application is correctly connecting to Supabase, you can check the Laravel logs in the Laravel Cloud dashboard or by connecting to your application via SSH and running:

```bash
php artisan tinker
DB::connection()->getPdo();
```

If this returns a PDO object without errors, your connection is working correctly.

## Additional Notes

- Make sure your Supabase database has the necessary permissions for the Laravel application to connect
- If you're using any Supabase-specific features, make sure you have the appropriate PHP extensions installed
- If you continue to have issues, you may need to check the Laravel logs for more detailed error messages 