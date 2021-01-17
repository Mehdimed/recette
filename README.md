## Recette
***Entrainement PHP/Symfony***

### Initialisation du projet

Récupérer le projet en une simple commande :  
**Attention à ne pas déja avoir un dossier du nom de 'recette'.**
  
`git clone https://github.com/Mehdimed/recette.git`
</br></br>
Puis placez vous dans celui ci :  
  
`cd recette`  
</br>
Une fois un projet symfony récupérer , il faut être certain de posséder  
les même librairies/dépendances, pour installer tous les librairies on utilise composer :  
  
`composer install`  
</br>
Il faut ensuite créer la base de données, cette ci s'appelle 'recette'.  
**Attention si une base de données du nom 'recette' existe déja, pensez  
à renommer la base de données dans le fichier .env, mettez le nom que vous voulez.**  
 ```bash
// Si le Symfony CLI est installé sur votre machine :  
symfony console doctrine:database:create

// Sinon : 
php bin/console doctrine:dabatase:create
```
</br>
Une fois la base de données créer , il faut lui exporter nos différentes entités  
et charger les fixtures présente dans le projet, pour se faire :  <br><br>

```bash
symfony console make:migration

symfony console doctrine:migrations:migrate

symfony console doctrine:fixtures:load
```

</br>
C'est parfait le projet est désormais opérationnel ! Il ne vous reste plus qu'à aller voir à quoi il ressemble,  
on lance le serveur en arrière plan et on ouvre le projet dans notre navigateur par défault :  <br><br>

```bash
symfony console server:start -d

symfony open:local
```
