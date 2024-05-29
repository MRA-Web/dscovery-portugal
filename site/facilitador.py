import os


for pagina in ["about-us", "contact-us", "nif", "niss"]:

  # Defina o diretório onde estão os arquivos
  diretorio = f'C:/Users/Luiz Miguel/Desktop/discovery-portugal/site/{pagina}'

  # Percorre todos os arquivos no diretório
  for nome_arquivo in os.listdir(diretorio):

    # Verifica se o arquivo é um arquivo de texto (ou qualquer outra extensão específica)
    if nome_arquivo.endswith('.html'):
      caminho_arquivo = os.path.join(diretorio, nome_arquivo)
      
      # Lê o conteúdo do arquivo
      with open(caminho_arquivo, 'r') as arquivo:
        conteudo = arquivo.read()
      
      # Substitui a variável antiga pela nova
      idioma = nome_arquivo[:-5]

      # Defina a variável que você quer modificar e o novo valor
      variavel_antiga = f'''  <body onload="jogar_texto('/site/header/{idioma}.html', 'header'); jogar_texto('/site/footer/{idioma}.html', 'footer');">'''
      variavel_nova = f'''

  <script>
    jogar_texto('/site/footer/{idioma}.html', 'footer');
    jogar_texto('/site/header/{idioma}.html', 'header');
  </script>

  <body>
  '''

      conteudo_modificado = conteudo.replace(variavel_antiga, variavel_nova)
      
      # Escreve o conteúdo modificado de volta no arquivo
      with open(caminho_arquivo, 'w') as arquivo:
        arquivo.write(conteudo_modificado)

print("Modificação concluída!")


# variavel = 'coisa.html'

# print(variavel[:-5])
# print(variavel)