# ################### #
###  Cliente Start  ###
# ################### #

## ENUM Column

# Perfil
- Proprietário
- Cliente Interessado

# Fase de atendimento
- Novo
- Em Atendimento
- Com Proposta
- Ganhou
- Perdeu
- Inativo

# Investidor
- Sim
- Não 

# Tipo 
- Pessoa Física
- Pessoa Jurídica

# Origem
- Email
- Jornal
- Pessoal 
- Placa
- Revista
- Site
- Telefone
- Outros

# ################### #
###   Cliente End   ###
# ################### #

# ################### #
###  Imoveis Start  ###
# ################### #

## ENUM Column

# Status
- Ativos
- Inativos

# ################### #
###   Imoveis End   ###
# ################### #

# ################### #
###  Permuta Start  ###
# ################### #

## ENUM Column

# Status
- Ativo
- Inativo

# ################### #
###   Permuta End   ###
# ################### #




# ######################  Default Values on Tables   ###################### #

# ############################# #
###   Table: tipo e subtipo   ###
# ############################# #

- Apartamento
-- Padrão
-- Duplex
-- Triplex
-- Kitinete
-- Cobertura
-- Loft
-- Sobreloja
-- Flat
- Casa
-- Térrea
-- Em Condomínio
-- Em Vila Fechada
-- Sobrado Padão
-- Sobrado em Condomínio
-- Sobrado em Vila Fechada
-- Assobradada
-- Geminida
- Comercial
-- Casa
-- Loja
-- Loja em Shopping
-- Galpão / Barracão
-- Prédio Inteiro
-- Salão Comercial 
-- Negócio 
- Rural
-- Chácara
-- Chácara em Condomínio
-- Fazenda
-- Sítio 
-- Haras
-- Comercial
- Terreno
-- Em Rua
-- Em Condomínio
-- Em Loteamento
-- Comercial
-- Área Industrial
-- Para Empreendimento


# ######################  Others  ###################### #

### Comandos
- (Compilar SASS) sass --watch scss/bootstrap.scss css/bootstrap.css
- (Gerar Fontes) - npm run dev ()

### Ref.:
- (Loaders CSS) https://projects.lukehaas.me/css-loaders/