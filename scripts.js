function agregarPregunta() {
    const contenedor = document.getElementById('preguntas');
    const indice = contenedor.children.length;
    const preguntaHTML = `
        <div class="pregunta">
            <label>Pregunta:</label>
            <input type="text" name="preguntas[${indice}][texto]" required>
            <label>Alternativas:</label>
            <input type="text" name="preguntas[${indice}][alternativas][0]" required>
            <input type="text" name="preguntas[${indice}][alternativas][1]" required>
            <input type="text" name="preguntas[${indice}][alternativas][2]" required>
            <input type="text" name="preguntas[${indice}][alternativas][3]" required>
            <label>Respuesta Correcta:</label>
            <select name="preguntas[${indice}][correcta]" required>
                <option value="0">Alternativa 1</option>
                <option value="1">Alternativa 2</option>
                <option value="2">Alternativa 3</option>
                <option value="3">Alternativa 4</option>
            </select>
        </div>
    `;
    contenedor.insertAdjacentHTML('beforeend', preguntaHTML);
}
