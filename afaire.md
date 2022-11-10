* cree un design d'un tableau
* cree un script sql pour cree les tableau
* cree le script client qui active desactive le serial
* cree un script php qui reçoit l'activation et modifie la base de donnée
etre capable de supprimer les serial
* etre capable d'activé desactivé un serial
* faire rentrer les serial par masse
* verifier les dupliques

https://api.ipgeolocation.io/ipgeo?apiKey=7dc9e04a3aae44ed95a78e8c83f34051&ip=1.1.1.1&fields=city

error_reporting(-1);
ini_set('display_errors', 'On');

requit:
https://github.com/shuchkin/simplexlsx
composer require shuchkin/simplexlsx
install php7.3-mbstring
https://github.com/kherge/php.json
composer require kherge/json=^3
chown user /var/www/uploads/
chmod -R 0755 /var/www/uploads/
chown user /var/www/dat/
chmod -R 0755 /var/www/dat/