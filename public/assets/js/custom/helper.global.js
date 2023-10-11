'use strict';

function parseCurrency(value) {
    return Intl.NumberFormat('es-CO', {
        style: 'currency',
        currency: 'COP'
    }).format(value);
}
