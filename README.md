---
title: "A2MRY - Sistema de Agendamentos"
language: pt-br
summary: Sistema completo para gerenciamento de agendamentos de serviços estéticos.
author: Matheus Coutinho
categories: ["Tecnologia", "Gestão", "Web"]
tags: ["Sistema Web", "Agendamentos", "PHP", "MySQL", "Desenvolvimento Web"]
linkvideo: https://link-video-tutorial
---

# A2MRY - Sistema de Agendamentos

**Bem-vindo ao projeto A2MRY!** Este sistema foi desenvolvido para atender clínicas estéticas e outros negócios que necessitam de uma plataforma de agendamentos simples e eficiente. 🚀

---

## 🌟 **Funcionalidades Principais**

- **Agendamentos**: Interface intuitiva para clientes marcarem seus horários.

- **Gesão dos Agendamentos**: Acesse o uma lista com os agendamentos criados.

---

## 🛠️ **Tecnologias Utilizadas**

- **Frontend**:  
  - HTML5, CSS3
  
- **Backend**:  
  - Linguagem: PHP  
  - Banco de Dados: MySQL  

---

## 📸 **Capturas Principal**

1. **Tela de Login:**
   ![Tela de Inicio](imagens/screenshots/principal.png)

2. **Tela de Cadastro:**
   
   ![Cadastro de Agendamentos](imagens/screenshots/cadastro.png)

3. **Página de Agendamentos:**
   ![Consuta de Agendamentos](imagens/screenshots/agendas.png)

---

## 🚀 **Como Executar o Projeto**

### 1. Clonar o Repositório
```bash
git clone https://github.com/matheusmcoutinho/A2MRY.git
git hub static page https://matheusmcoutinho.github.io/A2MRY/
cd A2MRY

### 2. Configurar o Banco de Dados
```bash
Acesse o arquivo db.php e configure as credenciais:

$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'a2mry';
$port = 2908;

Importe o arquivo SQL (database.sql) para o MySQL

mysql -u root -p a2mry < database.sql

### 3. Iniciar o Servidor Local
Se estiver usando PHP:

php -S localhost:8000
Acesse: http://localhost:8000



📝 Licença
Este projeto está sob a licença MIT.
Sinta-se livre para usar, modificar e distribuir com atribuição ao autor.

👨‍💻 Autor
Matheus Coutinho
Desenvolvedor de Sistemas e Estudante de Análise e Desenvolvimento de Sistemas.
📍 Blumenau, SC - Brasil
