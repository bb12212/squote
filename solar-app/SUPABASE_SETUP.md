# Supabase Configuration Instructions

## 1. Create a Supabase Account and Project

1. Go to [Supabase](https://supabase.com/) and sign up for an account if you don't have one.
2. Create a new project and note down the following information:
   - Project URL (e.g., `https://YOUR_PROJECT_ID.supabase.co`)
   - API Keys (anon public key and service_role secret key)
   - Database Password

## 2. Update Your .env File

Update your `.env` file with the following Supabase configuration:

```
# Change from SQLite to PostgreSQL for Supabase
DB_CONNECTION=pgsql
DB_HOST=db.YOUR_PROJECT_ID.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=YOUR_DATABASE_PASSWORD

# Add Supabase API credentials
SUPABASE_URL=https://YOUR_PROJECT_ID.supabase.co
SUPABASE_KEY=YOUR_SUPABASE_ANON_KEY
SUPABASE_SECRET=YOUR_SUPABASE_SERVICE_ROLE_KEY
```

Replace the placeholders with your actual Supabase project information:
- `YOUR_PROJECT_ID` with your Supabase project ID
- `YOUR_DATABASE_PASSWORD` with your Supabase database password
- `YOUR_SUPABASE_ANON_KEY` with your Supabase anon key
- `YOUR_SUPABASE_SERVICE_ROLE_KEY` with your Supabase service role key

## 3. Run Migrations

After updating your `.env` file, run the migrations to create the database tables in Supabase:

```
php artisan migrate
```

## 4. Verify Configuration

To verify that your Supabase configuration is working correctly:

1. Check that the tables have been created in your Supabase dashboard
2. Run the following command to test the connection:

```
php artisan tinker
DB::connection()->getPdo();
```

If successful, this should return a PDO instance without errors.

## 5. Troubleshooting

If you encounter issues:

1. **Connection Errors**: Ensure your database credentials are correct and that your IP is allowed in Supabase's network restrictions.
2. **Migration Errors**: Check that your database user has the necessary permissions.
3. **SSL Issues**: Supabase requires SSL connections. Make sure your PostgreSQL connection is configured to use SSL.

## 6. Additional Configuration

### Enable Row-Level Security (RLS)

For better security, enable Row-Level Security in Supabase for your tables:

1. Go to your Supabase dashboard
2. Navigate to the SQL Editor
3. Create policies for your tables to control access

### Configure Authentication

To use Supabase Auth with Laravel:

1. Update your `config/auth.php` file to use the appropriate guards and providers
2. Implement the necessary authentication controllers and middleware
