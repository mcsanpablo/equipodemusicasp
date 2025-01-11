<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Canciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #2c2f38;
            color: #ccc;
        }

        /* Menú */
        .navbar {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #76c7c0;
            color: white;
            padding: 15px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .navbar a:hover {
            background-color: #76c7c0;
            color: #ffffff;
        }

        /* Título de la página */
        h1 {
            font-size: 36px;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            color: #76c7c0;
            text-shadow: 2px 2px 5px rgba(0, 123, 255, 0.5);
        }

        /* Estilos para el buscador y el botón */
        #search-bar {
            margin-bottom: 20px;
            padding: 10px 15px;
            width: 100%;
            max-width: 400px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 25px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        #search-bar:focus {
            border-color: #76c7c0;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }
        .add-song-button {
            margin: 20px 0;
            padding: 12px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .add-song-button:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        /* Contenedor de categorías de canciones */
        .category-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .category {
            width: 30%;
            padding: 15px;
            background-color: #383d47;
            border-radius: 5px;
            border: 1px solid #444;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .category h2 {
            text-align: center;
            color: #76c7c0;
            margin-bottom: 10px;
        }
        /* Estilos para las listas de canciones */
        .song-list {
            list-style: none;
            padding: 0;
        }
        .song-list li {
            margin: 10px 0;
            cursor: pointer;
            color: #76c7c0;
        }
        .song-list li:hover {
            text-decoration: underline;
        }
        .song-details {
            display: none;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #444;
            background-color: #444;
        }
        pre {
            font-family: monospace;
            background-color: #333;
            padding: 10px;
            overflow-x: auto;
        }
    </style>
    <script>
        const notes = ["C", "C#", "D", "D#", "E", "F", "F#", "G", "G#", "A", "A#", "B"];
        let allSongs = [];

        // Cargar canciones desde el servidor
        function loadSongs() {
            fetch('load_songs.php')
                .then(response => response.json())
                .then(data => {
                    allSongs = data; // Guardar todas las canciones
                    data.forEach(song => {
                        addSong(song.category, song.name, song.details);
                    });
                })
                .catch(error => {
                    console.error('Error al cargar canciones:', error);
                });
        }

        // Agregar canción a la lista
        function addSong(category, name, details) {
            const categoryList = document.getElementById(category);

            if (!categoryList) return; // Si la categoría no existe, no hacer nada

            const newSong = document.createElement('li');
            newSong.textContent = name;
            newSong.onclick = () => toggleDetails(name);

            const songDetails = document.createElement('div');
            songDetails.id = name;
            songDetails.className = 'song-details';

            const transposeControls = document.createElement('div');
            transposeControls.className = 'transpose-controls';
            transposeControls.innerHTML = `
                <label for="transpose">Transponer:</label>
                <button onclick="transposeWithin('${name}', -1)">-1</button>
                <button onclick="transposeWithin('${name}', 1)">+1</button>
            `;

            const pre = document.createElement('pre');
            pre.textContent = details;

            songDetails.appendChild(transposeControls);
            songDetails.appendChild(pre);

            categoryList.appendChild(newSong);
            categoryList.appendChild(songDetails);
        }

        // Mostrar u ocultar detalles de la canción
        function toggleDetails(id) {
            const details = document.getElementById(id);
            if (details.style.display === "none" || details.style.display === "") {
                details.style.display = "block";
            } else {
                details.style.display = "none";
            }
        }

        // Transponer acordes
        function transposeWithin(songId, steps) {
            const details = document.getElementById(songId);
            const song = details.querySelector("pre");
            const chordsRegex = /\b[A-G](#|b)?m?(sus\d|dim|aug|add\d|\d|7|9|13)?\b/g;

            song.textContent = song.textContent.replace(chordsRegex, match => {
                const noteMatch = match.match(/[A-G](#|b)?/); // Extraer nota principal
                if (!noteMatch) return match; // Si no hay nota, devolver sin cambios

                const note = noteMatch[0];
                const suffix = match.slice(note.length); // Extraer sufijo
                const allNotes = [
                    "C", "C#", "D", "D#", "E", "F", "F#", "G", "G#", "A", "A#", "B"
                ]; // Escala cromática

                const currentIndex = allNotes.indexOf(note);
                if (currentIndex === -1) return match; // Si no se encuentra, devolver sin cambios

                const newIndex = (currentIndex + steps + allNotes.length) % allNotes.length; // Nuevo índice
                return allNotes[newIndex] + suffix; // Reconstruir acorde
            });
        }

        // Filtrar canciones
        function searchSongs() {
            const searchQuery = document.getElementById('search-bar').value.toLowerCase();

            // Limpiar las listas de canciones existentes antes de mostrar los resultados de la búsqueda
            document.querySelectorAll('.song-list').forEach(list => list.innerHTML = '');

            // Filtrar canciones que coincidan con la búsqueda
            const songs = allSongs.filter(song => {
                const songName = song.name.toLowerCase();
                const songDetails = song.details.toLowerCase();
                return songName.includes(searchQuery) || songDetails.includes(searchQuery);
            });

            // Agregar las canciones filtradas a las listas
            songs.forEach(song => {
                addSong(song.category, song.name, song.details);
            });
        }

        // Cargar las canciones al cargar la página
        window.onload = function() {
            loadSongs();
        };
    </script>
</head>
<body>
    <!-- Menú de navegación -->
    <div class="navbar">
        <a href="http://localhost/musica/index.html">Inicio</a>
        <a href="http://localhost/musica/listas.php">Listas</a>
    </div>

    <!-- Título -->
    <h1>Lista de Canciones</h1>

    <div style="text-align: center;">
        <input type="text" id="search-bar" placeholder="Buscar canciones..." onkeyup="searchSongs()">
        <button class="add-song-button" onclick="openAddSongForm()">Agregar Canción</button>
    </div>

    <!-- Contenedor de categorías de canciones -->
    <div class="category-container">
        <div class="category">
            <h2>Alabanzas</h2>
            <ul class="song-list" id="Alabanzas"></ul>
        </div>
        <div class="category">
            <h2>Adoraciones</h2>
            <ul class="song-list" id="Adoraciones"></ul>
        </div>
        <div class="category">
            <h2>Ofrendas</h2>
            <ul class="song-list" id="Ofrendas"></ul>
        </div>
    </div>
</body>
</html>
