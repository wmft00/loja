# loja
1 - Baixe os arquivos<br>
2 - Crie o banco de dados mysql <br>
3 - configure dentro dos diretorios application/config/databse.php e dentro de admin/application/config/databse.php<br>
4 - importe do banco - loja.sql<br>
5 - Crie um pasta vazia chamada cache dentro dos diretorios application e dentro da pasta admin/application<br>
6 - Importe o banco de dados<br>
7 - O acesso para a area administrativa é "{{dominiodosite.com/admin}}"<br>
usuário: admin<br>
senha: admin123456<br>
8 - Configure os arquivos<br>
Configure o arquivo .htaccess dentro da pasta raiz do projeto - linha 7 e coloque o {/nomedapastaraiz/}<br>
Configure dentro do diretorio application/bootstrap.php - linha 89 aonde diz 'base_url' => '/', e coloque o {'base_url' =>'/nomedapastaraiz/'}<br>
Configure o arquivo .htaccess dentro da pasta admin - linha 7 e coloque o {/nomedapastaraiz/admin/}<br>
Configure dentro do diretorio application/bootstrap.php - linha 89 aonde diz 'base_url' => '/admin/', e coloque o {'base_url' =>'/nomedapastaraiz/admin/'}<br>