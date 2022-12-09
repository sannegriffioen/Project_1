<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=project", 'bit_academy', 'bit_academy');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

mycursor.execute("CREATE DATABASE marathon")


csv_data = pd.read_csv('marathon_results.csv')
for row in csv_data:

    mycursor.executemany('INSERT INTO marathon(year, winner, gender, country, time, marathon)'
                         'VALUES("%s", "%s", "%s", "%s", "%s", "%s")',
                         row)


print('data is geladen')