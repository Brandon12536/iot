function obtenerYMostrarEstadoLed() {
    axios.get('http://127.0.0.1/iot/backend/getLed.php')
        .then(response => {
            const checkbox = document.getElementById('valorEstatus');
            checkbox.checked = response.data.success && response.data.status === '1';
        })
        .catch(error => {
            console.error('Error al obtener el estado del LED:', error);
        });
}

function iniciarActualizacionPeriodica() {
    setInterval(obtenerYMostrarEstadoLed, 1000); 
}


obtenerYMostrarEstadoLed();


iniciarActualizacionPeriodica();