'use strict';

function parseCurrency(value) {
    return Intl.NumberFormat('es-CO', {
        style: 'currency',
        currency: 'COP'
    }).format(value);
}

function getDateToString(date = null){
    if(date === null){
        date = new Date();
    }
    return date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
}
