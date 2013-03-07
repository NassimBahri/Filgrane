#A propos

Créer facilement des filgranes pour vos images en PHP afin de les protéger contre les voleurs ou les utilisateurs malins :)

##Installation

Tout d'abord vous devez charger la librairie GD dans votre serveur.

Par la suite déplacer le fichier Filgrane.php dans votre répertoire de travail.

##Usage

Etape 1 : Inclure la classe Filgrane.php dans vos fichiers de travail

```php
<?php
require_once 'Filgrane.php';
?>
```

Etape 2 : Initialiser la classe Filgrane avec les valeurs nécessaires

```php
<?php
$legend=new Filgrane($originalImg,$signature,$newImg);
?>
```
Expliquons le code précédent:

	$originalImg : le chemain vers l'image originale.

	$signature : le texte que vous voulez le coller sur l'image.

	$newImg : le chemain vers la nouvelle image. Cela peut être le même que l'image originale et dans ce cas la nouvelle image remplace l'ancienne.

Exemple:
```php
<?php
$legend=new Filgrane('image.png','ma signature','nouvelle.png');
?>
```

Noter bien qu'on peut créer une image avec une extension différente que l'originale.
```php
<?php
$legend=new Filgrane('image.png','ma signature','nouvelle.jpg');
?>
```

Code complet

```php
<?php
include 'Filgrane.php';
$img='image.png';
$new='nouvelle.png';
$legend=new Filgrane($img,'ma signature',$new);
?>
<img src="<?php echo $new; ?>" />
```

Vous pouvez vous inspirer de l'exemple ci-joint.
N'hésiter pas à le partager avec vos collégues.


## Author

[Nassim Bahri](https://www.facebook.com/Bahri.Nassim) ([LinkedIn](http://www.linkedin.com/pub/nassim-bahri/32/b38/a11))