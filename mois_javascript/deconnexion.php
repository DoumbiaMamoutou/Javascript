<?php
session_start();
session_destroy();
$titre="Déconnexion";
include(includes/index.html);

if($id==0) erreur(ERR_IS_NOT_CO);

echo '<p>Vous êtes à présent déconnecté <br />
Cliquez <a href"'.htmlspecialchars($_SERVEUR['HTTP_REFERER']).'">ici</a>
pour revenir à la page précédente.<br>
Cliquez <a href="./connexion.php>ici</a> pour revenir à la page principale</p>';
echo '</div></body></html>';
?>