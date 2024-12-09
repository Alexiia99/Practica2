
/// CONFIGURACIÓN DEL PROYECTO ///

REQUISITOS PREVIOS:

- Node.js y npm instalados
- Composer instalado
- npx vite instalado (Verificar con: npx vite --version)


- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
INSTRUCCIONES DE INSTALACIÓN:

Frontend (en una terminal Bash) :
git clone https://github.com/Alexiia99/Practica2.git
cd Practica2/frontend/Vue
npm install
npm install vite --save-dev

Backend (en una terminal Bash):
cd ../backend
composer install
cp .env.example .env
php artisan key:generate

- - - - - - - - - - - - - - - - - - - - - - - - - - - - -
EJECUCIÓN DEL PROYECTO:

Iniciar Frontend (en una terminal Bash):
cd frontend/Vue
npm run dev

Iniciar Backend (en una terminal Bash):
cd backend
php artisan serve

El proyecto estará disponible en: http://localhost:5173/
