// ¿QUÉ HACER PARA QUE TODO FUNCIONE? //

- En primer lugar deberás hacer un git clone del repositorio.
- A continuación abrimos la terminal guake y nos movemos con el comando cd hasta estar introducirnos dentro de la carpeta que hemos clonado.
- Una vez dentro, habrán dos subcarpetas (Frontend y Backend), deberemos navegar hasta la carpeta Frontend/Vue.
- En esa carpeta ejecutamos Code . Para abrir con el Visual Studio Code.
- Dentro de code abrimos un nuevo terminal, donde ejecutaremos npm install.
- Posteriormente ejecutamos npx vite --version (Para verificar que está instalado) y seguidamente npm install vite --save-dev (para hacer la instalación global).
- Cuando esté todo instalado, ejecutamos npm run dev.
- En otra terminal (abrimos otra terminal con code) entramos en la carpeta de backend.
- Una vez dentro, ejecutamos composer install (Suele estar instalado, pero así nos aseguramos de que no de fallos).
- A continuación, ejecutamos php artisan serve (para que el servidor esté en funcionamiento con los controllers que hay en la carpeta)
- Finalmente, entramos al localhost http://localhost:5173/
