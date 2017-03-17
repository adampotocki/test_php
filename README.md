## Completed test application - Student Directory

1. Clone this repo

2. Set Postgres DB Settings inside ```./db/connection.php```:

```
  DEFINE('DBHOST', 'localhost');
  DEFINE('DBNAME', 'students_db');
  DEFINE('DBUSER', 'postgres');
  DEFINE('DBPASS', 'postgres');
  DEFINE('DBPORT', '5432');
```


3. Create DB: ```php ./db/init_db.php```

4. Import data.csv: ```php ./db/import.php```

** And just in case you can drop DB: ``` php ./db/drop_db.php```

Your server should point to this root directory and index.php
