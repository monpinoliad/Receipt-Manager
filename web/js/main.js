"use strict";

var receiptManager = function() {

    let input_group = document.querySelectorAll('.input-group');

    for(const groups of input_group) {
        let login_input = groups.children[0];
        let login_input_title = groups.children[1];

        if(login_input.value) {
            login_input.classList.add('colored');
            login_input_title.classList.add('has-value');
        }

        var input_focus = function() {
            if(login_input === document.activeElement) {
                login_input.classList.add('colored');
                login_input_title.classList.add('has-value');
            } else {
                if(!login_input.value) {
                    login_input.classList.remove('colored');
                    login_input_title.classList.remove('has-value');
                }
            }
        };

        document.addEventListener('click', input_focus);
    }
    document.querySelector('.form-login').reset();
}();