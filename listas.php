<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listas de Canciones</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #f5f5f5;
        }

        header {
            background-color: #76c7c0;
            color: #ffffff;
            padding: 15px 0;
            text-align: center;
        }

        header a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 20px;
            font-size: 18px;
        }

        header a:hover {
            text-decoration: underline;
        }

        .container {
            padding: 20px;
            max-width: 900px;
            margin: auto;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 10px;
            color: #d4d4d4;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            margin: 20px 0;
            color: #76c7c0;
        }

        h3 {
            font-size: 24px;
            cursor: pointer;
            color: #76c7c0;
            margin: 15px 0;
        }

        h3:hover {
            text-decoration: underline;
        }

        .list-details {
            display: none;
            padding: 15px;
            background-color: #1e1e1e;
            border-left: 5px solid #76c7c0;
            margin-top: 10px;
            color: #cfcfcf;
        }

        .list-details p, .list-details h4 {
            margin: 8px 0;
        }

        .download-btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #76c7c0;
            color: #121212;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .download-btn:hover {
            background-color: #5ab5ac;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script>
        function toggleList(listId) {
            const list = document.getElementById(listId);
            list.style.display = list.style.display === "block" ? "none" : "block";
        }

        function downloadList(listId, listName) {
            const listContent = document.getElementById(listId).innerText;
            const blob = new Blob([listContent], { type: 'application/msword' });
            saveAs(blob, `${listName}.doc`);
        }
    </script>
</head>
<body>
    <header>
        <a href="http://localhost/musica/index.html">Inicio</a>
        <a href="http://localhost/musica/canciones.php">Canciones</a>
    </header>
    
    <div class="container">
        <h1>Lista de Canciones y Listas Semanales</h1>
        <h2>Diciembre 2024</h2>

        <!-- Listas de canciones -->
        <section>
            <h3 onclick="toggleList('list1')">Lista Diciembre 2024 - DOMINGO 8</h3>
            <div id="list1" class="list-details">
                <p>Libre</p>
                <p>Resplandece</p>
                <p>Fiesta</p>
                <p>Con óleo de alegría</p>
                <p>El Señor es mi rey</p>
                <p>Cristo no está muerto</p>
                <p><strong>OFRENDAS:</strong> Rebosa mi corazón.</p>
                <button class="download-btn" onclick="downloadList('list1', 'Lista DOMINGO 8')">Descargar en Word</button>
            </div>

            <h3 onclick="toggleList('list2')">Lista Diciembre 2024 - DOMINGO 15</h3>
            <div id="list2" class="list-details">
                <p>Pueblos todos</p>
                <p>Tu nombre oh Dios</p>
                <p>Cambiaré mi tristeza</p>
                <p>Eres Señor vencedor</p>
                <p>Mi Dios es grande y fuerte</p>
                <p>Celebra Victorioso</p>
                <p>Levántate Señor (Bm)</p>
                <p>Abre mis ojos</p>
                <p>Agnus Dei (Aleluya)</p>
                <p>Milagroso abres caminos</p>
                <p><strong>OFRENDAS:</strong> Al que es digno.</p>
                <button class="download-btn" onclick="downloadList('list2', 'Lista DOMINGO 15')">Descargar en Word</button>
            </div>

            <h3 onclick="toggleList('list3')">Lista Diciembre 2024 - DOMINGO 22</h3>
            <div id="list3" class="list-details">
                <p>Guárdame oh Dios</p>
                <p>Bendeciré a Jehová</p>
                <p>Cantaré yo a Jehová</p>
                <p>Trae un Salmo</p>
                <p>Te exaltaré (3 veces)</p>
                <p>Alzaré mis ojos (3 veces)</p>
                <p>Yo me alegré (3 veces)</p>
                <p>Dios el más grande</p>
                <p>Hermoso eres (Marcos Witt)</p>
                <p>Exáltate (Marcos Witt, solo coro 3 veces)</p>
                <p><strong>OFRENDAS:</strong> Bueno es alabarte.</p>
                <button class="download-btn" onclick="downloadList('list3', 'Lista DOMINGO 22')">Descargar en Word</button>
            </div>

            <h3 onclick="toggleList('list4')">Lista Diciembre 2024 - DOMINGO 29</h3>
            <div id="list4" class="list-details">
                <p>Poderoso de Israel</p>
                <p>Quién, quién como Jehová</p>
                <p>Cantaré al Señor</p>
                <p>El victorioso</p>
                <p>Grande es el Señor</p>
                <p>Remolineando</p>
                <p>Así como David</p>
                <p>Dios imparable (completo)</p>
                <p>Santo por siempre</p>
                <p><strong>OFRENDAS:</strong> Me gozaré</p>
                <button class="download-btn" onclick="downloadList('list4', 'Lista DOMINGO 29')">Descargar en Word</button>
            </div>

            <h3 onclick="toggleList('list5')">Lista de año nuevo</h3>
            <div id="list5" class="list-details">
                <h4>Primer culto</h4>
                <p>Dios poderoso</p>
                <p>Increíble</p>
                <p>Libre</p>
                <p>Resplandece</p>
                <p>Fiesta</p>
                <p>Toda la noche</p>
                <p>El señor es mi rey</p>
                <p>Cristo no está muerto</p>
                <p><strong>ADORACIONES:</strong> Dios imparable</p>
                <br></br>
                <h4>Segundo culto</h4>
                <p><strong>ADORACIONES:</strong> Siempre fiel</p>
                <p>Santo por siempre</p>
                <p>Tu nombre</p>
                <p><strong>OFRENDAS:</strong> Salmos 100</p>
                <button class="download-btn" onclick="downloadList('list5', 'Lista de año nuevo')">Descargar en Word</button>
            </div>
        </section>
    </div>
</body>
</html>
