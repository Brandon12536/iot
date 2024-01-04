function enviarDatos() {
    const checkbox = document.getElementById('valorEstatus');
    const isChecked = checkbox.checked;
    let value = isChecked ? '1' : '0';

    const timestamp = new Date().getTime();
    
    axios({
        method: 'get',
        url: `http://127.0.0.1/iot/backend/setLed.php?setstatus=${value}&timestamp=${timestamp}`,
        headers: { 'Content-Type': 'application/json;charset=utf-8' }
    })
    .then(response => {
        console.log('Datos enviados con éxito:', response.data);
    })
    .catch(error => {
        console.error('Error al enviar datos:', error);
    });
}

document.getElementById('enviarBtn').addEventListener('click', enviarDatos);
