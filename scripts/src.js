function toggleClass(e, attr) {
    if (e.classList.contains(attr)) {
        e.classList.remove(attr);
    } else {
        e.classList.add(attr);
    }
}

function addClass(eID, attr) {
    elem = document.getElementById(eID);
    if (!elem.classList.contains(attr)) {
        elem.classList.add(attr);
    }
}

function toggle(button, formID, hideForms) {
    form = document.getElementById(formID);
    if (form.hidden) {
        form.hidden = false;
        button.style['borderBottom'] = '0px';
        form.style['borderTop'] = '0px';
    } else {
        button.style['borderBottom'] = '';
        form.style['borderTop'] = '';
        form.hidden = true;
    }
    // hide the rest
    if (formID!='form5' && !document.getElementById('seatCount').classList.contains('noSubmit')) {
        document.getElementById('seatCount').classList.add('noSubmit');
    }
    for (e of hideForms) {
        form = document.getElementById('form' + e);
        button = document.getElementById('button' + e);
        button.style['borderBottom'] = '';
        if (button.classList.contains('noHover')) {
            button.classList.remove('noHover');
        }
        form.style['borderTop'] = '';
        form.hidden = true;
    }
}

function showForm(formID, buttonID) {
    button = document.getElementById(buttonID);
    form = document.getElementById(formID);
    form.hidden = false;
    button.style['borderBottom'] = '0px';
    form.style['borderTop'] = '0px';
}

function hideForm(form, buttonID) {
    button = document.getElementById(buttonID);
    button.style['borderBottom'] = '';
    form.style['borderTop'] = '';
    form.hidden = true;
}

function hideAll(elems) {
    for (e of elems) {
        form = document.getElementById('form' + e);
        button = document.getElementById('button' + e);
        button.style['borderBottom'] = '';
        form.style['borderTop'] = '';
        form.hidden = true;
    }
    addClass('seatCount', 'noSubmit');
}